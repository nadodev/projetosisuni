<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use App\Models\Turma;
use App\Models\User;
use App\Services\StudentRegistrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    protected $studentRegistrationService;

    public function __construct(StudentRegistrationService $studentRegistrationService)
    {
        $this->studentRegistrationService = $studentRegistrationService;
    }

    public function index()
    {
        $students = User::where('role', 'user_student')
            ->where('institution_id', auth()->user()->institution_id)
            ->with(['studentProfile.class', 'educationalProfile'])
            ->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classes = Turma::where('institution_id', auth()->user()->institution_id)
            ->orderBy('serie')
            ->orderBy('nome')
            ->get();

        $teachers = User::where('institution_id', auth()->user()->institution_id)
            ->where('role', 'user_teacher')
            ->orderBy('name')
            ->get();

        return view('admin.students.create', compact('classes', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'social_name' => 'nullable|string|max:255',
            'gender' => 'nullable|in:masculino,feminino,outro,prefiro_nao_dizer',
            'birth_date' => 'required|date',
            'cpf' => 'required|string|max:14|unique:users,cpf',
            'school_code' => 'nullable|string|max:255',
            'registration_number' => 'required|string|max:255',
            'grade_year' => 'required|string|max:255',
            'class_id' => 'required|exists:turmas,id',
            'shift' => 'required|in:manha,tarde,integral,noite',
            'unit' => 'nullable|string|max:255',
            'teacher_id' => 'required|exists:users,id',
            'neurodivergence_types' => 'required|array|min:1',
            'neurodivergence_types.*' => 'string|in:TEA,TDAH,Dislexia,Não informado',
            'has_official_diagnosis' => 'nullable|string|in:0,1',
            'pedagogical_observations' => 'nullable|string',
            'specific_needs' => 'nullable|array',
            'specific_needs.*' => 'string',
            'learning_style' => 'nullable|in:visual,auditivo,cinestesico,misto',
            'sensitivities' => 'nullable|string|max:255',
            'guardian_name' => 'required|string|max:255',
            'guardian_kinship' => 'required|in:pai,mae,tutor,outro',
            'guardian_cpf' => 'required|string|max:14',
            'guardian_email' => 'required|email|max:255',
            'guardian_phone' => 'required|string|max:255',
            'guardian_cep' => 'required|string|max:9',
            'guardian_endereco' => 'required|string|max:255',
            'guardian_bairro' => 'required|string|max:255',
            'guardian_cidade' => 'required|string|max:255',
            'guardian_uf' => 'required|string|size:2',
            'guardian_numero' => 'required|string|max:10',
            'guardian_complemento' => 'nullable|string|max:255',
            'secondary_guardian_name' => 'nullable|string|max:255',
            'secondary_guardian_kinship' => 'nullable|in:pai,mae,tutor,outro',
            'secondary_guardian_cpf' => 'nullable|string|max:14',
            'secondary_guardian_email' => 'nullable|email|max:255',
            'secondary_guardian_phone' => 'nullable|string|max:255',
            'guardian_panel_access' => 'nullable|boolean',
            'photo' => 'nullable|image|max:2048',
            'evaluation_file' => 'nullable|file|mimes:pdf|max:5120',
            'external_support_name' => 'nullable|string|max:255',
        ]);

        try {
            // Verificar se a turma tem vagas disponíveis
            $turma = Turma::findOrFail($validated['class_id']);
            if ($turma->students()->count() >= $turma->capacidade) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'A turma selecionada não possui vagas disponíveis.');
            }

            $validated['institution_id'] = auth()->user()->institution_id;

            $student = $this->studentRegistrationService->register($validated);

            return redirect()
                ->route('admin.students.index')
                ->with('success', 'Estudante cadastrado com sucesso!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar estudante. ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $student = User::where('role', 'user_student')
            ->findOrFail($id);
            
        return view('admin.students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = User::where('role', 'user_student')
            ->findOrFail($id);
            
        $classes = Turma::where('institution_id', $student->institution_id)->get();
        $teachers = User::where('institution_id', $student->institution_id)
            ->where('role', 'user_teacher')
            ->get();

        return view('admin.students.edit', compact('student', 'classes', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $student = User::where('role', 'user_student')
            ->findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'social_name' => 'nullable|string|max:255',
            'gender' => 'nullable|in:masculino,feminino,outro,prefiro_nao_dizer',
            'birth_date' => 'required|date',
            'cpf' => 'nullable|string|max:14',
            'school_code' => 'nullable|string|max:255',
            'registration_number' => 'required|string|max:255',
            'grade_year' => 'required|string|max:255',
            'class_id' => 'required|exists:turmas,id',
            'shift' => 'required|in:manha,tarde,integral,noite',
            'unit' => 'nullable|string|max:255',
            'teacher_id' => 'required|exists:users,id',
            'neurodivergence_types' => 'required|array',
            'has_official_diagnosis' => 'nullable|boolean',
            'pedagogical_observations' => 'nullable|string',
            'specific_needs' => 'nullable|array',
            'learning_style' => 'nullable|in:visual,auditivo,cinestesico,misto',
            'sensitivities' => 'nullable|string|max:255',
            'guardian_name' => 'required|string|max:255',
            'guardian_kinship' => 'required|in:pai,mae,tutor,outro',
            'guardian_cpf' => 'required|string|max:14',
            'guardian_email' => 'required|email|max:255',
            'guardian_phone' => 'required|string|max:255',
            'guardian_cep' => 'required|string|max:9',
            'guardian_endereco' => 'required|string|max:255',
            'guardian_bairro' => 'required|string|max:255',
            'guardian_cidade' => 'required|string|max:255',
            'guardian_uf' => 'required|string|size:2',
            'guardian_numero' => 'required|string|max:10',
            'guardian_complemento' => 'nullable|string|max:255',
            'secondary_guardian_name' => 'nullable|string|max:255',
            'secondary_guardian_kinship' => 'nullable|in:pai,mae,tutor,outro',
            'secondary_guardian_cpf' => 'nullable|string|max:14',
            'secondary_guardian_email' => 'nullable|email|max:255',
            'secondary_guardian_phone' => 'nullable|string|max:255',
            'guardian_panel_access' => 'nullable|boolean',
            'photo' => 'nullable|image|max:2048',
            'evaluation_file' => 'nullable|file|mimes:pdf|max:5120',
            'external_support_name' => 'nullable|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($student, $validated, $request) {
                // Atualizar usuário
                $student->update([
                    'name' => $validated['full_name'],
                    'full_name' => $validated['full_name'],
                    'social_name' => $validated['social_name'],
                    'gender' => $validated['gender'],
                    'birth_date' => $validated['birth_date'],
                    'cpf' => $validated['cpf'],
                    'school_code' => $validated['school_code'],
                    'registration_number' => $validated['registration_number'],
                    'grade_year' => $validated['grade_year'],
                    'shift' => $validated['shift'],
                    'unit' => $validated['unit'],
                    'teacher_id' => $validated['teacher_id'],
                    'neurodivergence_types' => $validated['neurodivergence_types'],
                    'has_official_diagnosis' => $validated['has_official_diagnosis'],
                    'pedagogical_observations' => $validated['pedagogical_observations'],
                    'specific_needs' => $validated['specific_needs'],
                    'learning_style' => $validated['learning_style'],
                    'sensitivities' => $validated['sensitivities'],
                    'guardian_name' => $validated['guardian_name'],
                    'guardian_kinship' => $validated['guardian_kinship'],
                    'guardian_cpf' => $validated['guardian_cpf'],
                    'guardian_email' => $validated['guardian_email'],
                    'guardian_phone' => $validated['guardian_phone'],
                    'guardian_cep' => $validated['guardian_cep'],
                    'guardian_endereco' => $validated['guardian_endereco'],
                    'guardian_bairro' => $validated['guardian_bairro'],
                    'guardian_cidade' => $validated['guardian_cidade'],
                    'guardian_uf' => $validated['guardian_uf'],
                    'guardian_numero' => $validated['guardian_numero'],
                    'guardian_complemento' => $validated['guardian_complemento'],
                    'secondary_guardian_name' => $validated['secondary_guardian_name'],
                    'secondary_guardian_kinship' => $validated['secondary_guardian_kinship'],
                    'secondary_guardian_cpf' => $validated['secondary_guardian_cpf'],
                    'secondary_guardian_email' => $validated['secondary_guardian_email'],
                    'secondary_guardian_phone' => $validated['secondary_guardian_phone'],
                    'guardian_panel_access' => $validated['guardian_panel_access'],
                    'external_support_name' => $validated['external_support_name'],
                ]);

                // Atualizar turma se necessário
                if ($student->class_id != $validated['class_id']) {
                    $student->update(['class_id' => $validated['class_id']]);
                }

                // Processar uploads se existirem
                if ($request->hasFile('photo')) {
                    $photoPath = $request->file('photo')->store('students/photos', 'public');
                    $student->update(['photo_path' => $photoPath]);
                }
                
                if ($request->hasFile('evaluation_file')) {
                    $evaluationPath = $request->file('evaluation_file')->store('students/evaluations', 'public');
                    $student->update(['evaluation_file_path' => $evaluationPath]);
                }
            });

            return redirect()
                ->route('admin.students.index')
                ->with('success', 'Estudante atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar estudante. ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $student = User::where('role', 'user_student')
            ->findOrFail($id);

        try {
            DB::transaction(function () use ($student) {
                $student->delete();
            });

            return redirect()
                ->route('admin.students.index')
                ->with('success', 'Estudante excluído com sucesso!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao excluir estudante. ' . $e->getMessage());
        }
    }
} 