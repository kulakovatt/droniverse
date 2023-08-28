@extends('layouts.app')

@section('title-page')Droniverse | Главная@endsection
@section('other-style')
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <link rel="stylesheet" href="{{ asset("libs/slick-1.8.1/slick/slick-theme.css") }}">
    <link rel="stylesheet" href="{{ asset("libs/slick-1.8.1/slick/slick.css") }}">
@endsection
@section('content')
    <section>
        <div class="banner_container">
            <div class="banner">
                <div class="banner_info">
                    <h1 class="h1">Оказывается, <br> летать – это просто.</h1>
                    <p class="banner_text">В каталоге магазина широкий ассортимент дронов, от маленьких недорогих моделей до профессиональных.</p>
                </div>
                <div class="banner_img">
                    <img src="{{ asset("images/img-banner1.png") }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="peculiarities_container">
            <div class="peculiarities">
                <div class="block">
                    <div class="peculiarity_item">
                        <div class="title_cont">
                            <p class="title"><span>&#9679;</span>Тест-драйв</p>
                            <p class="text">Бесплатный тест-драйв дрона перед покупкой</p>
                        </div>
                        <div class="hashtags_cont">
                            <p class="hashtag">#ТЕСТ_ПОЛЁТА</p>
                            <p class="hashtag">#ОБУЧЕНИЕ</p>
                            <p class="hashtag">#ПОМОЩЬ_В_ВЫБОРЕ</p>
                        </div>
                    </div>
                    <div class="h2_cont">
                        <h2>Выбирай <br class="h2-none">нас</h2>
                    </div>
                </div>
                <div class="block">
                    <div class="peculiarity_item">
                        <div class="title_cont">
                            <p class="title"><span>&#9679;</span>Доставка</p>
                            <p class="text">Бесплатная доставка по Минску и в регионы</p>
                        </div>
                        <div class="hashtags_cont">
                            <p class="hashtag">#доставка</p>
                            <p class="hashtag">#самовывоз</p>
                        </div>
                    </div>
                    <div class="peculiarity_item">
                        <div class="title_cont">
                            <p class="title"><span>&#9679;</span>Гарантия</p>
                            <p class="text">Гарантия на дроны – <br class="br-none">12 месяцев</p>
                        </div>
                        <div class="hashtags_cont">
                            <p class="hashtag">#Ремонт</p>
                            <p class="hashtag">#диагностика</p>
                            <p class="hashtag">#техническая_поддержка</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="dji_container">
            <div class="dji_dron">
                <div class="dji_img">
                    <p class="img_hashtag">#DJI_mini_3</p>
                    <img src="{{ asset("images/dron-img-4.jpg") }}" alt="">
                </div>
                <div class="dji_dron_info">
                    <h1 class="dji_dron_title">DJI Mini 3</h1>
                    <p class="dji_dron_text">Компактный сверхлегкий дрон с камерой, созданный для приключений. Он отличается увеличенным временем автономной работы, детализированным видео 4K HDR и функциями, такими как True Vertical Shooting для снимков, оптимизированных для социальных сетей.</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="avata_container">
            <div class="avata_dron">
                <p class="avata_dron_text">Когда вы комбинируете Avata с очками и контроллером движения, полет становится доступным для всех. Испытайте острые ощущения полного погружения с непревзойденной безопасностью и контролем. Примите свою спонтанность и запечатлейте мир вокруг себя. Некоторые из нас были рождены летать.</p>
                <p class="img_hashtag">#DJI_avata</p>
            </div>
        </div>
        <div class="avata-on670">
            <p class="avata_dron_text">Когда вы комбинируете Avata с очками и контроллером движения, полет становится доступным для всех. Испытайте острые ощущения полного погружения с непревзойденной безопасностью и контролем. Примите свою спонтанность и запечатлейте мир вокруг себя. Некоторые из нас были рождены летать.</p>
        </div>
    </section>

    <section>
        <div class="catalog_link_container">
            <div class="catalog_link">
                <div class="column column-1">
                    <div class="catalog_items-1">
                        <div class="catalog_items item_little">
                            <a href="/catalog/product/{{ $products[0]->id }}"><img src="{{ asset($products[0]->thumbnail) }}" alt=""></a>
                            <div class="dron_info">
                                <p class="title">#{{ $products[0]->name }}</p>
                                <p class="price">{{ $products[0]->price }} руб.</p>
                            </div>
                        </div>

                        <div class="catalog_items item_little">
                            <a href="/catalog/product/{{ $products[1]->id }}"><img src="{{ asset($products[1]->thumbnail) }}" alt=""></a>
                            <div class="dron_info">
                                <p class="title">#{{ $products[1]->name }}</p>
                                <p class="price">{{ $products[1]->price }} руб.</p>
                            </div>
                        </div>
                    </div>
                    <div class="button_cont">
                        <a href="/catalog" class="button">каталог <img src="{{ asset("images/Arrow.svg") }}" alt=""></a>
                    </div>
                </div>
                <div class="column">
                    <div class="catalog_items item_big">
                        <a href="/catalog/product/{{ $products[2]->id }}"><img src="{{ asset($products[2]->thumbnail) }}" alt=""></a>
                        <div class="dron_info">
                            <p class="title">#{{ $products[2]->name }}</p>
                            <p class="price">{{ $products[2]->price }} руб.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="h2_cont1">
            <h2>Мастер-классы</h2>
        </div>
        <div id="myModal" class="modal">

            <!-- Содержимое модального окна -->
            <div class="modal-content">
                @if($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/regist-training" method="post">
                    @csrf
                    <h2>Запись</h2>
                    <input type="hidden" value="" id="id_training" name="id_trn">
                    <label for="firtsname">Имя <span style="color: red">*</span></label>
                    <input type="text" name="firstname" required>
                    <label for="lastname">Фамилия <span style="color: red">*</span></label>
                    <input type="text" name="lastname" required>
                    <button style="margin-top: 15px; width: fit-content;" type="submit">Записаться</button>
                </form>
                <span class="close">&times;</span>
            </div>

        </div>
        <div class="master-classes">
            @foreach($trainings as $item)
                <div class="item" id="{{ $item->id }}">
                    <div class="img-div">
                        <img src="{{ asset($item->img) }}" style="width: 100%; height: 100%; object-fit: cover">
                    </div>
                    <div class="more-info">
                        <p><b>«{{$item->name}}»</b></p>
                        <p style="text-align: right">Дата: {{date("d.m.Y", strtotime($item->date))}}<br>Время: {{date("H:i", strtotime($item->time))}}<br>Место: {{ $item->address }}<br> Кол-во мест: {{ $item->number_of_seats }}</p>
                        <div>
                            <button class="myBtn">Записаться</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
    <section>
        <div class="questions_container">
            <div class="questions">
                <div class="h2_cont">
                    <h2>Часто <br class="h2-none">задаваемые <br class="h2-none">вопросы</h2>
                </div>
                <div class="triggers_cont">
                    <div id="trigger0" class="trigger">
                        <a class="trigger_title" onclick="btn_trigger(this)">Есть ли какие-то ограничения на законодательном уровне? <span class="arrow arrow_off"></span></a>
                        <div id="submenu0" class="subMenuTip-none">
                            <p class="trigger_text">Да, основными ограничениями на территории РБ являются: полеты на высоте, превышающей 100 метров от уровня земной (водной)
                                поверхности и использование дронов общей массой более 0,5 килограмма без соответствующей маркировки
                                авиамодели. Полностью ознакомится с правилами использования авиамоделей в Республике Беларусь можно по <a href="http://www.government.by/upload/docs/fileaeab4fba05047ee0.PDF" style="color: #2E5CFE; text-decoration-line: underline;">ссылке</a>.
                            </p>
                        </div>
                    </div>
                    <div id="trigger1" class="trigger">
                        <a class="trigger_title" onclick="btn_trigger(this)">Если я новичок, могу ли я научится управлять дроном? <span class="arrow arrow_off"></span></a>
                        <div id="submenu1" class="subMenuTip-none">
                            <p class="trigger_text">Записавшись на наши мастер-классы, ты получишь все необходимые навыки. А если нет возможности посетить мастер-класс,
                                то можно получить базовые знания в нашем разделе <a href="/studing" style="color: #2E5CFE; text-decoration-line: underline;">Обучение</a>.</p>
                        </div>
                    </div>
                    <div id="trigger2" class="trigger">
                        <a class="trigger_title" onclick="btn_trigger(this)">Как накопить бонусы? <span class="arrow arrow_off"></span></a>
                        <div id="submenu2" class="subMenuTip-none">
                            <p class="trigger_text">За каждый заказ вам начисляется процент скидки, совершив 5 заказов в нашем магазине вы сможете купить дрон за полцены!</p>
                        </div>
                    </div>
                    <div id="trigger3" class="trigger">
                        <a class="trigger_title" onclick="btn_trigger(this)">Что делать если у меня возникли неполадки с дроном? <span class="arrow arrow_off"></span></a>
                        <div id="submenu3" class="subMenuTip-none">
                            <p class="trigger_text">Не переживайте, на нашем сайте есть <a href="/support" style="color: #2E5CFE; text-decoration-line: underline;">чат технической поддержки</a>, вы можете туда обратиться и вам помогут решить проблему.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('other-scripts')
    @if(session('alert'))
    <script>
        alert('{{session('alert')}}')
    </script>
    @endif
    <script src="{{ asset("libs/slick-1.8.1/slick/slick.min.js") }}"></script>
    <script>
        // Получаем модальное окно
        var modal = document.getElementById("myModal");
        var btn;
        // Получаем кнопку, которая открывает модальное окно
        $('.myBtn').click(function (){
           btn = this;
           modal.style.display = "block";
           $('#id_training').val(btn.parentNode.parentNode.parentNode.id)
        });

        // Получаем элемент закрытия (крестик)
        var span = document.getElementsByClassName("close")[0];

        // Когда пользователь кликает на крестик (элемент закрытия), закрываем модальное окно
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Когда пользователь кликает за пределами модального окна, закрываем его
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Обработчик события отправки формы
        document.getElementById('registForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Предотвращаем стандартное поведение отправки формы

            // Получаем значения полей ввода
            var idTraining = document.getElementById('id_training').value;
            var firstname = document.getElementById('firstname').value;
            var lastname = document.getElementById('lastname').value;

            // Создаем объект FormData и добавляем значения полей ввода
            var formData = new FormData();
            formData.append('id_trn', idTraining);
            formData.append('firstname', firstname);
            formData.append('lastname', lastname);

            // Создаем AJAX-запрос
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/regist-training', true);

            // Устанавливаем обработчик события при успешном выполнении запроса
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Обработка успешного ответа от сервера
                    console.log(xhr.responseText);
                }
            };

            // Отправляем запрос на сервер
            xhr.send(formData);
        });
    </script>
@endsection
