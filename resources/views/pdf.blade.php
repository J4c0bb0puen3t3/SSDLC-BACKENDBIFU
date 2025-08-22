<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mis Incidencias</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Mis Incidencias</h1>
    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Ubicación</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->type }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->description }}</td>
                    <td>{{ $report->status }}</td>
                    <td>{{ $report->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
