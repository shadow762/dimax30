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
    <span class="error-text" id="name-error"></span>
</div>
<div class="input-field col s12">
    {{ Form::label('phone', 'Номер телефона') }}
    {{ Form::text('phone') }}
    <span class="error-text" id="phone-error"></span>
</div>
<div class="input-field col s12">
    {{ Form::label('email', 'E-mail адрес') }}
    {{ Form::email('email') }}
    <span class="error-text" id="email-error"></span>
</div>
{{ Form::submit('Отправить', ['class' => 'btn waves-effect waves-light orange']) }}