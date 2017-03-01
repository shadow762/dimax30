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
    });
    /**
     * Скрипт для подгрузки зависимых полей (select)
     *
     * Для select от которых зависят другие поля задавать
     * класс listen-change, data-target = id зависящего поля и data-link - ссылка для получения данных
     *
     * csrf-token будет браться из поля в той же форме, что и прослушиваемый select
     *
     * В ответе ожидается json-объект
     */

    $('body').on('change', 'select.listen-change', function(){
        var target = $('#' + $(this).data('target'));
        target.load(
            $(this).data('link'),
            {'_token' : $(this).closest('form').find('input[name="_token"]').val(), 'id' : $(this).find('option:selected').val()},
            function(data){
                var new_options = '';
                $.each(JSON.parse(data), function(key, value){
                    new_options += '<option value="' + key +'">' + value + '</option>';
                });
                target.append(new_options).material_select();
        });
    });
});