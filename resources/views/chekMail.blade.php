<!DOCTYPE html>
<html>
<head>
    <title>Чек</title>
    <style>
        * {
            font-family: DejaVu Sans;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .non td {
            border: none;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div style="border: 4px #1e1e1e dotted; margin-bottom: 20px">
    <p style="text-align: center"><img src="{{ public_path('images/Logo.png') }}" width="200px"></p>
    <p style="text-align: center">ИНТЕРНЕТ-МАГАЗИН DRONIVERSE</p>
    <p style="text-align: center"><small>г.Минск, ул.Свердлова 13а</small></p>
</div>

<table style="margin-top: 120px">
    <thead>
    <tr>
        <th>Товар</th>
        <th>Кол-во</th>
        <th>Цена</th>
        <th>Итого</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $item)
    <tr>
        <td>{{ $item["name"] }}</td>
        <td>{{ $item["count"] }}</td>
        <td>{{ $item["price"] }} руб.</td>
        <td>{{ $item["count"] * $item["price"] }} руб.</td>
    </tr>
    @endforeach
{{--    <tr>--}}
{{--        <td>Drone 2</td>--}}
{{--        <td>1</td>--}}
{{--        <td>$499.99</td>--}}
{{--        <td>$499.99</td>--}}
{{--    </tr>--}}
    <tr class="non">
        <td></td>
        <td></td>
        <td class="total">Скидка:</td>
        <td class="total">{{ $discount }}%</td>
    </tr>
    <tr class="non">
        <td></td>
        <td></td>
        <td class="total">Общая сумма:</td>
        <td class="total">{{ $sum_price }} руб.</td>
    </tr>
    </tbody>
</table>
<div style="border: 4px #1e1e1e dotted; position: absolute; bottom: 10px; width: 100%">
    <p style="text-align: center">СПАСИБО ЗА ПОКУПКУ!<span style="color: #2E5CFE">&#10084;</span></p>
</div>
</body>
</html>
