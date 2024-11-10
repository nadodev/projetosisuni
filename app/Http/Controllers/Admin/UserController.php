<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Turma;
use App\Models\Categoria;
use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id_instituicao', auth()->user()->id_instituicao)
            ->when(!auth()->user()->isAdmin(), function($query) {
                return $query->where('role', '!=', 'user_admin');
            })
            ->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $turmas = Turma::where('id_instituicao', auth()->user()->id_instituicao)->get();
        $categorias = Categoria::all();
        return view('admin.users.create', compact('turmas', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cpf' => 'required|unique:users|size:11',
            'name' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'genero' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'telefone' => 'nullable|string',
            'cep' => 'required|string|size:8',
            'endereco' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'uf' => 'required|string|size:2',
            'numero' => 'nullable|integer',
            'complemento' => 'nullable|string',
            'id_turma' => 'nullable|exists:turmas,id',
            'categoria_id' => 'nullable|exists:categorias,id',
            'id_instituicao' => 'required|exists:instituicoes,id',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user_admin,user_teacher,user_student',
        ]);

        $data = $request->all();
        $data['id_instituicao'] = auth()->user()->id_instituicao;

        User::create($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        $turmas = Turma::all();
        $categorias = Categoria::all();
        $instituicoes = Instituicao::all();
        return view('admin.users.edit', compact('user', 'turmas', 'categorias', 'instituicoes'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'cpf' => 'required|string|size:11|unique:users,cpf,' . $user->id,
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'role' => 'required|in:user_admin,user_teacher,user_student',
                'categoria_id' => 'nullable|exists:categorias,id',
            ]);

            // Prepara os dados para atualização
            $data = $request->all();

            // Se uma nova senha foi fornecida
            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'required|string|min:8|confirmed'
                ]);
                $data['password'] = Hash::make($request->password);
            } else {
                // Remove o campo password se estiver vazio
                unset($data['password']);
            }

            // Remove campos desnecessários
            unset($data['_token'], $data['_method'], $data['password_confirmation']);

            // Atualiza o usuário
            $user->update($data);

            // Redireciona com mensagem de sucesso
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Usuário atualizado com sucesso!');

        } catch (\Exception $e) {
            // Log do erro
            \Log::error('Erro ao atualizar usuário: ' . $e->getMessage());

            // Redireciona com mensagem de erro
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar usuário. Por favor, tente novamente.');
        }
    }

    public function destroy(User $user)
    {
        // Verifica se o usuário logado é admin
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Apenas administradores podem excluir usuários.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuário deletado com sucesso!');
    }

    public function atribuirTurmasIndex()
    {
        $students = User::where('role', 'user_student')->get();
        $turmas = Turma::all();
        return view('admin.atribuir-turmas.index', compact('students', 'turmas'));
    }

    public function atribuirTurma(Request $request, User $user)
    {
        if ($user->role !== 'user_student') {
            return back()->with('error', 'Apenas estudantes podem ser atribuídos a turmas.');
        }



        $request->validate([
            'id_turma' => 'required|exists:turmas,id'
        ]);

        $user->update([
            'id_turma' => $request->id_turma
        ]);

        return back()->with('success', 'Turma atribuída com sucesso!');
    }
}
