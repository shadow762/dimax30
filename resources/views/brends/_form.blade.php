<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 13.01.2017
 * Time: 16:44
 */
?>
<div class="input-field col s12">
    {{ Form::label('name', 'Название бренда') }}
    {{ Form::text('name') }}
    <span class="error-text" id="name-error" v-text="brends.errors.get('name')"></span>
</div>
{{ Form::submit('Создать', ['class' => 'btn waves-effect waves-light orange']) }}