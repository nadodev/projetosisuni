<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function update(Request $request, Plan $plan)
    {
        $instituicao = auth()->user()->instituicao;
        $instituicao->update(['plan_id' => $plan->id]);

        return redirect()->back()->with('success', 'Plano atualizado com sucesso!');
    }
}
