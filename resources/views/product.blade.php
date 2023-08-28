@extends('layouts.app')

@section('other-style')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset("css/item_style.css") }}">
    <link rel="stylesheet" href="{{ asset("libs/slick-1.8.1/slick/slick-theme.css") }}">
    <link rel="stylesheet" href="{{ asset("libs/slick-1.8.1/slick/slick.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title-page')Droniverse | {{ $product->name }}@endsection

@section('content')
    <section>
        <div class="item_container">
            <div class="item_info">
                <h1 class="h1 mob-on">{{ $product->name }}</h1>
                <div class="slider_container">
                    <div class="slider slider-for">
                        @foreach($imagesSlide as $image)
                        <div class="slick-slide">
                            <img src="{{ asset($image->url) }}" alt="">
                        </div>
                        @endforeach
                    </div>
                    <div class="slider slider-nav">
                        @foreach($imagesSlide as $image)
                            <div class="slick-slide">
                                <img src="{{ asset($image->url) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="info">
                    <h1 class="h1 mob-of">{{ $product->name }}</h1>
                    <p class="description">{{ $product->description }}</p>
                    <div class="price_info">
                        <p class="price">{{ $product->price }} руб.</p>
                        <button id="add_basket_btn" class="slide_from_left">добавить в корзину</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="characteristics_container">
            <div class="characteristics_info">
                <div>
                    <h2>Характеристики</h2>
                </div>
                <div class="characteristics">
                    @if(empty($names))
                        @foreach($character as $el)
                            <div class="characteristic_item">
                                <p class="characteristic_name">{{ $el }}</p>
                            </div>
                        @endforeach
                    @endif
                    @for($i = 0; $i < count($names); $i++)
                        <div class="characteristic_item">
                            <p class="characteristic_name">{{ $names[$i] }}</p>
                            <p class="characteristic_value">{{ $values[$i] }}</p>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    @if($product->equipment)
    <section>
        <div class="equipments_container">
            <div class="equipments_info">
                <div>
                    <h2>Комплектация</h2>
                </div>

                <div class="u-repeater u-repeater-1">
                    @foreach($equipment as $elem)
                    <div class="equipment_item">
                        <div class="item_img">
                            <img src="{{ asset($elem->url) }}" width="270" height="270">
                        </div>
                        <div class="item_info">
                            <p class="name">#{{ $elem->name }}</p>
                            <p class="amount">x{{ $elem->count }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    @if(!empty($similar))
    <section class="section_last">
        <div class="similars_container">
            <div class="similars_info">
                <div>
                    <h2>Похожие товары</h2>
                </div>
                <div class="similars">

                    <div class="slider">
                        @foreach($similar as $item)
                        <div class="slick-slide">
                            <div class="item">
                                <img src="{{ asset($item->thumbnail) }}" alt="">
                                <div class="item-info">
                                    <div class="item-info-header">
                                        <p class="title">#{{ $item->name }}</p>
                                        <p class="price">{{ $item->price }} руб.</p>
                                    </div>
                                    <p class="item-description">
                                        {{ $item->characteristics }}
                                    </p>
                                </div>
                                <div class="button_container">
                                    <a href="/catalog/product/{{ $item->id }}" class="button">подробнее <img src="{{ asset("images/Arrow.svg") }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </section>
    @endif
@endsection

@section('other-scripts')
    <script src="{{ asset("libs/slick-1.8.1/slick/slick.min.js") }}"></script>
    <script type="text/javascript">
        $("#add_basket_btn").click(function(){
            var name = $(".info .h1").text();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url: '{{ route('Basket') }}',

                type: "POST",

                data: {name_product: name, "_token": $('meta[name="csrf-token"]').attr('content')},

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success:function(data) {
                    alert(data.success);
                },

                error: function (msg) {
                    alert(msg.responseJSON.error);
                }

            });
        });

        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 2,
            slidesToScroll: 2,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: true,
            focusOnSelect: true
        });

        // $('.multiple-items2').slick({
        //     infinite: true,
        //     dots: true,
        //     slidesToShow: 2,
        //     slidesToScroll: 1
        // });
        // $('.multiple-items1').slick({
        //     infinite: true,
        //     dots: true,
        //     slidesToShow: 1,
        //     slidesToScroll: 1
        // });
    </script>
@endsection
