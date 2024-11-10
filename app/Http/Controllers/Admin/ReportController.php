<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anamnese;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnamneseExport;

class ReportController extends Controller
{
    public function generatePDF(Anamnese $anamnese)
    {
        $pdf = PDF::loadView('admin.reports.anamnese-pdf', [
            'anamnese' => $anamnese->load(['evolucoes.professional', 'student', 'professional'])
        ]);

        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->getDomPDF()->set_option("enable_javascript", true);
        $pdf->getDomPDF()->set_option("enable_remote", true);
        $pdf->getDomPDF()->set_option("enable_html5_parser", true);

        return $pdf->download('anamnese-' . $anamnese->student->name . '-' . now()->format('d-m-Y') . '.pdf');
    }

    public function generateExcel(Anamnese $anamnese)
    {
        return Excel::download(
            new AnamneseExport($anamnese),
            'anamnese-' . $anamnese->student->name . '-' . now()->format('d-m-Y') . '.xlsx'
        );
    }

    public function studentProgress(Request $request)
    {
        $students = User::where('role', 'user_student')
            ->with(['anamneses' => function($query) {
                $query->with('evolucoes');
            }])
            ->get();

        if ($request->format === 'pdf') {
            $pdf = PDF::loadView('admin.reports.student-progress-pdf', compact('students'));
            return $pdf->download('progresso-estudantes.pdf');
        }

        if ($request->format === 'excel') {
            return Excel::download(new StudentProgressExport($students), 'progresso-estudantes.xlsx');
        }

        return view('admin.reports.student-progress', compact('students'));
    }
}
