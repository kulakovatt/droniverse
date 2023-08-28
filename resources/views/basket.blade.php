@extends('layouts.app')

@section('title-page')Droniverse | Корзина@endsection
@section('other-style')
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <link href="{{ asset("css/cart_style.css") }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<section>
    <div class="cart_container">
        <div class="cart_items">
            <div class="h2_cont">
                <h2>Корзина</h2>
                <h2 class="count_items"> {{ $count }} шт.</h2>
            </div>

            <div class="items_container">
                <div class="u-repeater u-repeater-1">
                    @foreach($basket as $item)
                        <div class="item">
                            <img class="item_img" src="{{ $item->thumbnail }}" alt="">
                            <div class="item-info">
                                <div class="item-info-header">
                                    <p class="title">#{{ $item->name }}</p>
                                </div>
                                <div class="count_price_cont">
                                    <div class="count_cont">
                                        <button onclick="btn_count_minus(this, {{$item->price}})" class="count">-</button>
                                        <p class="count_text">{{ $item->count }}</p>
                                        <button onclick="btn_count_plus(this, {{$item->price}})" class="count">+</button>
                                    </div>
                                    <p class="price"><span>{{ number_format($item->price * $item->count, 2, '.', '') }}</span> руб.</p>
                                </div>
                            </div>
                            <div class="button_container">
                                <a href="/catalog/product/{{ $item->id }}" class="button">подробнее <img src="{{ asset("images/Arrow.svg") }}" alt=""></a>
                                <button id="remove_btn" onclick="remove_prod(this)">×</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <p><i>Помните, что согласно Указу Президента Республики Беларусь от 25.02.2016 № 81 «Об использовании авиамоделей» были утвержденный Правила использования авиамоделей в Республике Беларусь, постановлением Совета Министров Республики Беларусь от 16.08.2016 №636. Перед покупкой советуем <a href="http://www.government.by/upload/docs/fileaeab4fba05047ee0.PDF" style="color: #2E5CFE; text-decoration-line: underline;">ознакомиться</a>.</i></p>
        </div>

        <div class="order_container">
            <div class="h2_cont" id="basket_cont">
                <h2>Оформление</h2>
            </div>
            <div class="order">
                <div class="row">
                    <p>{{ $count }} шт.</p>
                    <p>{{ number_format($total, 2, '.', ' ')}} руб.</p>
                </div>
                <div class="column">
                    <input type="text" placeholder="Фамилия" id="lastname">
                    <input type="text" placeholder="Имя" id="firstname">
                    <input type="text" placeholder="Отчество" id="surname">
                    <input type="tel" placeholder="Телефон" id="phone">
                </div>
                <div class="column">
                    <p>доставка</p>
                    <div class="radio_cont">
                        <label>
                            курьер
                            <input type="radio" class="modern-radio" value="courier" name="delivery">
                            <span></span>
                        </label>
                        <label>
                            самовывоз
                            <input type="radio" class="modern-radio" value="pickup" name="delivery">
                            <span></span>
                        </label>
                    </div>
                    <div class="button_container">
                        <a href="/delivery" class="button">подробнее о доставке<img src="{{ asset('images/Arrow.svg')}}"
                                                                                    alt=""></a>
                    </div>
                </div>
                <div class="column">
                    <p>оплата</p>
                    <div class="radio_cont">
                        <label>
                            наличными
                            <input type="radio" class="modern-radio" value="cash" name="payment">
                            <span></span>
                        </label>
                        <label>
                            картой
                            <input type="radio" class="modern-radio" value="card" name="payment">
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="to_order">
                <div class="row">
                    <p>скидка - {{ $discount }}%</p>
                </div>
                <div class="row">
                    <p>общая стоимость</p>
                    <p style="white-space: nowrap;" id="total_price">
                        {{ number_format($total - ($total * ($discount/100)), 2, ".", " ") }} руб.</p>
                </div>
                <button id="order_btn" class="slide_from_left" type="submit">заказать</button>
            </div>
        </div>
    </div>
</section>
@endsection
@section('other-scripts')
    @if(session('alert'))
        <script>alert('{{session('alert')}}')</script>
    @endif
    <script>
        var delivery, payment;

        $('input[name="delivery"]').click(function (){
            delivery = $(this).val();
            if($(this).val() == 'courier'){
                $(this).parent().parent().parent().append('<input type="text" placeholder="Адрес" id="address">');
                $(this).parent().parent().parent().append('<input type="date" min="{{ date('Y-m-d') }}" id="date_delivery">');
            } else {
                $(this).parent().parent().parent().children('input').remove();
            }
        });

        $('input[name="payment"]').click(function (){
            payment = $(this).val();
        });

        $('#order_btn').click(function (){
            let lastname, firstname, surname, phone, address, date_delivery, sum_price;
            lastname = $('#lastname').val();
            firstname = $('#firstname').val();
            surname = $('#surname').val();
            phone = $('#phone').val();
            if (delivery == 'courier'){
                address = $('#address').val();
                date_delivery = $('#date_delivery').val();
            } else {
                address = null;
                date_delivery = null
            }
            sum_price = parseFloat($('#total_price').text().replace(/(,| )+/g, '').replace(/[^\d.-]/g, ''));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url: '{{ route('AddOrder') }}',

                type: "POST",

                data: {lastname: lastname, firstname: firstname, surname: surname, phone: phone, "delivery": delivery,
                    address: address, date_delivery: date_delivery, "payment": payment, sum_price: sum_price,
                    "_token": $('meta[name="csrf-token"]').attr('content')},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success:function(data) {
                    $('.alert-danger').remove();
                    $('body').html(data);
                },

                error: function (msg) {
                    $('.alert-danger').remove();
                    $('#basket_cont').after('<div class="alert-danger"></div');
                    $.each(msg.responseJSON.errors, function (index, value){
                        if (value[0].required){
                            $('.alert-danger').append('<p>'+ value[0].required +'</p>');
                        } else {
                            $('.alert-danger').append('<p>'+ value +'</p>');
                        }
                    });
                    console.log(msg)
                }

            });

        });

        function remove_prod(el){
            let href = el.parentNode.querySelector('a').href;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url: '{{ route('RemoveProd') }}',

                type: "POST",

                data: {href: href, "_token": $('meta[name="csrf-token"]').attr('content')},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success:function(data) {
                    $('body').html(data);
                },

                // error: function (msg) {
                //
                //     console.log(msg);
                //
                // }

            });
        }

        function btn_count_plus(el, itemPrice){

            let text_el = el.parentNode.querySelector('p').textContent;
            let new_value = Number(text_el)+1;
            el.parentNode.querySelector('p').textContent = new_value;
            let href = el.parentNode.parentNode.parentNode.parentNode.querySelector('div[class="button_container"]').querySelector('a').href;

            let item_price = itemPrice;
            let new_price = Number(item_price)*new_value;
            if(!Number.isInteger(new_price)){
                el.parentNode.parentNode.lastElementChild.lastElementChild.textContent = new_price.toFixed(2);
            } else {
                el.parentNode.parentNode.lastElementChild.lastElementChild.textContent = new_price;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url: '{{ route('ChangeCount') }}',

                type: "POST",

                data: {count: new_value, href: href, "type": 'plus', "_token": $('meta[name="csrf-token"]').attr('content')},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success:function(data) {
                    $('body').html(data);
                },

                // error: function (msg) {
                //
                //     console.log(msg);
                //
                // }

            });

        }

        function btn_count_minus(el, itemPrice){
            let text_el = el.parentNode.querySelector('p').textContent;

            let price = el.parentNode.parentNode.lastElementChild.lastElementChild.textContent;

            let item_price = itemPrice;

            let new_value;
            let new_price;
            if(text_el>1){
                new_value = Number(text_el)-1;
                new_price = price-item_price;
                if(!Number.isInteger(new_price)){
                    new_price = new_price.toFixed(2)
                }
            }
            else{
                new_value = 1;
                new_price = price;
            }

            el.parentNode.querySelector('p').textContent = new_value;
            el.parentNode.parentNode.lastElementChild.lastElementChild.textContent = new_price;
            let href = el.parentNode.parentNode.parentNode.parentNode.querySelector('div[class="button_container"]').querySelector('a').href;


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url: '{{ route('ChangeCount') }}',

                type: "POST",

                data: {count: new_value, href: href, "type" : 'minus', "_token": $('meta[name="csrf-token"]').attr('content')},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success:function(data) {
                    $('body').html(data);
                },

                // error: function (msg) {
                //
                //     console.log(msg);
                //
                // }

            });
        }
    </script>
@endsection
