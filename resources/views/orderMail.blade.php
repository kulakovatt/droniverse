<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Гарантия</title>
    <style>
        /*@font-face {*/
        /*    font-family: 'Montserrat';*/
        /*    font-style: normal;*/
        /*    font-weight: normal;*/
        /*    src: url(https://fonts.googleapis.com/css2?family=Montserrat&display=swap) format('truetype');*/
        /*}*/
        /** {*/
        /*    font-family: Montserrat;*/
        /*}*/
        .container {

            font-family: DejaVu Sans; /* нужный шрифт */

        }
        .header table, .buyer table {
            width: 100%;
            background: none;
            border: none;
        }
        .header table th, .header table tr, .buyer table td, .buyer table tr {
            border: none;
            background: none;
        }
        .header table tr:nth-child(even), .buyer table tr:nth-child(even) {
            background: none;
        }
        .info {
            margin-top: 50px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 0.5em;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .date-table {
            margin-left: auto;
            width: 200px;
        }
        .date-table th, .date-table td {
            text-align: center;
            border-top: none;
        }
        .table-products{
            margin-bottom: 30px;
        }

        .el-salesman div {
            margin-right: 10px;
        }
        .el-buyer div {
            margin-right: 10px;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <table>
            <tr>
                <th>
                    <img src="{{ public_path('images/Logo.png') }}" width="200px">
                </th>
                <th style="text-align: right; color: #2E5CFE;">
                    <p>Гарантийный талон</p>
                </th>
            </tr>
        </table>
    </div>
    <div class="info">
        <p>Гарантийное обслуживание 12 месяцев</p>
    </div>
    <div class="table-products">
        <table>
            <tr>
                <th>Наименование</th>
                <th>Серийный номер</th>
            </tr>
            @foreach($products as $item)
            <tr>
                <td>{{ $item["name"] }}</td>
                <td>{{ $item["serial"] }}</td><!-- TODO: выводить несколько серийных если количество больше одного-->
            </tr>
            @endforeach
{{--            <tr>--}}
{{--                <td>AUTEL EVO MAX 4T</td>--}}
{{--                <td>AT487129</td>--}}
{{--            </tr>--}}
        </table>
        <table class="date-table">
            <tr>
                <th>Дата продажи</th>
            </tr>
            <tr>
                <td>{{ $date }}</td>
            </tr>
        </table>
    </div>
    <div class="buyer">
        <table style="width: 400px">
            <tr>
                <td style="width: 150px;">
                    ФИО покупателя:
                </td>
                <td style="border-bottom: 1px #1e1e1e solid; text-align: center">
                    <div >{{ $fio }}</div>
                </td>
            </tr>
        </table>
    </div>
    <div class="buyer" style="margin-top: 50px">
        <table style="width: 600px">
            <tr >
                <td style="width: 245px;">
                    Подпись и печать продавца:
                </td>
                <td style="border-bottom: 1px #1e1e1e solid; ">
                    <div style="position: relative;">
                        <div style="position: absolute; top: -45px; left: 0;">
                            <img src="{{ public_path("images/podpis.png") }}" width="100px" >
                        </div>
                        <div style="position: absolute; top: -65px; left: 120px;">
                            <img src="{{ public_path('images/print.png') }}" width="150px">
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
