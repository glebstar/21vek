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