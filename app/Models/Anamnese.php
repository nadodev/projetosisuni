<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Anamnese extends Model
{
    protected $fillable = [
        'form_id',
        'student_id',
        'professional_id',
        'respostas',
        'status',
        'uuid'
    ];

    protected $casts = [
        'respostas' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($anamnese) {
            $anamnese->uuid = Str::uuid();
        });

        // Add cascading delete for evolucoes
        static::deleting(function ($anamnese) {
            $anamnese->evolucoes()->delete();
        });
    }

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
}
