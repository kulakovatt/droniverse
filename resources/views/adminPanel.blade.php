<div class="hello">
    Привет, {{ Session::get('login')[0] }}
    <div style="margin-left: 25px"><a href="/signout" class="link">выйти</a></div>
</div>

<div class="admin_container">
    <div class="tabs">

        <div class="tab">
            <button class="tablinks" onclick="openCity(event, '1')">Товары</button>
            <button class="tablinks" onclick="openCity(event, '2')">Добавление товара</button>
            <button class="tablinks" onclick="openCity(event, '3')">Комплектация</button>
            <button class="tablinks" onclick="openCity(event, '4')">Изображения</button>
            <button class="tablinks" onclick="openCity(event, '5')">Мастер-классы</button>
            <button class="tablinks" onclick="openCity(event, '6')">Добавление мастер-класса</button>
        </div>

        <div id="1" class="tabcontent">
            <div class="tab_cont">
                <div class="item">
                    <div class="row">
                        <p style="width: fit-content">Наименование</p>
                        <select style="width: 100%" class="js-select2" id="members" name="product_member"
                                placeholder="Выберите наименование товара">
                            <option value=""></option>
                            @foreach($products as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="edit"></div>
                    <div class="row">
                        <button class="button edit">изменить</button>
                        <button class="button delete">удалить</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="2" class="tabcontent">
            <div class="template">
                <p>Шаблон для заполнения характеристик: <br>
                    Вес: ...г | Время полёта: ...мин | Дальность полёта: ...км | Влагозащита: IP43 | Видеоразрешение: 1080p/30fps |
                    Камера: 48МП | Матрица: ... | Диафграма: f/2.8 | Особенности: ...
                </p>
            </div>
            <div class="alert-danger"><ul id="alert-product"></ul></div>
            <div class="tab_cont">
                <div class="item">
                    <div id="edit">
                        <div class="row">
                            <label for="name">Наименование</label>
                            <input type="text" name="name">
                        </div>
                        <div class="row">
                            <label for="brand">Бренд</label>
                            <input type="text" name="brand">
                        </div>
                        <div class="row">
                            <label for="model">Модель</label>
                            <input type="text" name="model">
                        </div>
                        <div class="row">
                            <label for="thumbnail">Изображение</label>
                            <input type="file" name="thumbnail">
                        </div>
                        <div class="row">
                            <label for="description">Описание</label>
                            <textarea name="description"></textarea>
                        </div>
                        <div class="row">
                            <label for="price">Цена</label>
                            <input type="text" name="price">
                        </div>
                        <div class="row"><small style="color: #2E5CFE">(целое или дробное число через точку)</small>
                        </div>
                        <div class="row">
                            <label for="count">Количество</label>
                            <div id="number">
                                <input type="number" name="count">
                            </div>
                        </div>
                        <div class="row">
                            <label for="characteristics">Характеристики</label>
                            <textarea name="characteristics"></textarea>
                        </div>
                        <div class="row"><small style="color: #2E5CFE ">(заполнять по шаблону)</small></div>
                        <div class="row checkbox">
                            <label for="equipment">Комплектация</label>
                            <div id="checkbox">
                                <input type="checkbox" name="equipment">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="button add">добавить</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="3" class="tabcontent">
            <div class="alert-danger"><ul id="alert-equipment"></ul></div>
            <div class="tab_cont">
                <div class="item">
                    <div class="row">
                        <p style="width: fit-content;white-space: nowrap;">Наименование товара</p>
                        <select style="width: 100%" class="js-select2" id="members-equipment" name="product_member-equipment"
                                placeholder="Выберите наименование товара">
                            <option value=""></option>
                            @foreach($products as $item)
                                @if($item->equipment == 1)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <label for="name-equipment" style="white-space: nowrap">Название предмета входящего в комплект</label>
                        <input type="text" name="name-equipment">
                    </div>
                    <div class="row">
                        <label for="thumbnail-equipment">Изображение</label>
                        <input type="file" name="thumbnail-equipment">
                    </div>
                    <div class="row">
                        <label for="count-equipment">Количество</label>
                        <input type="number" name="count-equipment">
                    </div>
                    <div class="row">
                        <button class="button add-equipment">добавить</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="4" class="tabcontent">
            <div class="alert-danger"><ul id="alert-images"></ul></div>
            <div class="tab_cont">
                <div class="item">
                    <div class="row">
                        <p style="width: fit-content;white-space: nowrap;">Наименование товара, к которому добавляется изображение</p>
                        <select style="width: 100%" class="js-select2" id="members-images" name="product_member-images"
                                placeholder="Выберите наименование товара">
                            <option value=""></option>
                            @foreach($products as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <label for="type-images">Предназначение изображения</label>
                        <input type="text" name="type-images">
                    </div>
                    <div class="row">
                        <label for="thumbnail-images">Изображение</label>
                        <input type="file" name="thumbnail-images">
                    </div>
                    <div class="row">
                        <button class="button add-images">добавить</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="5" class="tabcontent">
            <div class="tab_cont">
                <div class="item">
                    <div class="row">
                        <p style="width: fit-content;white-space: nowrap;">Название мастер-класса</p>
                        <select style="width: 100%" class="js-select2" id="members-training" name="product_member-training"
                                placeholder="Выберите название мастер-класса">
                            <option value=""></option>
                            @foreach($trainings as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="edit-training"></div>
                    <div class="row">
                        <button class="button edit-training">изменить</button>
                        <button class="button delete-training">удалить</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="6" class="tabcontent">
            <div class="alert-danger"><ul id="alert-training"></ul></div>
            <div class="tab_cont">
                <div class="item">
                    <div id="edit">
                        <div class="row">
                            <label for="name">Название</label>
                            <input type="text" name="name-2">
                        </div>
                        <div class="row">
                            <label for="description">Описание</label>
                            <textarea name="description-2"></textarea>
                        </div>
                        <div class="row">
                            <label for="count">Количество мест</label>
                            <div id="number">
                                <input type="number" name="count-2">
                            </div>
                        </div>
                        <div class="row">
                            <label for="address">Адрес</label>
                            <input type="text" name="address-2">
                        </div>
                        <div class="row">
                            <label for="date">Дата</label>
                            <input type="date" name="date-2" min="{{ $now_date }}">
                        </div>
                        <div class="row">
                            <label for="time">Время</label>
                            <input type="time" name="time-2">
                        </div>
                        <div class="row">
                            <label for="thumbnail">Изображение</label>
                            <input type="file" name="thumbnail-2">
                        </div>
                    </div>
                    <div class="row">
                        <button class="button add-training">добавить</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@section('other-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/ajax-admin.js') }}"></script>
    <script>
        $(document).ready(function() {
            !function(){if(jQuery&&jQuery.fn&&jQuery.fn.select2&&jQuery.fn.select2.amd)var n=jQuery.fn.select2.amd;n.define("select2/i18n/ru",[],function(){function n(n,e,r,u){return n%10<5&&n%10>0&&n%100<5||n%100>20?n%10>1?r:e:u}return{errorLoading:function(){return"Невозможно загрузить результаты"},inputTooLong:function(e){var r=e.input.length-e.maximum,u="Пожалуйста, введите на "+r+" символ";return u+=n(r,"","a","ов"),u+=" меньше"},inputTooShort:function(e){var r=e.minimum-e.input.length,u="Пожалуйста, введите ещё хотя бы "+r+" символ";return u+=n(r,"","a","ов")},loadingMore:function(){return"Загрузка данных…"},maximumSelected:function(e){var r="Вы можете выбрать не более "+e.maximum+" элемент";return r+=n(e.maximum,"","a","ов")},noResults:function(){return"Совпадений не найдено"},searching:function(){return"Поиск…"},removeAllItems:function(){return"Удалить все элементы"},removeItem:function(){return"Удалить элемент"},search:function(){return"Поиск"}}}),n.define,n.require}();
            $('.js-select2').select2({
                maximumSelectionLength: 3,
                language: "ru"
            });
        });
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
@endsection
