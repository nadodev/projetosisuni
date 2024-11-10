<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        $instituicao = auth()->user()->instituicao;
        return view('admin.plans.index', compact('plans', 'instituicao'));
    }

    public function update(Request $request, Plan $plan)
    {
        try {
            DB::beginTransaction();

            $instituicao = auth()->user()->instituicao;

            // Atualiza o plano da instituição
            $instituicao->update([
                'plan_id' => $plan->id,
                'available_invites' => $plan->total_invites, // Atualiza a quantidade de convites disponíveis
            ]);

            DB::commit();

            return redirect()->route('plans.index')
                ->with('success', 'Plano atualizado com sucesso! Você agora tem ' . $plan->total_invites . ' convites disponíveis.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('plans.index')
                ->with('error', 'Erro ao atualizar o plano: ' . $e->getMessage());
        }
    }
}
