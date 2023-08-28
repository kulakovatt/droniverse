<div class="hello">
    Привет, {{ Session::get('login')[0] }}
    <div style="margin-left: 25px"><a href="/signout" class="link">выйти</a></div>
</div>
<section>
    <div class="cart_container">
        <div class="cart_items">
            <div class="h2_cont">
                <h2>Заказы</h2>
            </div>
            @foreach($orders as $item)
                <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between; flex-wrap: wrap; gap: 25px">
                    @if($item->status == 0)
                        <div style="color: #12b223;width: 100%">Ожидает подтверждения</div>
                    @elseif($item->status == 1)
                        <div style="color: #12b223;width: 100%">Заказ оформлен</div>
                    @elseif($item->status == 2)
                        <div style="color: #12b223;width: 100%">Заказ выдан</div>
                    @endif
                    <h4 class="number">Заказ №{{ $item->id_order }}</h4>
                    <div>{{ $item->lastname }} {{ $item->firstname }} {{ $item->surname }}<br>{{ $item->phone }}</div>
                    <div>Оплата:
                        @if($item->payment == 'cash')
                            наличными
                        @elseif($item->payment == 'card')
                            картой
                        @endif
                        <br>Доставка:
                        @if($item->delivery == 'pickup')
                            самовывоз
                        @elseif($item->delivery == 'courier')
                            курьером<br>Адрес: {{ $item->address }}<br> Дата доставки: {{ $item->date_delivery }}
                        @endif
                    </div>
                    <h4>{{ $item->sum_price }} руб.</h4>
                        @if($item->status == 0)
                            <button class="confirm">Подтвердить</button>
                            <button class="cancel">Отменить</button>
                        @elseif($item->status == 1)
                            <button class="cancel">Отменить</button>
                            <button class="issued">Выдан</button>
                        @endif
{{--                    <button class="confirm">Подтвердить</button>--}}
{{--                    <button class="cancel">Отменить</button>--}}
{{--                    <button class="issued">Выдан</button>--}}
                </div>
            @endforeach
        </div>
    </div>
</section>
<section>
    <div class="cart_container">
        <div class="cart_items">
            <div class="h2_cont">
                <h2>Мастер-классы</h2>
            </div>
            <div style="width: 100%; display: flex; flex-direction: row; gap: 50px">
            @foreach($trainings as $item)
                <div style="width: fit-content; display: flex; flex-direction: column; flex-wrap: wrap;">
                    <h4 class="number">Мастер-класс "{{ $item->name }}"</h4>
                    <div>Адрес: {{ $item->address }}</div>
                    <div>Дата: {{ date("d.m.Y", strtotime($item->date)) }}</div>
                    <div>Время: {{ date("H:m", strtotime($item->time)) }}</div>
                    <div>Кол-во свободных мест: {{ $item->number_of_seats }}</div>
                    <hr>
                    @foreach($reg_trainings as $el)
                        @if($el->id_training == $item->id)
                            <h4 class="number">{{ $el->firstname }} {{ $el->lastname }}</h4>
                            <hr>
                        @endif
                    @endforeach
                </div>
            @endforeach
            </div>
        </div>
    </div>
</section>
<script>
    $('.confirm').click(function (){

        idOrder = $(this).parent().children('h4[class="number"]').text().split('№').pop();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            url: '{{ route('ConfirmOrder') }}',

            type: "POST",

            data: {id_order: idOrder, "_token": $('meta[name="csrf-token"]').attr('content')},

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success:function(data) {
                $('body').html(data);
            },

            error: function (msg) {

                // console.log(msg);

            }

        });
    });

    $('.issued').click(function (){

        idOrder = $(this).parent().children('h4[class="number"]').text().split('№').pop();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            url: '{{ route('IssuedOrder') }}',

            type: "POST",

            data: {id_order: idOrder, "_token": $('meta[name="csrf-token"]').attr('content')},

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success:function(data) {
                $('body').html(data);
            },

            error: function (msg) {

                console.log(msg);

            }

        });
    });

    $('.cancel').click(function (){

        idOrder = $(this).parent().children('h4[class="number"]').text().split('№').pop();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            url: '{{ route('CancelOrder') }}',

            type: "POST",

            data: {id_order: idOrder, "_token": $('meta[name="csrf-token"]').attr('content')},

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success:function(data) {
                $('body').html(data);
            },

            error: function (msg) {

                // console.log(msg);

            }

        });
    });
</script>
