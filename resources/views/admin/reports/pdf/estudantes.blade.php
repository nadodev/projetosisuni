<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Estudantes</title>
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
        <h1>Relatório de Estudantes</h1>
        <div class="date">Data: {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Turma</th>
                <th>Categoria</th>
                <th>Data de Cadastro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudantes as $estudante)
                <tr>
                    <td>{{ $estudante['nome'] }}</td>
                    <td>{{ $estudante['email'] }}</td>
                    <td>{{ $estudante['turma'] }}</td>
                    <td>{{ $estudante['categoria'] }}</td>
                    <td>{{ $estudante['created_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
