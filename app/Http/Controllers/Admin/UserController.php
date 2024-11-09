<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Turma;
use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $turmas = Turma::all();
        $instituicoes = Instituicao::all();
        return view('admin.users.create', compact('turmas', 'instituicoes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cpf' => 'required|unique:users|size:11',
            'name' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'genero' => 'required|string',
            'email' => 'nullable|email|unique:users',
            'telefone' => 'nullable|string',
            'cep' => 'required|string|size:8',
            'endereco' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'uf' => 'required|string|size:2',
            'numero' => 'nullable|integer',
            'complemento' => 'nullable|string',
            'id_turma' => 'nullable|exists:turmas,id',
            'categoria' => 'required|string',
            'id_instituicao' => 'required|exists:instituicoes,id',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user_admin,user_teacher,user_student',
        ]);

        User::create([
            ...$request->except('password'),
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        $turmas = Turma::all();
        $instituicoes = Instituicao::all();
        return view('admin.users.edit', compact('user', 'turmas', 'instituicoes'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'cpf' => 'required|size:11|unique:users,cpf,' . $user->id,
            'name' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'genero' => 'required|string',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'telefone' => 'nullable|string',
            'cep' => 'required|string|size:8',
            'endereco' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'uf' => 'required|string|size:2',
            'numero' => 'nullable|integer',
            'complemento' => 'nullable|string',
            'id_turma' => 'nullable|exists:turmas,id',
            'categoria' => 'required|string',
            'id_instituicao' => 'required|exists:instituicoes,id',
            'role' => 'required|in:user_admin,user_teacher,user_student',
        ]);

        $data = $request->except('password');

        if ($request->filled('password')) {
            $request->validate(['password' => 'required|string|min:8|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
