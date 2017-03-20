<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 13.01.2017
 * Time: 16:44
 */
?>
<div class="input-field col s10">
    <myselect v-model.lazy="models.brend_id" :list="brends.data" text="бренд"></myselect>
    <span class="error-text" id="brend_id-error" v-text="errors.get('brend_id')"></span>
    <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="brends.showModal=true"><i class="material-icons">add</i></a>
</div>
<div class="input-field col s12">
    {{ Form::label('name', 'ФИО/Название клиента') }}
    {{ Form::text('name', '', ['v-model' => 'models.new.name']) }}
    <span class="error-text" id="name-error" v-text="models.errors.get('name')"></span>
</div>
{{ Form::submit('Создать', ['class' => 'btn waves-effect waves-light orange']) }}