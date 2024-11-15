<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anamnese;
use App\Exports\AnamneseExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function exportAnamnesePDF(Anamnese $anamnese)
    {
        try {
            $anamnese->load(['student', 'professional', 'form', 'evolucoes' => function($query) {
                $query->orderBy('data_evolucao', 'desc');
            }]);

            $data = [
                'anamnese' => $anamnese,
                'titulo' => 'Anamnese #' . $anamnese->id,
                'data_geracao' => Carbon::now()->format('d/m/Y H:i:s'),
                'respostas' => is_array($anamnese->respostas) ? $anamnese->respostas : [],
            ];

            $pdf = PDF::loadView('admin.reports.pdf.anamnese', $data);

            return $pdf->download('anamnese-' . $anamnese->id . '.pdf');

        } catch (\Exception $e) {
            Log::error('Erro ao gerar PDF da anamnese: ' . $e->getMessage(), [
                'anamnese_id' => $anamnese->id,
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Erro ao gerar PDF. Por favor, tente novamente.');
        }
    }

    public function anamneses()
    {
        try {
            $anamneses = Anamnese::with(['student', 'professional', 'form'])
                ->orderBy('created_at', 'desc')
                ->get();

            return view('admin.reports.anamneses', compact('anamneses'));
        } catch (\Exception $e) {
            Log::error('Erro ao listar anamneses: ' . $e->getMessage());
            return back()->with('error', 'Erro ao carregar relatório de anamneses.');
        }
    }

    public function generateExcel(Anamnese $anamnese)
    {
        try {
            return Excel::download(new AnamneseExport($anamnese), 'anamnese-' . $anamnese->id . '.xlsx');
        } catch (\Exception $e) {
            Log::error('Erro ao gerar Excel: ' . $e->getMessage(), [
                'anamnese_id' => $anamnese->id,
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Erro ao gerar Excel. Por favor, tente novamente.');
        }
    }
}
