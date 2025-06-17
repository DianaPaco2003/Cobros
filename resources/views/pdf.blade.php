<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background-color: #ffffff;
            color: #000000;
            padding: 20px;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-bottom: 40px;
        }

        .header-row h2,
        .header-row h3 {
            color: #0d47a1;
            margin: 0;
            z-index: 1;
        }

        

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 8px rgba(13, 71, 161, 0.2);
        }

        th, td {
            border: 1px solid #0d47a1;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e3f2fd;
            color: #0d47a1;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f4f9ff;
        }

        tr:hover {
            background-color: #e1f5fe;
        }
    </style>
</head>
<body>

    <div class="header-row">
        <h2>Reporte de Ventas</h2>
        <div class="diagonal-line"></div>
        <h3>Suma total: {{ $total }}</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nr</th>
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
                <td>{{ $venta->total }}</td>
                <td>{{ $venta->fecha_registro }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>