@foreach($products_data as $el)
<div class="row">
    <label for="name">Наименование</label>
    <input type="text" name="name-1" value="{{$el->name}}">
</div>
<div class="row">
    <label for="brand">Бренд</label>
    <input type="text" name="brand-1" value="{{$el->brand}}">
</div>
<div class="row">
    <label for="model">Модель</label>
    <input type="text" name="model-1" value="{{$el->model_prod}}">
</div>
<div class="row">
    <label for="thumbnail">Изображение</label>
    <input type="file" name="thumbnail-1">
</div>
<div class="row">
    <label for="description">Описание</label>
    <textarea name="description-1" >{{$el->description}}</textarea>
</div>
<div class="row">
    <label for="price">Цена</label>
    <input type="text" name="price-1" value="{{$el->price}}">
</div>
<div class="row"><small style="color: #2E5CFE">(целое или дробное число через точку)</small></div>
<div class="row">
    <label for="count">Количество</label>
    <div id="number">
        <input type="number" name="count-1" value="{{$el->count}}">
    </div>
</div>
<div class="row">
    <label for="characteristics">Характеристики</label>
    <textarea name="characteristics-1">{{$el->characteristics}}</textarea>
</div>
<div class="row"><small style="color: #2E5CFE ">(отделять каждую характеристику вертикальной чертой | , например: Вес: 130г | Скорость:... )</small></div>
<div class="row checkbox">
    <label for="equipment">Комплектация</label>
    <div id="checkbox">
        @if($el->equipment == 1)
        <input type="checkbox" name="equipment-1" checked>
        @else
        <input type="checkbox" name="equipment-1">
        @endif
    </div>
</div>
@endforeach
