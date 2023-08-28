@extends('layouts.app')

@section('title-page')Droniverse | Обучение@endsection
@section('other-style')
    <link rel="stylesheet" href="{{ asset("css/studing.css") }}">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
@endsection
@section('content')
<div class="ag-timeline-block">
    <div class="ag-timeline_title-box">
        <div class="sample-2">
            <p>Первое знакомство с дроном</p>
        </div>
    </div>
    <section class="ag-section">
        <div class="ag-format-container">
            <div class="js-timeline ag-timeline">
                <div class="js-timeline_line ag-timeline_line">
                    <div class="js-timeline_line-progress ag-timeline_line-progress"></div>
                </div>
                <div class="ag-timeline_list">
                    <div class="js-timeline_item ag-timeline_item">
                        <div class="ag-timeline-card_box">
                            <div class="js-timeline-card_point-box ag-timeline-card_point-box">
                                <div class="ag-timeline-card_point">1</div>
                            </div>
                            <div class="ag-timeline-card_meta-box">
                                <div class="ag-timeline-card_meta">Распаковка</div>
                            </div>
                        </div>
                        <div class="ag-timeline-card_item">
                            <div class="ag-timeline-card_inner">
                                <div class="ag-timeline-card_img-box">
                                    <video width="100%" height="100%" autoplay loop muted controls>
                                        <source src="{{ asset("video/Unboxing.mp4") }}" type="video/mp4">
                                    </video>
                                </div>
                                <div class="ag-timeline-card_info">
                                    <div class="ag-timeline-card_title">Распаковка дрона</div>
                                    <div class="ag-timeline-card_desc">
                                        Перед началом распаковки дрона убедитесь, что у вас есть все необходимые компоненты и инструменты.
                                        Распакуйте коробку осторожно, избегая повреждения дрона или его комплектующих.
                                        Далее, проверьте, что в комплекте находятся все запчасти и аксессуары, указанные в инструкции.
                                        Распаковку можно завершить, установив батареи в пульт дистанционного управления.
                                    </div>
                                </div>
                            </div>
                            <div class="ag-timeline-card_arrow"></div>
                        </div>
                    </div>

                    <div class="js-timeline_item ag-timeline_item">
                        <div class="ag-timeline-card_box">
                            <div class="ag-timeline-card_meta-box">
                                <div class="ag-timeline-card_meta">Первое включение</div>
                            </div>
                            <div class="js-timeline-card_point-box ag-timeline-card_point-box">
                                <div class="ag-timeline-card_point">2</div>
                            </div>
                        </div>
                        <div class="ag-timeline-card_item">
                            <div class="ag-timeline-card_inner">
                                <div class="ag-timeline-card_img-box">
                                    <video width="100%" height="100%" autoplay loop muted controls>
                                        <source src="{{ asset("video/Setup.mp4") }}" type="video/mp4">
                                    </video>
                                </div>
                                <div class="ag-timeline-card_info">
                                    <div class="ag-timeline-card_title">Настройка</div>
                                    <div class="ag-timeline-card_desc">
                                        Установите батарею в дрон и зарядите ее полностью.
                                        Установите приложение для управления дроном на свой мобильный телефон или планшет.
                                        Установить карту памяти в дрон.
                                        Включите дрон и подключите его к мобильному устройству через Wi-Fi или Bluetooth.
                                        Запустите приложение и выполните настройку соединения между дроном и мобильным устройством.
                                        Проверьте, что дрон и приложение работают корректно.
                                    </div>
                                </div>
                            </div>
                            <div class="ag-timeline-card_arrow"></div>
                        </div>
                    </div>

                    <div class="js-timeline_item ag-timeline_item">
                        <div class="ag-timeline-card_box">
                            <div class="js-timeline-card_point-box ag-timeline-card_point-box">
                                <div class="ag-timeline-card_point">3</div>
                            </div>
                            <div class="ag-timeline-card_meta-box">
                                <div class="ag-timeline-card_meta">Первый полёт</div>
                            </div>
                        </div>
                        <div class="ag-timeline-card_item">
                            <div class="ag-timeline-card_inner">
                                <div class="ag-timeline-card_img-box">
                                    <video width="100%" height="100%" autoplay loop muted controls>
                                        <source src="{{ asset("video/Flight.mp4") }}" type="video/mp4">
                                    </video>
                                </div>
                                <div class="ag-timeline-card_info">
                                    <div class="ag-timeline-card_title">Запуск дрона в небо</div>
                                    <div class="ag-timeline-card_desc">
                                        Перед запуском дрона в небо необходимо выполнить следующие шаги:<br>
                                        1. Проверьте уровень заряда батареи дрона и убедитесь, что он достаточен для полета. <br>
                                        2. Проверьте, что область полета дрона безопасна и нет препятствий, которые могут повредить дрон или привести к аварии.<br>
                                        3. Включите дрон и подключите его к мобильному устройству.<br>
                                        4. Откалибруйте компас и гироскоп дрона в соответствии с инструкцией производителя.<br>
                                        5. Проверьте работу моторов и убедитесь, что они функционируют корректно.<br>
                                        После выполнения этих шагов вы можете запустить дрон в небо. Однако перед запуском убедитесь, что дрон находится в безопасном месте и что нет людей или животных поблизости, чтобы избежать возможных проблем во время полета. Во время полета контролируйте дрон и следите за его положением и уровнем заряда батареи.
                                    </div>
                                </div>
                            </div>
                            <div class="ag-timeline-card_arrow"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="ag-timeline_title-box">
        <div class="sample-3">
            <p>Больше видео на нашем Youtube-канале</p>
            <p><a href="https://www.youtube.com/@DJI"><img src="https://img.icons8.com/ios-filled/50/ff0000/youtube-play.png"/></a></p>
        </div>
    </div>
</div>
@endsection
@section('other-scripts')
    <script src="{{ asset("libs/slick-1.8.1/slick/slick.min.js") }}"></script>
    <script type="text/javascript">
        (function ($) {
            $(function () {


                $(window).on('scroll', function () {
                    fnOnScroll();
                });

                $(window).on('resize', function () {
                    fnOnResize();
                });


                var agTimeline = $('.js-timeline'),
                    agTimelineLine = $('.js-timeline_line'),
                    agTimelineLineProgress = $('.js-timeline_line-progress'),
                    agTimelinePoint = $('.js-timeline-card_point-box'),
                    agTimelineItem = $('.js-timeline_item'),
                    agOuterHeight = $(window).outerHeight(),
                    agHeight = $(window).height(),
                    f = -1,
                    agFlag = false;

                function fnOnScroll() {
                    agPosY = $(window).scrollTop();

                    fnUpdateFrame();
                }

                function fnOnResize() {
                    agPosY = $(window).scrollTop();
                    agHeight = $(window).height();

                    fnUpdateFrame();
                }

                function fnUpdateWindow() {
                    agFlag = false;

                    agTimelineLine.css({
                        top: agTimelineItem.first().find(agTimelinePoint).offset().top - agTimelineItem.first().offset().top,
                        bottom: agTimeline.offset().top + agTimeline.outerHeight() - agTimelineItem.last().find(agTimelinePoint).offset().top
                    });

                    f !== agPosY && (f = agPosY, agHeight, fnUpdateProgress());
                }

                function fnUpdateProgress() {
                    var agTop = agTimelineItem.last().find(agTimelinePoint).offset().top;

                    i = agTop + agPosY - $(window).scrollTop();
                    a = agTimelineLineProgress.offset().top + agPosY - $(window).scrollTop();
                    n = agPosY - a + agOuterHeight / 2;
                    i <= agPosY + agOuterHeight / 2 && (n = i - a);
                    agTimelineLineProgress.css({height: n + "px"});

                    agTimelineItem.each(function () {
                        var agTop = $(this).find(agTimelinePoint).offset().top;

                        (agTop + agPosY - $(window).scrollTop()) < agPosY + .5 * agOuterHeight ? $(this).addClass('js-ag-active') : $(this).removeClass('js-ag-active');
                    })
                }

                function fnUpdateFrame() {
                    agFlag || requestAnimationFrame(fnUpdateWindow);
                    agFlag = true;
                }


            });
        })(jQuery);

    </script>
@endsection
