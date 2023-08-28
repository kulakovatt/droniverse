@extends('layouts.app')

@section('title-page')Droniverse | Регистрация@endsection
@section('other-style')
    <link rel="stylesheet" href="{{ asset("css/account_style.css") }}">
    <style>
        .password_cont{
            display: block;
            position: relative;
        }

        .password_cont input{
            display: block;
        }

        .password_cont:after{
            content: attr(data-title);
            position: absolute;
            top: 53px;
            left: 0px;
            width: 410px;
            background: #D9D9D9;
            border-radius: 10px;
            padding: 14px 20px;
            opacity: 0;
            transform: translateY(-20px);
            transition:0.34s linear;
            box-shadow:0 5px 12px #ccc;
            pointer-events: none;
        }

        .password_cont:hover:after{
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endsection
@section('content')
    <section>
        <div class="reg_aut_container">
            <div class="registration">
                <h2>Зарегистрироваться</h2>
                @if($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/reg/submit" method="post">
                    @csrf
                    <div class="inputs_container">
                        <input type="text" placeholder="Логин" name="login">
                        <input type="text" placeholder="Электронная почта" name="email">
                        <label for="password"><i>Пароль должен содержать минимум 7 символов.</i><br><i>Вы можете сгенерировать пароль нажав на кубик.</i></label>
                        <div class="password_cont" data-title="Надёжный пароль должен содержать как минимум
                        1 заглавную и 1 строчную букву, 1 спец.символ, 1 цифру.">
                            <input type="password" placeholder="Пароль" name="password" id="password">
                            <button type="button" id="bones"><img src="{{ asset('images/bones.png') }}" alt=""></button>
                        </div>
                        <div class="password_strength">
                            <div class="color_line_cont">
                                <div id="color_line" class=""></div>
                            </div>
                            <p id="password_status" class="message-red"></p>
                        </div>

                        <input type="password" placeholder="Повторите пароль" name="repeat_password" id="repeat_password">
                    </div>
                    <div class="button_container">
                        <button type="submit" class="slide_from_left">зарегистрироваться</button>
                    </div>
                </form>
                <div class="button_signin_container">
                    <p>У меня есть аккаунт</p>
                    <a href="/auth" class="button">войти в аккаунт <img src="{{ asset("images/Arrow.svg") }}" alt=""></a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('other-scripts')
    <script>
        $('#bones').click(function() {
            $('#password').attr('type','text');
            $('#repeat_password').attr('type','text');
            let low = 'abcdefghijklmnopqrstuvwxyz';
            let upp = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            let numbers = '0123456789';
            let symbols = '!@#$%^&*?+=';

            function rnd(x,y) {
                var num;
                do {
                    num = parseInt(Math.random()*100);
                    if (num >= x && num <= y) break;
                } while (true);
                return(num);
            }

            let znak = [low, upp, numbers, symbols];

            let pass = '';
            for (let j = 0; j < 3; j++){
                for (let i = 0; i < 4; i++) {
                    pass = pass + znak[i][rnd(0, znak[i].length - 1)];
                }
            }

            $('#password').val(pass);
            $('#repeat_password').val(pass);
            $('#color_line').addClass('color_line-green');
            $('#password_status').removeClass('message-red');
            $('#password_status').addClass('message-green');
            $('#password_status').html('Пароль надежный');

        });

        $('#password').change(function () {
            let curr_val = $('#password').val();
            let points = 0;
            let flagL = true;
            let flagU = true;
            let flagN = true;
            let flagS = true;
            if (curr_val.length > 6){
                for (let i = 0; i < curr_val.length; i++) {
                    if (/[a-z]/.test(curr_val[i]) && flagL) {
                        points += 1;
                        flagL = false;
                    }
                    if (/[A-Z]/.test(curr_val[i]) && flagU) {
                        points += 1;
                        flagU = false;
                    }
                    if (/[0-9]/.test(curr_val[i]) && flagN) {
                        points += 1;
                        flagN = false;
                    }
                    if (/[!@#$%^&*?+=]/.test(curr_val[i]) && flagS){
                        points += 1;
                        flagS = false;
                    }
                }

            }

            if (points == 4) {
                $('#color_line').removeClass('color_line-red');
                $('#color_line').removeClass('color_line-yellow');
                $('#color_line').addClass('color_line-green');
                $('#password_status').removeClass('message-red');
                $('#password_status').removeClass('message-yellow');
                $('#password_status').addClass('message-green');
                $('#password_status').html('Пароль надежный');
            } else if (points == 2) {
                $('#color_line').removeClass('color_line-red');
                $('#color_line').removeClass('color_line-green');
                $('#color_line').addClass('color_line-yellow');
                $('#password_status').removeClass('message-red');
                $('#password_status').removeClass('message-green');
                $('#password_status').addClass('message-yellow');
                $('#password_status').html('Пароль средний');
            } else {
                $('#color_line').removeClass('color_line-yellow');
                $('#color_line').removeClass('color_line-green');
                $('#color_line').addClass('color_line-red');
                $('#password_status').removeClass('message-yellow');
                $('#password_status').removeClass('message-green');
                $('#password_status').addClass('message-red');
                $('#password_status').html('Пароль слабый');
            }
        })

        $('#password').on('keyup input', function (){
            $('#password').attr('type','password');
            $('#repeat_password').val('');
            $('#repeat_password').attr('type','password');
            if ($('#password').val() == '') {
                $('#color_line').removeClass('color_line-yellow');
                $('#color_line').removeClass('color_line-green');
                $('#color_line').addClass('color_line-red');
                $('#password_status').removeClass('message-yellow');
                $('#password_status').removeClass('message-green');
                $('#password_status').addClass('message-red');
                $('#password_status').html('Пароль слабый');
            }
        });
    </script>
@endsection
