@foreach($training_data as $el)
    <div class="row">
        <label for="name">Название</label>
        <input type="text" name="name-2" value="{{$el->name}}">
    </div>
    <div class="row">
        <label for="description">Описание</label>
        <textarea name="description-2" >{{$el->description}}</textarea>
    </div>
    <div class="row">
        <label for="count">Количество мест</label>
        <div id="number">
            <input type="number" name="count-2" value="{{$el->number_of_seats}}">
        </div>
    </div>
    <div class="row">
        <label for="address">Адрес</label>
        <input type="text" name="address-2" value="{{$el->address}}">
    </div>
    <div class="row">
        <label for="date">Дата</label>
        <input type="date" name="date-2" value="{{$el->date}}">
    </div>
    <div class="row">
        <label for="time">Время</label>
        <input type="time" name="time-2" value="{{$el->time}}">
    </div>
    <div class="row">
        <label for="thumbnail">Изображение</label>
        <input type="file" name="thumbnail-2">
    </div>
@endforeach
