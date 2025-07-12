<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AnamneseExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $anamnese;

    public function __construct($anamnese)
    {
        $this->anamnese = $anamnese;
    }

    public function collection()
    {
        return $this->anamnese->evolucoes()
            ->with(['professional'])
            ->orderBy('data_evolucao', 'desc')
            ->orderBy('hora_evolucao', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Data',
            'Hora',
            'Profissional',
            'Status',
            'Progresso',
            'Descrição'
        ];
    }

    public function map($evolucao): array
    {
        return [
            $evolucao->data_evolucao->format('d/m/Y'),
            $evolucao->hora_evolucao->format('H:i'),
            $evolucao->professional->name,
            $this->getStatusText($evolucao->status),
            $this->getProgressoFromStatus($evolucao->status) . '%',
            $evolucao->descricao
        ];
    }

    private function getStatusText($status)
    {
        return [
            'pendente' => 'Pendente',
            'em_andamento' => 'Em Andamento',
            'em_observacao' => 'Em Observação',
            'concluido' => 'Concluído'
        ][$status] ?? $status;
    }

    private function getProgressoFromStatus($status)
    {
        return [
            'pendente' => 0,
            'em_andamento' => 50,
            'em_observacao' => 75,
            'concluido' => 100
        ][$status] ?? 0;
    }
}
