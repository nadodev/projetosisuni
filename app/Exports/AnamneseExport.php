<?php

namespace App\Exports;

use App\Models\Anamnese;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AnamneseExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $anamnese;

    public function __construct(Anamnese $anamnese)
    {
        $this->anamnese = $anamnese->load(['student', 'professional', 'form']);
    }

    public function collection()
    {
        return collect([$this->anamnese]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Aluno',
            'Profissional',
            'Formulário',
            'Data de Criação',
            'Respostas',
            'Status'
        ];
    }

    public function map($anamnese): array
    {
        return [
            $anamnese->id,
            $anamnese->student->name,
            $anamnese->professional->name,
            $anamnese->form->name,
            $anamnese->created_at->format('d/m/Y'),
            json_encode($anamnese->respostas),
            $anamnese->status,
        ];
    }
}
