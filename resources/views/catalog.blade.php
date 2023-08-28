@extends('layouts.app')

@section('title-page')Droniverse | Каталог@endsection
@section('other-style')
    <link rel="stylesheet" href="{{ asset("css/catalog_style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/ion.rangeSlider.css") }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
    <section>
        <div class="search_container">
            @csrf
            <input type="text" placeholder="Поиск..." name="search" id="search">
            <button type="submit" id="search_btn"><i class="fa fa-search"></i></button>
        </div>
        <div class="sort_container">
            <div class="filters_button_container">
                <a class="btn_show_filers" onclick="btn_show_filers(this)">фильтрация <span class="arrow arrow_off"></span></a>
            </div>
            <div class="option_container">
                @csrf
                <select class="select" name="language" id="sort">
                    <option disabled>сортировка цены по ...</option>
                    <option value="DESC" id>сортировка цены по убыванию</option>
                    <option value="ASC">сортировка цены по возрастанию</option>
                </select>
            </div>
        </div>
        <div id='filters_container' class="filters_container-none">
            @csrf
            <div class="filter_cont">
                <p class="filter_name">Бренд</p>
                <div class="checkbox-1">
                    @foreach($brands as $key => $brand)
                        <div class="checkbox-value">
                            <input type="checkbox" class="custom-checkbox" id="{{$key}}" name="brand" value="{{$brand->brand}}">
                            <label for="{{$key}}">{{$brand->brand}}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="filter_cont">
                <p class="filter_name">Влагозащита</p>
                <div class="radio_cont">

                    @foreach($uniq_protection as $el)
                        @if($el->protection == 'отсутствует')
                            <label>
                                Отсутствует
                                <input type="radio" class="modern-radio" value="none" name="protection_filter">
                                <span></span>
                            </label>
                        @else
                            <label>
                                {{$el->protection}}
                                <input type="radio" class="modern-radio" value="{{$el->protection}}" name="protection_filter">
                                <span></span>
                            </label>
                        @endif
                    @endforeach

                </div>
            </div>

            <div class="filter_cont">
                <p class="filter_name">Видеоразрешение</p>
                <div class="radio_cont">
                    @foreach($uniq_video as $el)
                        <label>
                            {{$el->video}}
                            <input type="radio" class="modern-radio" value="{{$el->video}}" name="video_filter">
                            <span></span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="filter_cont">
                <p class="filter_name">Камера</p>
                <div class="radio_cont">
                    @foreach($uniq_camera as $el)
                        <label>
                            {{$el->camera}}
                            <input type="radio" class="modern-radio" value="{{$el->camera}}" name="camera_filter">
                            <span></span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="filter_cont">
                <p class="filter_name">Матрица</p>
                <div class="radio_cont">
                    @foreach($uniq_matrix as $el)
                        <label>
                            {{$el->matrix}}
                            <input type="radio" class="modern-radio" value="{{$el->matrix}}" name="matrix_filter">
                            <span></span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="filter_cont">
                <p class="filter_name">Диафрагма</p>
                <div class="radio_cont">
                    @foreach($uniq_aperture as $el)
                        <label>
                            {{$el->aperture}}
                            <input type="radio" class="modern-radio" value="{{$el->aperture}}" name="aperture_filter">
                            <span></span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="filter_cont">
                <p class="filter_name">Особенности</p>
{{--                fpv, возврат домой, слежение--}}
                <div class="radio_cont">
                    @foreach($uniq_peculiarities as $el)
                        <label>
                            {{$el->peculiarities}}
                            <input type="radio" class="modern-radio" value="{{$el->peculiarities}}" name="peculiarities_filter">
                            <span></span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="filter_cont">
                <p class="filter_name">Ценовой диапазон</p>
                <div class="slider_cont">
                    <input type="text" class="js-range-slider" name="my_range" value=""
                           data-type="double"
                           data-min="{{$min}}"
                           data-max="{{$max}}"
                           data-grid="true"/>
                </div>
            </div>

            <div class="filter_cont">
                <p class="filter_name weight" data-title="Вес меньше 250 грамм">Лёгкий</p>
                <div class="toggle_cont">
                    <div class="form_toggle">
                        <div class="form_toggle-item item-1">
                            <input id="fid-1" type="radio" name="lightweight" value="off" checked>
                            <label for="fid-1">Нет</label>
                        </div>
                        <div class="form_toggle-item item-2">
                            <input id="fid-2" type="radio" name="lightweight" value="on">
                            <label for="fid-2">Да</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="filter_cont">
                <p class="filter_name">Время полета</p>
                <div class="radio_cont">
                    <label>
                        < 30 мин
                        <input type="radio" class="modern-radio" value="less" name="time_flight">
                        <span></span>
                    </label>
                    <label>
                        30-40 мин
                        <input type="radio" class="modern-radio" value="between" name="time_flight">
                        <span></span>
                    </label>
                    <label>
                        > 40 мин
                        <input type="radio" class="modern-radio" value="more" name="time_flight">
                        <span></span>
                    </label>
                </div>
            </div>

            <div class="filter_cont">
                <p class="filter_name">Дальность полета</p>
                <div class="radio_cont">
                    @foreach($uniq_flight as $el)
                        <label>
                            {{$el->flight}}
                            <input type="radio" class="modern-radio" value="{{$el->flight}}" name="flight_filter">
                            <span></span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="button_container">
                <button id="filter">Применить</button>
            </div>
            <div class="button_container">
                <button id="filter_reset" style="display: none">Сбросить</button>
            </div>
        </div>
    </section>
    <section>
        <div class="items_container">
            <div class="u-repeater u-repeater-1" id="product-list">
                @include('itemCatalog')
            </div>
        </div>
    </section>
{{--    {{ $data->links('pagination') }}--}}

@endsection
@section('other-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
    <script>
        $(".js-range-slider").ionRangeSlider();

        $(function() {

            $("#search_btn").click(function(){
                var value = $("#search").val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({

                    url: '{{ route('Search') }}',

                    type: "POST",

                    data: {search: value, "_token": $('meta[name="csrf-token"]').attr('content')},

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success:function(data) {
                        if (data == 'Ничего не найдено'){
                            $('#product-list').empty();
                            $('.items_container').append('<p style="text-align: center; width: 100%">'+ data +'</p>');
                        } else {
                            $('.items_container p').remove();
                            $('#product-list').html(data);
                        }
                    },

                    // error: function (msg) {
                    //
                    //     console.log(msg);
                    //
                    // }

                });
            });

            $(".new-select__item").click(function(){
                var value = $(this).data('value');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({

                    url: '{{ route('Sort') }}',

                    type: "POST",

                    data: {sort: value, "_token": $('meta[name="csrf-token"]').attr('content')},

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success:function(data) {
                        $('#product-list').html(data);
                    },

                    // error: function (msg) {
                    //
                    //     console.log(msg);
                    //
                    // }

                });
            });

            var from, to;
            $(".js-range-slider").on("change", function () {
                var $inp = $(this);
                from = $inp.data("from");   // get data from attribute
                to = $inp.data("to");       // get data from attribute

            });

            $('input[type="radio"]').on('change', function (){
                $('#filter_reset').css("display", "block");
            });

            $('#filter_reset').on('click', function (){
                $('input').prop('checked', false);
                $('#filter_reset').css("display", "none");
            })


            $('#filter').on('click', function () {

                var selectedBrands = $('.custom-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                let protection = $('input[name="protection_filter"]:checked').val();
                if (protection == undefined){
                    protection = '';
                }

                let peculiarities = $('input[name="peculiarities_filter"]:checked').val();
                if (peculiarities == undefined){
                    peculiarities = '';
                }

                let camera = $('input[name="camera_filter"]:checked').val();
                if (camera == undefined){
                    camera = '';
                }

                let video = $('input[name="video_filter"]:checked').val();
                if (video == undefined){
                    video = '';
                }

                let aperture = $('input[name="aperture_filter"]:checked').val();
                if (aperture == undefined){
                    aperture = '';
                }

                let matrix = $('input[name="matrix_filter"]:checked').val();
                if (matrix == undefined){
                    matrix = '';
                }

                let time = $('input[name="time_flight"]:checked').val();
                if (time == undefined){
                    time = '';
                }

                let lightweight = $('input[name="lightweight"]:checked').val();
                if (lightweight == 'off'){
                    lightweight = '';
                }

                let flight = $('input[name="flight_filter"]:checked').val();
                if (flight == undefined){
                    flight = '';
                }

                if (selectedBrands.length == 0){
                    selectedBrands = '';
                }


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({

                    url: '{{ route('Filter') }}',

                    type: "POST",

                    data: {brands: selectedBrands, protect: protection, camera: camera, priceFrom: from, priceTo: to,
                        lightweight: lightweight, time: time, flight: flight, aperture: aperture, matrix: matrix,
                        video: video, peculiarities: peculiarities, "_token": $('meta[name="csrf-token"]').attr('content')},

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success:function(data) {
                        if (data == 'Ничего не найдено'){
                            $('#product-list').empty();
                            $('.items_container').append('<p style="text-align: center; width: 100%">'+ data +'</p>');
                        } else {
                            $('.items_container p').remove();
                            $('#product-list').html(data);
                        }
                    },

                    error: function (msg) {

                        console.log(msg)

                    }

                });

            });
        });
    </script>
@endsection
