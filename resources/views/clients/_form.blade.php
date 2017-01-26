<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 13.01.2017
 * Time: 16:44
 */
?>
<div class="input-field col s12">
{{ Form::label('name', 'ФИО/Название клиента') }}
{{ Form::text('name') }}
</div>
<div class="input-field col s12">
    {{ Form::label('phone', 'Номер телефона') }}
    {{ Form::text('phone') }}
</div>
<div class="input-field col s12">
    {{ Form::label('email', 'E-mail адрес') }}
    {{ Form::email('email') }}
</div>
{{ Form::submit('Отправить', ['class' => 'btn waves-effect waves-light orange']) }}