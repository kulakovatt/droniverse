<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title-page')</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset("css/header_style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/footer_style.css") }}">
    @yield('other-style')
</head>
<body>
<header>
    <div id="header_container" class="header_container">
        <a href="/"><img src="{{ asset("images/Logo.svg") }}" alt="Logo" class="logo"></a>

        <div class="menu_cont">
            <button onclick="open_menu(this)" class="menu_button">
                <div class="btn_el btn_el-1"></div>
                <div class="btn_el btn_el-2"></div>
                <div class="btn_el btn_el-3"></div>
                <div class="btn_el btn_el-4"></div>
            </button>
        </div>
    </div>
</header>
<div id="drop_menu" class="dropdown_menu-off">
    <div class="menu_container">
        <div class="menu_column">
            <div class="menu_block menu_items">
                <a href="/catalog" class="link">#каталог</a>
                <a href="/basket" class="link">#корзина</a>
                <a href="/account" class="link">#личный кабинет</a>

            </div>
            <div class="menu_block">
                <p>droniverse@gmail.com</p>
                <p>+375(44)753-33-01</p>
                <p>г.Минск, ул.Свердлова 13а</p>
            </div>
        </div>

        <div class="menu_column">
            <div class="menu_block menu_items">
                <a href="/about" class="link">#о нас</a>
                <a href="/delivery" class="link">#доставка и оплата</a>
                <a href="/studing" class="link">#обучение</a>
                <a href="/support" class="link">#техническая поддержка</a>
            </div>
            <div class="menu_block">
                @if(empty(Session::get('login')))
                    <a href="/auth" class="link">войти</a>
                    <a href="/reg" class="link">зарегистрироваться</a>
                @else
                    <a href="/signout" class="link">выйти</a>
                @endif
            </div>
        </div>
    </div>
</div>
@yield('content')
<button onclick="topFunction()" id="btn_top" title="Наверх">↑</button>
<footer>
    <div class="footer_container">
        <div class="footer_column">
            <a href="/"><img src="{{ asset("images/Logo.svg") }}" alt="Logo" class="logo"></a>
            <p class="copyright">©2023 Droniverse | Kulakova Tatyana</p>
        </div>
        <div class="footer_column">
            <div class="footer_column_row">
                <a href="/catalog" class="link">каталог</a>
                <a href="/basket" class="link">корзина</a>

                <a href="/account" class="link">личный кабинет</a>
            </div>
            <div class="footer_column_row">
                <p style="display: flex; align-items: center; gap: 8px">
                    <a href="https://www.youtube.com/@DJI" class="link"><img src="https://img.icons8.com/ios/30/1e1e1e/youtube-play--v1.png"/></a>
                    <a href="https://www.instagram.com/djiglobal/" class="link"><img src="https://img.icons8.com/ios/26/1e1e1e/instagram-new--v1.png"/></a>
                </p>
                <p>+375(44)753-33-01</p>
                <p>droniverse@gmail.com</p>
            </div>
        </div>
        <div class="footer_column">
            <div class="footer_column_row">
                <a href="/about" class="link">о нас</a>
                <a href="/delivery" class="link">доставка и оплата</a>
                <a href="/studing" class="link">обучение</a>
                <a href="/support" class="link">техническая поддержка</a>
            </div>
            <div class="footer_column_row">
                @if(empty(Session::get('login')))
                    <a href="/auth" class="link">войти</a>
                    <a href="/reg" class="link">зарегистрироваться</a>
                @else
                    <a href="/signout" class="link">выйти</a>
                @endif
            </div>
        </div>
    </div>

</footer>
<script src="{{ asset("js/script.js") }}"></script>
@yield('other-scripts')
</body>
</html>
