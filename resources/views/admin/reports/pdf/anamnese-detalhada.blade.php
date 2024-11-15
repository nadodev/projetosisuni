<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            margin: 2cm;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            background-color: #f3f4f6;
            padding: 10px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .info-row {
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: bold;
            color: #374151;
        }
        .evolution-item {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 0;
        }
        .evolution-date {
            color: #4b5563;
            font-size: 0.9em;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8em;
            margin: 5px 0;
        }
        .status-pendente { background-color: #fef3c7; color: #92400e; }
        .status-em_andamento { background-color: #dbeafe; color: #1e40af; }
        .status-concluida { background-color: #d1fae5; color: #065f46; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.8em;
            color: #6b7280;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $titulo }}</h1>
        <p>Data de Geração: {{ $data_geracao }}</p>
    </div>

    <div class="section">
        <div class="section-title">Informações do Aluno</div>
        <div class="info-row">
            <span class="info-label">Nome:</span> {{ $anamnese->student->name }}
        </div>
        <div class="info-row">
            <span class="info-label">Data de Criação:</span> {{ $anamnese->created_at->format('d/m/Y') }}
        </div>
        <div class="info-row">
            <span class="info-label">Status:</span>
            <span class="status-badge status-{{ $anamnese->status }}">
                {{ ucfirst($anamnese->status) }}
            </span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Formulário</div>
        <div class="info-row">
            <span class="info-label">Nome do Formulário:</span> {{ $anamnese->form->name }}
        </div>

        @if(count($respostas) > 0)
            <div class="section-title">Respostas do Formulário</div>
            @foreach($respostas as $pergunta => $resposta)
                <div class="info-row">
                    <span class="info-label">{{ $pergunta }}:</span><br>
                    {{ $resposta }}
                </div>
            @endforeach
        @endif
    </div>

    @if($anamnese->evolucoes->count() > 0)
        <div class="section">
            <div class="section-title">Evoluções</div>
            @foreach($anamnese->evolucoes as $evolucao)
                <div class="evolution-item">
                    <div class="evolution-date">
                        <span class="info-label">Data:</span>
                        {{ Carbon\Carbon::parse($evolucao->data_evolucao)->format('d/m/Y') }}
                        às
                        {{ Carbon\Carbon::parse($evolucao->hora_evolucao)->format('H:i') }}
                    </div>
                    <div class="status-badge status-{{ $evolucao->status }}">
                        {{ ucfirst(str_replace('_', ' ', $evolucao->status)) }}
                    </div>
                    <p>{{ $evolucao->descricao }}</p>
                    <div class="info-row">
                        <span class="info-label">Profissional:</span>
                        {{ $evolucao->professional->name }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="footer">
        <p>Profissional Responsável: {{ $anamnese->professional->name }}</p>
        <p>Documento gerado automaticamente pelo sistema em {{ $data_geracao }}</p>
    </div>
</body>
</html>
