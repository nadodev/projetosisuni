<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Anamnese #{{ $anamnese->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .section { margin-bottom: 20px; }
        .evolution { border-bottom: 1px solid #ccc; padding: 10px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Anamnese</h1>
        <p>Data: {{ $anamnese->created_at->format('d/m/Y') }}</p>
    </div>

    <div class="section">
        <h2>Dados do Aluno</h2>
        <p>Nome: {{ $anamnese->student->name }}</p>
    </div>

    <div class="section">
        <h2>Formulário</h2>
        <p>Nome do Formulário: {{ $anamnese->form->name }}</p>

        @if(is_array($anamnese->respostas))
            <h3>Respostas:</h3>
            @foreach($anamnese->respostas as $pergunta => $resposta)
                <p><strong>{{ $pergunta }}:</strong> {{ $resposta }}</p>
            @endforeach
        @endif
    </div>

    @if($anamnese->evolucoes->count() > 0)
    <div class="section">
        <h2>Evoluções</h2>
        @foreach($anamnese->evolucoes as $evolucao)
        <div class="evolution">
            <p><strong>Data:</strong>
                @if($evolucao->date instanceof \Carbon\Carbon)
                    {{ $evolucao->date->format('d/m/Y') }}
                @else
                    {{ \Carbon\Carbon::parse($evolucao->date)->format('d/m/Y') }}
                @endif
            </p>
            <p>{{ $evolucao->description }}</p>
        </div>
        @endforeach
    </div>
    @endif

    <div class="footer">
        <p>Profissional: {{ $anamnese->professional->name }}</p>
        <p>Gerado em: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>

