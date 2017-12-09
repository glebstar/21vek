/**
 * Created by gleb on 22.06.2017.
 */

$(document.ready = function(){
    $('.vars').hide();
    changeCategory($('#category').val());

    $('#category').on('change', function () {
        $('.vars').hide();
        changeCategory($(this).val());
    });

    $('.j-btn-del-image').off('click');
    $('.j-btn-del-image').on('click', function () {
        if(confirm('Удалить фотографию?')) {
            var submitdata = {
                _token: csrf_token,
                id: $(this).attr('data-object-id'),
                image_id: $(this).attr('data-image-id')
            };

            var _self = $(this);

            $.post('/admin/delimage', submitdata, function (data) {
                _self.closest('.span3').remove();
            }, 'json');
        }

        return false;
    });

    $('.j-bth-toarchive').off('click');
    $('.j-bth-toarchive').on('click', function () {
        if (confirm('Удалить объект в архив?')) {
            var submitdata = {
                _token: csrf_token,
                id: $(this).attr('data-object-id')
            };

            $.post('/admin/toarchive', submitdata, function (data) {
                location.reload();
            }, 'json');
        }
        return false;
    });

    $('.j-bth-fromarchive').off('click');
    $('.j-bth-fromarchive').on('click', function () {
        if (confirm('Вернуть из архива?')) {
            var submitdata = {
                _token: csrf_token,
                id: $(this).attr('data-object-id')
            };

            $.post('/admin/fromarchive', submitdata, function (data) {
                location.reload();
            }, 'json');
        }
        return false;
    });

    $('#fileupload').click(function () {
        $('#progress .progress-bar').css(
            'width', 0
        );
        $('#progressbar').progressbar({
            'value': 0
        });
    });

    $('#fileupload').fileupload({
        url: '/admin/addpostimage',
        dataType: 'json',
        formData: [
            { name: '_token', value: csrf_token },
            { name: 'id', value: object_id}
        ],
        apc: true,
        done: function (e, data) {
            $('#no-photo-alert').hide();
            $.each(data.result.files, function (index, file) {
                $('#photos-here').append('<div class="span3"><img src="/photo/' + file.name + '" style="height: 100px;" /><p><a href="#" data-object-id="' + object_id +'" data-image-id="' + file.id +'" onclick="return deleteImage(this)">удалить</a></p></div>');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progressbar').progressbar({
                'value': progress
            });
            /*
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
            */
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

function changeCategory(category) {
    if (category == 'квартира') {
        $('.area').show();
        $('.rooms').show();
        $('.floor').show();
        $('.floors-total').show();
        $('.built-year').show();
        $('.renovation').show();
    }

    if (category == 'дом') {
        $('.area').show();
        $('.lot-area').show();
        $('.rooms').show();
        $('.floors-total').show();
        $('.built-year').show();
        $('.renovation').show();
    }

    if (category == 'комната') {
        $('.area').show();
        $('.floor').show();
        $('.floors-total').show();
        $('.built-year').show();
        $('.renovation').show();
    }

    if (category == 'участок') {
        $('.lot-area').show();
    }
}

function deleteImage(obj) {
    if(confirm('Удалить фотографию?')) {
        var submitdata = {
            _token: csrf_token,
            id: $(obj).attr('data-object-id'),
            image_id: $(obj).attr('data-image-id')
        };

        var _self = $(obj);

        $.post('/admin/delimage', submitdata, function (data) {
            _self.closest('.span3').remove();
        }, 'json');
    }

    return false;
}