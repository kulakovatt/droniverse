@extends('layouts.app')

@section('title-page')Регистрация@endsection
@section('other-style')
    <link rel="stylesheet" href="{{ asset("css/account_style.css") }}">
@endsection
@section('content')
    <section>
        <div class="reg_aut_container">

            <div class="registration">
                <h2>Код подтверждения</h2>
                @if($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/reg/submit/verify" method="post">
                    @csrf
                    <div class="inputs_container">
                        <input type="text" placeholder="Введите код" name="code">
                    </div>
                    <div class="button_container">
                        <button type="submit" class="slide_from_left">подтвердить</button>
                    </div>
                </form>
                <div class="button_signin_container">
                    <p>Не пришел код?</p>
                    <a href="/repeat/send" class="button">отправить код еще раз <img src="{{asset("images/Arrow.svg")}}" alt=""></a>
                </div>
            </div>
        </div>
    </section>
@endsection
