<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Turma;
use App\Models\Categoria;
use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['institution', 'categoria'])->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $instituicoes = Instituicao::all();
        $categorias = Categoria::all();
        return view('admin.users.create', compact('instituicoes', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'institution_id' => ['required', 'exists:instituicoes,id'],
            'categoria_id' => ['nullable', 'exists:categorias,id'],
            'cpf' => ['required', 'string', 'max:14', 'unique:users'],
            'data_nascimento' => ['required', 'date'],
            'genero' => ['required', 'string', 'in:masculino,feminino,outro'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'cep' => ['required', 'string', 'max:9'],
            'endereco' => ['required', 'string', 'max:255'],
            'bairro' => ['required', 'string', 'max:255'],
            'cidade' => ['required', 'string', 'max:255'],
            'uf' => ['required', 'string', 'size:2'],
            'numero' => ['required', 'string'],
            'complemento' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:user_admin,user_teacher,user_student']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'institution_id' => $request->institution_id,
            'categoria_id' => $request->categoria_id,
            'cpf' => $request->cpf,
            'data_nascimento' => $request->data_nascimento,
            'genero' => $request->genero,
            'telefone' => $request->telefone,
            'cep' => $request->cep,
            'endereco' => $request->endereco,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        $instituicoes = Instituicao::all();
        $categorias = Categoria::all();
        return view('admin.users.edit', compact('user', 'instituicoes', 'categorias'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'institution_id' => ['required', 'exists:instituicoes,id'],
            'categoria_id' => ['nullable', 'exists:categorias,id'],
            'cpf' => ['required', 'string', 'max:14', 'unique:users,cpf,' . $user->id],
            'data_nascimento' => ['required', 'date'],
            'genero' => ['required', 'string', 'in:masculino,feminino,outro'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'cep' => ['required', 'string', 'max:9'],
            'endereco' => ['required', 'string', 'max:255'],
            'bairro' => ['required', 'string', 'max:255'],
            'cidade' => ['required', 'string', 'max:255'],
            'uf' => ['required', 'string', 'size:2'],
            'numero' => ['required', 'string'],
            'complemento' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:user_admin,user_teacher,user_student']
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()]
            ]);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'institution_id' => $request->institution_id,
            'categoria_id' => $request->categoria_id,
            'cpf' => $request->cpf,
            'data_nascimento' => $request->data_nascimento,
            'genero' => $request->genero,
            'telefone' => $request->telefone,
            'cep' => $request->cep,
            'endereco' => $request->endereco,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'role' => $request->role
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuário excluído com sucesso!');
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
