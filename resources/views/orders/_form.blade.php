<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 18.01.2017
 * Time: 16:52
 */
?>
<div class="input-field col s12">
    {{ Form::label('sn', 'Серийный номер') }}
    {{ Form::text('sn') }}
</div>
<div class="input-field col s12">
    {{ Form::label('description', 'Описание') }}
    {{ Form::text('description') }}
</div>
@if(isset($statuses))
<div class="input-field col s12">
    {{ Form::select('status_id', $statuses, null, ['placeholder' => 'Выберите статус', 'required']) }}
</div>
@endif
@if(isset($clients))
    <div class="input-field col s12">
        {{ Form::select('client_id', $clients, null, ['placeholder' => 'Выберите клиента', 'required']) }}
    </div>
@endif
<script>
    $(document).ready(function () {
        $.Modal();
    });

</script>
<!-- TODO реализовать выбор модели устройства-->
<!-- TODO реализовать поле предоплаты -->
