<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Turma;
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
        return view('admin.users.create', compact('turmas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cpf' => 'required|unique:users|size:11',
            'nome_completo' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user_admin,user_teacher,user_student',
            'codigo_turma' => 'required_if:role,user_student|nullable|exists:turmas,codigo',
        ]);

        $data = $request->except('password');
        $data['password'] = Hash::make($request->password);

        // Garante que apenas estudantes possam ter turma atribuída
        if ($request->role !== 'user_student') {
            $data['codigo_turma'] = null;
        }

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        // Verifica se o usuário logado é admin
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Apenas administradores podem editar usuários.');
        }

        $turmas = Turma::all();
        return view('admin.users.edit', compact('user', 'turmas'));
    }

    public function update(Request $request, User $user)
    {
        // Verifica se o usuário logado é admin
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Apenas administradores podem atualizar usuários.');
        }

        $request->validate([
            'cpf' => 'required|string|size:11|unique:users,cpf,' . $user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user_admin,user_teacher,user_student',
            'id_turma' => 'required_if:role,user_student|nullable|exists:turmas,id',
        ]);

        $data = $request->except('password');

        if ($request->filled('password')) {
            $request->validate(['password' => 'required|string|min:8|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        // Garante que apenas estudantes possam ter turma atribuída
        if ($request->role !== 'user_student') {
            $data['id_turma'] = null;
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso!');
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
