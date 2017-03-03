<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 18.01.2017
 * Time: 16:52
 */
print_r($errors);
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
@if(isset($types))
    <div class="input-field col s12">
        {{ Form::select('type_id',
         $types,
         !empty($current['type']) ? $current['type']->id : null,
          ['placeholder' => trans('order.select_type_device'), 'required', 'class' => 'listen-change', 'data-link' => route('brends.get'), 'data-target' => 'brend-select']) }}
    </div>
    <div class="input-field col s12">
        {{ Form::select('brend_id',
         !empty($brends) ? $brends : array(),
         !empty($current['brend']) ? $current['brend']->id : null,
          ['placeholder' => trans('order.select_brend'), 'required', 'id' => 'brend-select', 'class' => 'listen-change', 'data-link' => route('models.get'), 'data-target' => 'model-select']) }}
    </div>
    <div class="input-field col s12">
        {{ Form::select('model_id',
         !empty($models) ? $models : array(),
         null,
          ['placeholder' => trans('order.select_model'), 'required', 'id' => 'model-select']) }}
    </div>
    @endif
<div class="input-field col s12">
    {{ Form::label('cost', 'Стоимость') }}
    {{ Form::text('cost') }}
</div>
<div class="input-field col s12">
    {{ Form::label('pay', 'Предоплата') }}
    {{ Form::text('pay') }}
</div>
