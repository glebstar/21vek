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