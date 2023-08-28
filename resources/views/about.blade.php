@extends('layouts.app')

@section('title-page')Droniverse | О нас@endsection
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
            max-width: 60%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        section {
            margin-bottom: 40px;
        }
        @media (max-width: 800px) {
            main {
                max-width: 80%;
            }
        }
        @media (max-width: 560px) {
            main {
                max-width: 90%;
            }
        }
        h2 {
            font-size: 24px;
            margin-top: 0;
            color: #2E5CFE;
        }
        .div-img{
            width: 100%;
        }
        .div-img img{
            width: 100%;
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
        <h1>О нас</h1>
        <main>
            <section>
                <h2>Droniverse Team</h2>
                <p>Мы - команда энтузиастов, которые не только продают дроны, но и самостоятельно занимаются исследованиями в этой области. Вот уже много лет мы работаем в интернет-магазине дронов, и каждый день с удовольствием помогаем нашим клиентам с выбором и покупкой качественного оборудования для создания незабываемых впечатлений.</p>
                <p>Команда нашего магазина состоит из высококвалифицированных специалистов, которые умеют слушать и понимать потребности каждого клиента. Мы гордимся своим опытом и знаниями, которые помогают нам подобрать лучшие решения для каждого заказчика.</p>
                <p>Наша цель - не просто продавать дроны, а помогать людям воплотить свои мечты и идеи в жизнь. Мы знаем, что наши товары могут принести множество удовольствий и пользы, поэтому мы стараемся сделать процесс выбора и покупки максимально комфортным и простым.</p>
                <p>Будьте уверены, что каждый из наших сотрудников - настоящий профессионал своего дела, и мы всегда рады помочь вам в выборе дрона, ответить на вопросы и предоставить полезные советы. Мы настоящая команда единомышленников, которые стремятся делать мир лучше и интереснее, и надеемся, что вы станете частью нашей большой и дружной семьи.</p>
                <div class="div-img">
                    <img src="{{ asset('images/team.webp') }}" style="height: 100%; object-fit: cover">
                </div>
            </section>
            <section>
                <h2>Контакты</h2>
                <p>Если у вас возникли вопросы, вы можете связаться с нами по телефону <a href="tel:+375447533301">+375(44)753-33-01</a> или написать нашему менеджеру на почту <a href="mailto:droniverse@gmail.com">droniverse@gmail.com</a>.</p>
            </section>
        </main>
    </section>
@endsection
