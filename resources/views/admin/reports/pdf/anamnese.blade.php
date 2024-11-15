<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            background-color: #f3f4f6;
            padding: 5px;
        }
        .info-row {
            margin-bottom: 5px;
        }
        .info-label {
            font-weight: bold;
        }
        .evolucao {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $titulo }}</h1>
        <p>Data de Geração: {{ $data_geracao }}</p>
    </div>

    <div class="section">
        <div class="section-title">Dados do Aluno</div>
        <div class="info-row">
            <span class="info-label">Nome:</span> {{ $anamnese->student->name }}
        </div>
        <div class="info-row">
            <span class="info-label">Data de Criação:</span> {{ $anamnese->created_at->format('d/m/Y') }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">Formulário</div>
        <div class="info-row">
            <span class="info-label">Nome do Formulário:</span> {{ $anamnese->form->name }}
        </div>
    </div>

    @if(count($respostas) > 0)
        <div class="section">
            <div class="section-title">Respostas</div>
            @foreach($respostas as $pergunta => $resposta)
                <div class="info-row">
                    <span class="info-label">{{ $pergunta }}:</span><br>
                    {{ $resposta }}
                </div>
            @endforeach
        </div>
    @endif

    @if($anamnese->evolucoes->count() > 0)
        <div class="section">
            <div class="section-title">Evoluções</div>
            @foreach($anamnese->evolucoes as $evolucao)
                <div class="evolucao">
                    <div class="info-row">
                        <span class="info-label">Data:</span>
                        {{ Carbon\Carbon::parse($evolucao->data_evolucao)->format('d/m/Y') }}
                        às
                        {{ Carbon\Carbon::parse($evolucao->hora_evolucao)->format('H:i') }}
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status:</span>
                        {{ ucfirst(str_replace('_', ' ', $evolucao->status)) }}
                    </div>
                    <div class="info-row">
                        {{ $evolucao->descricao }}
                    </div>
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
