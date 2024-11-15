<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Traits\BelongsToInstitution;

class Anamnese extends Model
{
    use BelongsToInstitution;

    protected $fillable = [
        'form_id',
        'student_id',
        'professional_id',
        'id_instituicao',
        'respostas',
        'status'
    ];

    protected $casts = [
        'respostas' => 'array'
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    public function evolucoes()
    {
        return $this->hasMany(Evolucao::class);
    }

    public function ultimaEvolucao()
    {
        return $this->hasOne(Evolucao::class)->latest();
    }

    public function getProgressoAttribute()
    {
        $evolucoes = $this->evolucoes;

        if ($evolucoes->isEmpty()) {
            return 0;
        }

        $totalEvolucoes = $evolucoes->count();
        $evolucoesCompletas = $evolucoes->where('status', 'concluido')->count();

        // Calcula a porcentagem simples: evoluções concluídas / total de evoluções
        return round(($evolucoesCompletas / $totalEvolucoes) * 100);
    }

    // Método para obter estatísticas detalhadas das evoluções
    public function getEstatisticasEvolucoes()
    {
        $evolucoes = $this->evolucoes;
        $total = $evolucoes->count();

        if ($total === 0) {
            return [
                'concluido' => ['quantidade' => 0, 'porcentagem' => 0],
                'em_observacao' => ['quantidade' => 0, 'porcentagem' => 0],
                'em_andamento' => ['quantidade' => 0, 'porcentagem' => 0],
                'pendente' => ['quantidade' => 0, 'porcentagem' => 0],
                'total' => 0
            ];
        }

        return [
            'concluido' => [
                'quantidade' => $evolucoes->where('status', 'concluido')->count(),
                'porcentagem' => round(($evolucoes->where('status', 'concluido')->count() / $total) * 100)
            ],
            'em_observacao' => [
                'quantidade' => $evolucoes->where('status', 'em_observacao')->count(),
                'porcentagem' => round(($evolucoes->where('status', 'em_observacao')->count() / $total) * 100)
            ],
            'em_andamento' => [
                'quantidade' => $evolucoes->where('status', 'em_andamento')->count(),
                'porcentagem' => round(($evolucoes->where('status', 'em_andamento')->count() / $total) * 100)
            ],
            'pendente' => [
                'quantidade' => $evolucoes->where('status', 'pendente')->count(),
                'porcentagem' => round(($evolucoes->where('status', 'pendente')->count() / $total) * 100)
            ],
            'total' => $total
        ];
    }

    public function getStatusColorAttribute()
    {
        $progresso = $this->progresso;

        if ($progresso < 25) return 'red';
        if ($progresso < 50) return 'yellow';
        if ($progresso < 75) return 'blue';
        return 'green';
    }

    public function progressPercentage()
    {
        return match($this->status) {
            'concluida' => 100,
            'em_andamento' => 50,
            'em_observacao' => 25,
            default => 0,
        };
    }

    // Método para calcular a porcentagem de progresso
    public function calculateProgressPercentage()
    {
        switch ($this->status) {
            case 'pendente':
                return 25;
            case 'em_andamento':
                return 50;
            case 'concluida':
                return 100;
            default:
                return 0;
        }
    }

    // Método para obter a cor da barra de progresso
    public function getProgressBarColor()
    {
        switch ($this->status) {
            case 'pendente':
                return 'bg-yellow-500';
            case 'em_andamento':
                return 'bg-blue-500';
            case 'concluida':
                return 'bg-green-500';
            default:
                return 'bg-gray-500';
        }
    }

    public function institution()
    {
        return $this->belongsTo(Instituicao::class, 'id_instituicao');
    }

    // Método para garantir que temos o id_institution
    public function getInstitutionId()
    {
        return $this->id_institution ?? $this->student->id_institution ?? $this->professional->id_institution;
    }
}
