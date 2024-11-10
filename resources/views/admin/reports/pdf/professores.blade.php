<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Professores</title>
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
        <h1>Relatório de Professores</h1>
        <div class="date">Data: {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Total de Turmas</th>
                <th>Turmas</th>
                <th>Data de Cadastro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($professores as $professor)
                <tr>
                    <td>{{ $professor['nome'] }}</td>
                    <td>{{ $professor['email'] }}</td>
                    <td>{{ $professor['total_turmas'] }}</td>
                    <td>{{ $professor['turmas'] }}</td>
                    <td>{{ $professor['created_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
