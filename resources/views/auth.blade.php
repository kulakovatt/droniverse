@extends('layouts.app')

@section('title-page')Droniverse | Авторизация@endsection
@section('other-style')
    <link rel="stylesheet" href="{{ asset("css/account_style.css") }}">
@endsection
@section('content')
    <section>
        <div class="reg_aut_container">
            <div class="registration">
                <h2>Войти в аккаунт</h2>
                @if($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/auth/submit" method="post">
                    @csrf
                    <div class="inputs_container">
                        <input type="text" placeholder="Логин" name="login">
                        <input type="password" placeholder="Пароль" name="password">
                    </div>
                    <div class="button_container">
                        <button type="submit" class="slide_from_left">войти</button>
                    </div>
                </form>
                <div class="button_signin_container">
                    <p>У меня нет аккаунта</p>
                    <a href="/reg" class="button">зарегистрироваться <img src="{{ asset("images/Arrow.svg") }}" alt=""></a>
                </div>
            </div>
        </div>
    </section>
@endsection
