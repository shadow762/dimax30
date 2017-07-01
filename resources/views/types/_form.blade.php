<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 13.01.2017
 * Time: 16:44
 */
?>
<div class="input-field col s12">
    {{ Form::label('name', 'Тип устройства') }}
    {{ Form::text('name', '', ['v-model' => 'types.new.name']) }}
    <span class="error-text" id="name-error" v-text="types.errors.get('name')"></span>
</div>
{{ Form::submit('Создать', ['class' => 'btn waves-effect waves-light orange']) }}