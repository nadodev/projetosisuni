<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Turmas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        h1 { text-align: center; color: #333; }
        .header { margin-bottom: 30px; }
        .date { text-align: right; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Turmas</h1>
        <div class="date">Data: {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Professor</th>
                <th>Total de Alunos</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($turmas as $turma)
                <tr>
                    <td>{{ $turma['nome'] }}</td>
                    <td>{{ $turma['professor'] }}</td>
                    <td>{{ $turma['total_alunos'] }}</td>
                    <td>{{ $turma['created_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
