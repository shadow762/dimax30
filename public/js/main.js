/**
 * Created by vkazalin on 20.01.2017.
 */
$(document).ready(function() {
    $('select').material_select();

    $('body').on('dblclick', '.create-modal-dbl', function (e) {
        e.preventDefault();
        var url = $(this).data('url');

        $('#modal-1').load(url);
    });
    $('body').on('click', '.create-modal', function (e) {
        e.preventDefault();
        var url = $(this).data('url');

        $('#modal-1').load(url);
    });
    $('body').on('submit', 'form', function () {
        e.preventDefault();
        alert('form send');
    })
});