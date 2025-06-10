<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f9f9;
            color: #333;
            padding: 40px;
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        h2 {
            font-size: 28px;
            margin: 0;
            color: #2c3e50;
            text-align: center;
        }

        .fecha {
            font-size: 14px;
            color: #7f8c8d;
            margin-top: 4px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        th {
            background-color: #34495e;
            color: white;
            padding: 10px;
            text-align: left;
        }

        td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            font-size: 15px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ecf0f1;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 16px;
            color: #2c3e50;
            border-top: 2px solid #ccc;
            padding-top: 15px;
        }

        .footer strong {
            color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte de Ventas</h2>
        <div class="fecha">{{ date('d/m/Y H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $venta->cliente_nombre }}</td>
                <td>{{ number_format($venta->total, 2) }} Bs.</td>
                <td>{{ $venta->fecha_registro }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <strong>Total de ventas realizadas:</strong> {{ number_format($totalGeneral, 2) }} Bs.
    </div>
</body>
</html>