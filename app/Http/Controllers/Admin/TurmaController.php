<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Turma;
use App\Models\User;
use App\Models\Instituicao;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::paginate(10);

        return view('admin.turmas.index', compact('turmas'));
    }

    public function create()
    {
        $teachers = User::where('institution_id', auth()->user()->institution_id)
            ->where('role', 'user_teacher')
            ->get();

        return view('admin.turmas.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        // dd($request->all()); // Debugging line, remove in production
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'serie' => 'required|string|max:255',
            'turno' => 'required|in:manha,tarde,integral,noite',
            'professor_id' => 'required|exists:users,id',
            'capacidade' => 'required|integer|min:1',
            'sala' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
            'ano_letivo' => 'required|integer|min:2024|max:2100',
        ]);

//           "_token" => "YdRnGxRnZ2ZJqK94FPiSDYM1nSirLFFMl0fP7yUM"
//   "nome" => "1 ano"
//   "serie" => "2025"
//   "turno" => "manha"
//   "teacher_id" => "6"
//   "capacidade" => "30"
//   "sala" => "101"
//   "ano_letivo" => "2025"
//   "descricao" => "dsadsa"

        try {
            $validated['institution_id'] = auth()->user()->institution_id;

            Turma::create($validated);

            return redirect()
                ->route('admin.turmas.index')
                ->with('success', 'Turma criada com sucesso!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao criar turma. ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $teachers = User::where('institution_id', auth()->user()->institution_id)
            ->where('role', 'user_teacher')
            ->get();


            $turma = Turma::findOrFail($id);

        return view('admin.turmas.edit', compact('turma', 'teachers', 'id'));
    }

    public function update(Request $request, $id)
    {

        $turma = Turma::findOrFail($id);
        
       $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'serie' => 'required|string|max:255',
            'turno' => 'required|in:manha,tarde,integral,noite',
            'professor_id' => 'required|exists:users,id',
            'capacidade' => 'required|integer|min:1',
            'sala' => 'nullable|string|max:255',
            'ano_letivo' => 'required|integer|min:2024|max:2100',
            'descricao' => 'nullable|string',
       ]);

        
        try {
            $turma->fill($validated);
            $turma->save();

            return redirect()
                ->route('admin.turmas.index')
                ->with('success', 'Turma atualizada com sucesso!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar turma. ' . $e->getMessage());
        }
    }

    public function destroy(Turma $turma)
    {

      
        try {
            User::where('id_turma', $turma->id)->update(['id_turma' => null]);
            $turma->delete();

            return redirect()
                ->route('admin.turmas.index')
                ->with('success', 'Turma excluída com sucesso!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao excluir turma. ' . $e->getMessage());
        }
    }

    public function atribuirTurmasIndex()
    {
        $users = User::where('role', 'user_student')
            ->where('institution_id', auth()->user()->institution_id)
            ->with(['studentProfile.class'])
            ->get();
            
        $turmas = Turma::where('institution_id', auth()->user()->institution_id)
            ->withCount('students')
            ->orderBy('nome')
            ->get();
            
        return view('admin.atribuir-turmas.index', compact('users', 'turmas'));
    }

    public function atribuirTurma(Request $request, User $user)
    {
        if ($user->role !== 'user_student') {
            return back()->with('error', 'Apenas estudantes podem ser atribuídos a turmas.');
        }

        $request->validate([
            'turma_id' => 'required|exists:turmas,id'
        ]);

        try {
            DB::beginTransaction();
            
            $turma = Turma::findOrFail($request->turma_id);

            
            // Check if the turma belongs to the same institution
            if ($turma->institution_id !== auth()->user()->institution_id) {
                return back()->with('error', 'Turma inválida.');
            }
            
            // Get current student profile
            $studentProfile = $user->studentProfile;
            
            $oldClassId = $studentProfile?->class_id;
            
            // Check if the turma has capacity (only if it's a new assignment or different class)
            if (!$oldClassId || $oldClassId != $turma->id) {
                // Get the actual count of students in the class
                $currentStudents = StudentProfile::where('class_id', $turma->id)->count();
                if ($currentStudents >= $turma->capacidade) {
                    return back()->with('error', 'A turma selecionada já está com a capacidade máxima.');
                }
            }

            
            $user->id_turma = $turma->id;
            $user->save();
            
            DB::commit();
            return back()->with('success', 'Turma atribuída com sucesso!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao atribuir turma. ' . $e->getMessage());
        }
    }

    public function removerTurma($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role !== 'user_student') {
            return back()->with('error', 'Operação inválida.');
        }

        try {
            DB::beginTransaction();

            $user->id_turma = null;
            $user->save();

            DB::commit();
            return back()->with('success', 'Aluno removido da turma com sucesso!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao remover aluno da turma. ' . $e->getMessage());
        }
    }
}
