@extends('layouts.app')

@section('title-page')Droniverse | Доставка и оплата@endsection
@section('other-style')
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <style>
        h1 {
            margin: 0;
            font-size: 28px;
            text-align: center;
            font-weight: bold;
            line-height: 36px;
            color: #2E5CFE;
            font-family: Unbounded;
            margin-bottom: 30px;
        }
        main {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        @media (max-width: 800px) {
            main {
                width: 80%;
            }
        }
        @media (max-width: 560px) {
            main {
                width: 90%;
            }
        }
        section {
            margin-bottom: 40px;
        }
        h2 {
            font-size: 24px;
            margin-top: 0;
            color: #2E5CFE;
        }
        p {
            margin: 5px 0 5px 0;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
            text-decoration-line: underline;
        }
        a {
            color: #2e5cfe;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
@endsection
@section('content')
    <section>
        <h1>Доставка и оплата</h1>
        <main>
            <section>
                <h2>Доставка</h2>
                <p>Мы предлагаем осуществляем по всей Беларуси. Доставка абсолютно бесплатная.</p>
                <p>Способы доставки:</p>
                <ul>
                    <li>Курьером - по вашему адресу</li>
                    <li>Самовывоз – в нашем отделении</li>
                </ul>
                <p>Срок доставки составляет от 3 до 7 рабочих дней.</p>
            </section>
            <section>
                <h2>Оплата</h2>
                <p>Мы принимаем оплату следующими способами:</p>
                <ul>
                    <li>Оплата наличными</li>
                    <li>Безналичный расчет</li>
                </ul>
                <p>Оплата проводится при получении товара. При оплате банковской картой мы принимаем карты Visa, Mastercard и Mир.</p>
                <p style="margin-top: 10px"><img src="{{ asset('images/visa-mastercard.png') }}" width="300"></p>
            </section>
        </main>
    </section>
@endsection
