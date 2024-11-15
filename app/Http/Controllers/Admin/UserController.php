<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Instituicao;
use App\Models\Category;
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
        $instituicoes = Instituicao::all();
        $categorias = Categoria::all();
        return view('admin.users.create', compact('instituicoes', 'categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
            'id_institution' => 'required|exists:instituicoes,id'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'id_institution' => $validated['id_institution']
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        $categorias = Categoria::all();
        $instituicoes = Instituicao::all();
        return view('admin.users.edit', compact('user', 'categorias', 'instituicoes'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'id_institution' => 'required|exists:instituicoes,id',
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'id_institution' => $validated['id_institution']
        ];

        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
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
