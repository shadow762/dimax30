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
    <span class="error-text" id="name-error" v-text="clients.errors.get('name')"></span>
</div>
<div class="input-field col s12">
    {{ Form::label('phone', 'Номер телефона') }}
    {{ Form::text('phone') }}
    <span class="error-text" id="phone-error" v-text="clients.errors.get('phone')"></span>
</div>
<div class="input-field col s12">
    {{ Form::label('email', 'E-mail адрес') }}
    {{ Form::email('email') }}
    <span class="error-text" id="email-error" v-text="clients.errors.get('email')"></span>
</div>
{{ Form::submit('Отправить', ['class' => 'btn waves-effect waves-light orange']) }}