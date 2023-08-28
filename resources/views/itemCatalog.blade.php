@foreach($data as $item)
    <div class="item">
        <img class="item_img" src="{{ asset($item->thumbnail) }}" alt="">
        <div class="item-info">
            <div class="item-info-header">
                <p class="title">#{{ $item->name }}</p>
                <p class="price">{{ $item->price }} руб.</p>
            </div>
            <p class="item-description">
                {{ mb_strimwidth($item->characteristics, 0, 150, "...") }}
            </p>
        </div>
        <div class="button_container">
            <a href="/catalog/product/{{ $item->id }}" class="button">подробнее <img src="{{ asset("images/Arrow.svg") }}" alt=""></a>
        </div>
    </div>
@endforeach
