/**
 * Created by vkazalin on 20.01.2017.
 */
$(document).ready(function() {
    $('select').material_select();

    $('a.modal').click(function (e) {
        e.preventDefault();
        var url = $(this).data('url');

        $('#modal-1').load(url);
    });
});