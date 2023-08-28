<section>
    <div class="hello">Личный кабинет</div>
    <div class="cart_container">
        <div class="cart_items">
            <div class="h2_cont">
                <h2>Бонусы</h2>
            </div>
            <p>За каждый заказ вы будете накапливать бонусы собирая дрон по частям, за первый заказ - 5%, за второй - 10% и т.д
            Собери дрон полностью и купи новый дрон за полцены! :)</p>
            <div class="bonus-div">
                <img src="{{ asset( $drone_image ) }}" alt="bonus" width="400px">
                <h1>Ваша скидка: {{ $discount }}%</h1>
            </div>
        </div>
    </div>
    <div class="cart_container">
        <div class="cart_items">
            <div class="h2_cont">
                <h2>Заказы</h2>
            </div>
            <p>Для отмены заказа свяжитесь по телефону с нашим менеджером: +375(44)753-33-01</p>
            <div class="div-orders">
            @foreach($orders as $item)
            <div class="div-order">
                @if($item->status == 0)
                    <div style="color: #12b223;width: 100%">Ожидает подтверждения</div>
                @elseif($item->status == 1)
                    <div style="color: #12b223;width: 100%">Заказ оформлен</div>
                @elseif($item->status == 2)
                    <div style="color: #12b223;width: 100%">Заказ выдан</div>
                @endif
                <h4>Заказ №{{ $item->id_order }}</h4>
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
                        курьером<br>Адрес: {{ $item->address }}<br> Дата доставки: {{ \Carbon\Carbon::parse($item->date_delivery)->format('d.m.Y') }}
                    @endif
                </div>
                <h4>{{ $item->sum_price }} руб.</h4>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</section>

