
// var header = document.querySelector("header");
//
// window.addEventListener("scroll", event => {
//     if (window.pageYOffset > 1400){
//         const element = document.querySelector('header');
//         element.classList.add('fixed');
//     } else if (window.pageYOffset < 1000){
//         const element = document.querySelector('header');
//         element.classList.remove('fixed');
//     }
//
// });

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 280 || document.documentElement.scrollTop > 280) {
        document.getElementById("btn_top").style.opacity = "1";
        document.getElementById("btn_top").disabled = false;
        document.getElementById("btn_top").style.cursor = "pointer";
    } else {
        document.getElementById("btn_top").style.opacity = "0";
        document.getElementById("btn_top").style.cursor = "default";
        document.getElementById("btn_top").disabled = true;
    }
}

function topFunction() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // добавляем плавную прокрутку
    });

}

function btn_filter_click(el) {
    if (el.classList.contains("active") && el.classList.contains("filter_button-focus-on")) {
        el.classList.remove('active');
        el.classList.remove('filter_button-focus-on');
    }
    else {
        let parent = document.getElementById('filter_buttons');
        if (parent.hasChildNodes()) {
            let children = parent.childNodes;
            for (let i = 0; i < children.length; i++) {
                let elem = parent.children[i];
                if (!!elem) {
                    if (elem.classList.contains("active"))
                        elem.classList.remove('active');
                    if (elem.classList.contains("filter_button-focus-on"))
                        elem.classList.remove('filter_button-focus-on');
                }
            }
        }

        el.classList.add('active');
        el.classList.add('filter_button-focus-on');
    }

    let parent_selections = document.getElementById('filter_selections');
    if (parent_selections.hasChildNodes()) {
        let children = parent_selections.childNodes;
        for (let i = 0; i < children.length; i++) {
            let elem = parent_selections.children[i];
            if (!!elem) {
                if (elem.classList.contains("active"))
                    elem.classList.remove('active');
                if (elem.classList.contains("filter_selection-focus-on"))
                    elem.classList.remove('filter_selection-focus-on');
            }
        }
    }
}

function btn_selection_click(el) {
    if (el.classList.contains("active") && el.classList.contains("filter_selection-focus-on")) {
        el.classList.remove('active');
        el.classList.remove('filter_selection-focus-on');
    }
    else {
        let parent = document.getElementById('filter_selections');
        if (parent.hasChildNodes()) {
            let children = parent.childNodes;
            for (let i = 0; i < children.length; i++) {
                let elem = parent.children[i];
                if (!!elem) {
                    if (elem.classList.contains("active"))
                        elem.classList.remove('active');
                    if (elem.classList.contains("filter_selection-focus-on"))
                        elem.classList.remove('filter_selection-focus-on');
                }
            }
        }

        el.classList.add('active');
        el.classList.add('filter_selection-focus-on');
    }
}




////////////////////
$('.select').each(function() {
    const _this = $(this),
        selectOption = _this.find('option'),
        selectOptionLength = selectOption.length,
        selectedOption = selectOption.filter(':selected'),
        duration = 450; // длительность анимации

    _this.hide();
    _this.wrap('<div class="select"></div>');
    $('<div>', {
        class: 'new-select',
        text: _this.children('option:disabled').text()
    }).insertAfter(_this);

    const selectHead = _this.next('.new-select');
    $('<div>', {
        class: 'new-select__list'
    }).insertAfter(selectHead);

    const selectList = selectHead.next('.new-select__list');
    for (let i = 1; i < selectOptionLength; i++) {
        $('<div>', {
            class: 'new-select__item',
            html: $('<span>', {
                text: selectOption.eq(i).text()
            })
        })
            .attr('data-value', selectOption.eq(i).val())
            .appendTo(selectList);
    }

    const selectItem = selectList.find('.new-select__item');
    selectList.slideUp(0);
    selectHead.on('click', function() {
        if ( !$(this).hasClass('on') ) {
            $(this).addClass('on');
            selectList.slideDown(duration);

            selectItem.on('click', function() {
                let chooseItem = $(this).data('value');

                $('select').val(chooseItem).attr('selected', 'selected');
                selectHead.text( $(this).find('span').text() );

                selectList.slideUp(duration);
                selectHead.removeClass('on');
            });

        } else {
            $(this).removeClass('on');
            selectList.slideUp(duration);
        }
    });
});



$(document).ready(function() {
    window.addEventListener('resize', (e) => {
        checkWidth();
    });
    function checkWidth() {
        var windowWidth = $('body').innerWidth(),
            elem = $(".similars .slider"); // лучше сохранять объект в переменную, многократно чтобы не насиловать
        // страницу для поиска нужного элемента
        if(windowWidth >= 1200){
            elem.removeClass('multiple-items2');
            elem.removeClass('multiple-items1');
        }
        else if(windowWidth < 1200 && windowWidth >= 800){
            elem.addClass('multiple-items2');
            elem.removeClass('multiple-items1');

            $('.multiple-items2').slick({
                infinite: true,
                dots: true,
                slidesToShow: 2,
                slidesToScroll: 1
            });
        }
        else if(windowWidth < 800){
            elem.removeClass('multiple-items2');
            elem.addClass('multiple-items1');

            $('.multiple-items1').slick({
                infinite: true,
                dots: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        }

    }

    checkWidth(); // проверит при загрузке страницы

    $(window).resize(function(){
        checkWidth(); // проверит при изменении размера окна клиента
    });
});




function btn_trigger(el) {
    let parent = el.parentNode;
    let trigger_div = parent.lastElementChild;
    let arrow = el.lastElementChild;

    if (trigger_div.classList.contains("subMenuTip-block")){
        trigger_div.classList.remove('subMenuTip-block');
        trigger_div.classList.add('subMenuTip-none');
        arrow.classList.remove('arrow_on');
        arrow.classList.add('arrow_off');
    }
    else{
        trigger_div.classList.remove('subMenuTip-none');
        trigger_div.classList.add('subMenuTip-block');
        arrow.classList.remove('arrow_ffn');
        arrow.classList.add('arrow_on');
    }

}

function btn_show_filers(el) {
    let parent_cont = el.parentNode.parentNode.parentNode;
    let filters_container = parent_cont.lastElementChild;
    let arrow = el.lastElementChild;

    if(filters_container.classList.contains("filters_container-block")){
        filters_container.classList.remove('filters_container-block');
        filters_container.classList.add('filters_container-none');
        arrow.classList.remove('arrow_on');
        arrow.classList.add('arrow_off');
    }
    else{
        filters_container.classList.remove('filters_container-none');
        filters_container.classList.add('filters_container-block');
        arrow.classList.remove('arrow_ffn');
        arrow.classList.add('arrow_on');
    }

}

// var slider = document.getElementById("myRange");
// var output = document.getElementById("demo");
// output.innerHTML = slider.value;
//
// slider.oninput = function() {
//     output.innerHTML = this.value;
// }


function open_menu(el) {
    let drop_menu = document.getElementById('drop_menu');
    let header_container = document.getElementById('header_container');
    let h2_cont = document.getElementById('h2_cont');

    if(drop_menu.classList.contains("dropdown_menu")){
        drop_menu.classList.remove('dropdown_menu');
        drop_menu.classList.add('dropdown_menu-off');
        header_container.classList.remove('header-fixed');
        h2_cont.style.paddingTop = '50px'
        el.classList.remove('menu_button-on');
    }
    else{
        drop_menu.classList.remove('dropdown_menu-off');
        drop_menu.classList.add('dropdown_menu');
        header_container.classList.add('header-fixed');
        h2_cont.style.paddingTop = '160px';
        el.classList.add('menu_button-on');
    }
}
