<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Anamnese</title>
    <style>
        @page {
            margin: 2cm;
        }

        body {
            font-family: DejaVu Sans;
            line-height: 1.6;
            color: #2d3748;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .header {
            padding: 20px;
            border-bottom: 2px solid #4a5568;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #2d3748;
            font-size: 20px;
            margin: 0 0 10px 0;
        }

        .header-info {
            margin-top: 15px;
            padding: 10px;
            background: #f7fafc;
            border-radius: 4px;
        }

        .section {
            margin-bottom: 20px;
            padding: 15px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
        }

        .section h2 {
            color: #2d3748;
            font-size: 16px;
            margin: 0 0 15px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #e2e8f0;
        }

        .statistics-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 11px;
        }

        .statistics-table th {
            background: #f7fafc;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            color: #4a5568;
            border: 1px solid #e2e8f0;
        }

        .statistics-table td {
            padding: 8px;
            border: 1px solid #e2e8f0;
        }

        .evolution-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .evolution-item {
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }

        .evolution-item:last-child {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }

        .status-concluido { background: #c6f6d5; color: #22543d; }
        .status-em_andamento { background: #bee3f8; color: #2c5282; }
        .status-em_observacao { background: #fefcbf; color: #744210; }
        .status-pendente { background: #fed7d7; color: #822727; }

        .progress-info {
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            color: #718096;
            padding-top: 5px;
            border-top: 1px solid #e2e8f0;
        }

        .page-number {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #718096;
            padding-bottom: 10px;
        }

        .page-number:after {
            content: counter(page) " de " counter(pages);
        }
    </style>
</head>
<body>
    <div class="page-number"></div>

    <div class="header">
        <h1>Relatório de Evolução do Paciente</h1>
        <div class="header-info">
            <strong>Paciente:</strong> {{ $anamnese->student->name }} |
            <strong>Profissional:</strong> {{ $anamnese->professional->name }} |
            <strong>Data:</strong> {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>

    <div class="section">
        <h2>Resumo do Progresso</h2>
        @php $estatisticas = $anamnese->getEstatisticasEvolucoes(); @endphp

        <div class="progress-info">
            Progresso Geral: {{ $anamnese->progresso }}%
        </div>

        <table class="statistics-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Quantidade</th>
                    <th>Porcentagem</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Concluídas</td>
                    <td>{{ $estatisticas['concluido']['quantidade'] }}</td>
                    <td>{{ $estatisticas['concluido']['porcentagem'] }}%</td>
                </tr>
                <tr>
                    <td>Em Observação</td>
                    <td>{{ $estatisticas['em_observacao']['quantidade'] }}</td>
                    <td>{{ $estatisticas['em_observacao']['porcentagem'] }}%</td>
                </tr>
                <tr>
                    <td>Em Andamento</td>
                    <td>{{ $estatisticas['em_andamento']['quantidade'] }}</td>
                    <td>{{ $estatisticas['em_andamento']['porcentagem'] }}%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Histórico de Evoluções</h2>
        <ul class="evolution-list">
            @foreach($anamnese->evolucoes()->orderBy('data_evolucao', 'desc')->get() as $evolucao)
                <li class="evolution-item">
                    <strong>{{ $evolucao->data_evolucao->format('d/m/Y H:i') }}</strong> -
                    {{ $evolucao->professional->name }} -
                    <span class="status-badge status-{{ $evolucao->status }}">
                        {{ ucfirst(str_replace('_', ' ', $evolucao->status)) }}
                    </span>
                    <br>
                    {{ $evolucao->descricao }}
                </li>
            @endforeach
        </ul>
    </div>

    <div class="footer" style="position: fixed; bottom: 0; width: 100%; text-align: center;">
        <div style="border-top: 1px solid #e2e8f0; padding-top: 5px; font-size: 10px; color: #718096;">
            Relatório gerado em {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>
</body>
</html>

