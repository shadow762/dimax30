/**
 * Created by vkazalin on 20.01.2017.
 */
$(document).ready(function() {
    $('.materialized select').material_select();

    $('body').on('dblclick', '.create-modal-dbl', function (e) {
        e.preventDefault();
        var url = $(this).data('url');

        create_modal().load(url, function(){
            $(this).parent().addClass('active');
        });
        //$('#modal-1').load(url);
    });
    $('body').on('click', '.create-modal', function (e) {
        e.preventDefault();
        var url = $(this).data('url');

        create_modal().load(url, function(){
            $(this).parent().addClass('active');
        });
    });
    $('body').on('click', '.modal-close', function(){
        close_modal();
    });
    /*$('body').on('submit', 'form', function () {
        e.preventDefault();
        alert('form send');
    });*/
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
                    new_options += '<li>' + value + '</li>';
                });
                target.find('ul.combo-list').html(new_options);
        });
    });



    /** Скрипт для ajax отправки формы */
    $('body').on('submit', 'form.ajax-form', function(e){
        e.preventDefault();
        console.log('Отправка');
        var data = $(this).serializeArray(),
            url = $(this).attr('action'),
            method = '';
        if($(this).find('input[name="_method"]').is('input')) {
            console.log('indef');
            method = $(this).find('input[name="_method"]').val()
        }
        else {
            console.log('attr');
            method = $(this).attr('method');
        }
        console.log(method);
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            method:method,
            success: function(data){
                if(data.success) {
                    alert('Сохранилось');
                    close_modal();
                }
            },
            error: function(data, msg, err){
                if(err == 'Unprocessable Entity') {
                    $.each(data.responseJSON, function(key, val){
                        var error = '';
                        $.each(val, function(num, text){
                            error += text;
                        });
                        $('#' + key + '-error').html(error);
                    });
                }
            }
        });
    });

});
/** Функция создания модального окна. Id присваевается по порядковому номеру*/
function create_modal() {
    var modals_count = $('.modal-window').length;
    var modal_html = '<div class="modal-window" id="modal-window-' + (modals_count+1) + '"><div class="modal-content"></div><div class="modal-close">Закрыть</div></div>';

    $('body').append(modal_html);

    return $('#modal-window-' + (modals_count+1) + ' .modal-content');
}

/** Функция удаления модального окна. Берется последний по порядку */
function close_modal() {
    var modals_count = $('.modal-window').length;
    $('#modal-window-' + (modals_count)).remove();
}