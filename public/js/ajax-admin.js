$('#members, #members-equipment, #members-images').on('select2:select', function(e) {
    var data = e.params.data.text;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: '/admin-get',

        type: "GET",

        data: {name: data},

        traditional: true,

        success:function(data) {
            $('#edit').html(data);
        },

        error: function (msg) {

            alert('Ошибка');

        }

    });
});
$('#members-training').on('select2:select', function(e) {
    var data = e.params.data.text;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: '/admin-get-training',

        type: "GET",

        data: {name: data},

        traditional: true,

        success:function(data) {
            $('#edit-training').html(data);
        },

        error: function (msg) {

            alert('Ошибка');

        }

    });
});
$('.add').click(function (){

    let name = $('input[name="name"]').val();
    let brand = $('input[name="brand"]').val();
    let model = $('input[name="model"]').val();
    let thumbnail = $('input[name="thumbnail"]').val().split('\\').pop();
    let description = $('textarea[name="description"]').val();
    let price = $('input[name="price"]').val();
    let count = $('input[name="count"]').val();
    let characteristics = $('textarea[name="characteristics"]').val();
    let equipment;
    if ($('input[name="equipment"]').is(':checked')){
        equipment = 1;
    } else {
        equipment = 0;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: '/account/add',

        type: "POST",

        data: {name: name, model: model, brand: brand, thumbnail: thumbnail, description: description,
            price: price, count: count, characteristics: characteristics, equipment: equipment, "_token": $('meta[name="csrf-token"]').attr('content')},

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(data) {
            alert(data);
            $('input[name="name"]').val('');
            $('input[name="brand"]').val('');
            $('input[name="model"]').val('');
            $('input[name="thumbnail"]').val('')
            $('textarea[name="description"]').val('');
            $('input[name="price"]').val('');
            $('input[name="count"]').val('');
            $('textarea[name="characteristics"]').val('');
        },

        error: function (msg) {
            $('#alert-product').empty();
            for(let key in msg.responseJSON.errors){
                $('#alert-product').append('<li>'+ msg.responseJSON.errors[key][0] +'</li>');
            }
            // console.log(msg);

        }

    });
});
$('.edit').click(function (){

    let name = $('input[name="name-1"]').val();
    let brand = $('input[name="brand-1"]').val();
    let model = $('input[name="model-1"]').val();
    let thumbnail = $('input[name="thumbnail-1"]').val().split('\\').pop();
    let description = $('textarea[name="description-1"]').val();
    let price = $('input[name="price-1"]').val();
    let count = $('input[name="count-1"]').val();
    let characteristics = $('textarea[name="characteristics-1"]').val();
    let equipment;
    if ($('input[name="equipment-1"]').is(':checked')){
        equipment = 1;
    } else {
        equipment = 0;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: '/account/edit',

        type: "POST",

        data: {name: name, model_prod: model, brand: brand, thumbnail: thumbnail, description: description,
            price: price, count: count, characteristics: characteristics, equipment: equipment, "_token": $('meta[name="csrf-token"]').attr('content')},

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(data) {
            alert(data);
            $('#edit').empty();
            $('#members').val(null).trigger('change');
        },

        // error: function (msg) {
        //
        //     console.log(msg);
        //
        // }

    });
});
$('.delete').click(function (){

    let name = $('input[name="name-1"]').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: '/account/delete',

        type: "POST",

        data: {name: name, "_token": $('meta[name="csrf-token"]').attr('content')},

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(data) {
            alert(data);
            $('#edit').empty();
            $('#members').val(null).trigger('change');
        },

        // error: function (msg) {
        //
        //     console.log(msg);
        //
        // }

    });
});
$('.add-equipment').click(function (){
    let id_prod = $('#members-equipment').val();
    let name = $('input[name="name-equipment"]').val();
    let thumbnail = $('input[name="thumbnail-equipment"]').val().split('\\').pop();
    let count = $('input[name="count-equipment"]').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: '/account/add-equipment',

        type: "POST",

        data: {id: id_prod, name: name, thumbnail: thumbnail, count: count, "_token": $('meta[name="csrf-token"]').attr('content')},

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(data) {
            alert(data);
            $('input[name="name-equipment"]').val('');
            $('input[name="thumbnail-equipment"]').val('');
            $('input[name="count-equipment"]').val('');
        },

        error: function (msg) {
            $('#alert-equipment').empty();
            for(let key in msg.responseJSON.errors){
                $('#alert-equipment').append('<li>'+ msg.responseJSON.errors[key][0] +'</li>');
            }
            // console.log(msg);

        }

    });
});
$('.add-images').click(function (){
    let id_prod = $('#members-images').val();
    let type = $('input[name="type-images"]').val();
    let thumbnail = $('input[name="thumbnail-images"]').val().split('\\').pop();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: '/account/add-images',

        type: "POST",

        data: {id: id_prod, type: type, thumbnail: thumbnail, "_token": $('meta[name="csrf-token"]').attr('content')},

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(data) {
            alert(data);
            $('input[name="type-images"]').val('');
            $('input[name="thumbnail-images"]').val('');
        },

        error: function (msg) {
            $('#alert-images').empty();
            for(let key in msg.responseJSON.errors){
                $('#alert-images').append('<li>'+ msg.responseJSON.errors[key][0] +'</li>');
            }
            // console.log(msg);

        }

    });
});
$('.add-training').click(function (){

    let name = $('input[name="name-2"]').val();
    let address = $('input[name="address-2"]').val();
    let date = $('input[name="date-2"]').val();
    let time = $('input[name="time-2"]').val();
    let thumbnail = $('input[name="thumbnail-2"]').val().split('\\').pop();
    let description = $('textarea[name="description-2"]').val();
    let count = $('input[name="count-2"]').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: '/account/add-training',

        type: "POST",

        data: {name: name, address: address, date: date, thumbnail: thumbnail, time: time,
            description: description, count: count, "_token": $('meta[name="csrf-token"]').attr('content')},

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(data) {
            alert(data);
            $('input[name="name-2"]').val('');
            $('input[name="address-2"]').val('');
            $('input[name="date-2"]').val('');
            $('input[name="time-2"]').val('');
            $('input[name="thumbnail-2"]').val('')
            $('textarea[name="description-2"]').val('');
            $('input[name="count-2"]').val('');
        },

        error: function (msg) {
            $('#alert-training').empty();
            for(let key in msg.responseJSON.errors){
                $('#alert-training').append('<li>'+ msg.responseJSON.errors[key][0] +'</li>');
            }
            // console.log(msg);

        }

    });
});
$('.edit-training').click(function (){

    let name = $('input[name="name-2"]').val();
    let address = $('input[name="address-2"]').val();
    let date = $('input[name="date-2"]').val();
    let time = $('input[name="time-2"]').val();
    let thumbnail = $('input[name="thumbnail-2"]').val().split('\\').pop();
    let description = $('textarea[name="description-2"]').val();
    let count = $('input[name="count-2"]').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: '/account/edit-training',

        type: "POST",

        data: {name: name, address: address, date: date, thumbnail: thumbnail, time: time,
            description: description, count: count, "_token": $('meta[name="csrf-token"]').attr('content')},

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(data) {
            alert(data);
            $('#edit-training').empty();
            $('#members-training').val(null).trigger('change');

        },

        // error: function (msg) {
        //
        //     console.log(msg);
        //
        // }

    });
});
$('.delete-training').click(function (){

    let name = $('input[name="name-2"]').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: '/account/delete-training',

        type: "POST",

        data: {name: name, "_token": $('meta[name="csrf-token"]').attr('content')},

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success:function(data) {
            alert(data);
            $('#edit-training').empty();
            $('#members-training').val(null).trigger('change');
        },

        // error: function (msg) {
        //
        //     console.log(msg);
        //
        // }

    });
});
