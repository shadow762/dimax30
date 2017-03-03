<?php
/**
 * Форма для добавления и редактирования заказов
 */
?>
<div class="input-field col s12">
    {{ Form::label('sn', 'Серийный номер') }}
    {{ Form::text('sn') }}
    <span class="error-text" id="sn-error"></span>
</div>
<div class="input-field col s12">
    {{ Form::label('description', 'Описание') }}
    {{ Form::text('description') }}
    <span class="error-text" id="description-error"></span>
</div>
@if(isset($statuses))
<div class="input-field col s12">
    {{ Form::select('status_id', $statuses, null, ['placeholder' => 'Выберите статус', 'required']) }}
    <span class="error-text" id="status_id-error"></span>
</div>
@endif
@if(isset($clients))
    <div class="input-field col s12">
        {{ Form::select('client_id', $clients, null, ['placeholder' => 'Выберите клиента', 'required']) }}
        <span class="error-text" id="client_id-error"></span>
    </div>
@endif
@if(isset($types))
    <div class="input-field col s12">
        {{ Form::select('type_id',
         $types,
         !empty($current['type']) ? $current['type']->id : null,
          ['placeholder' => trans('order.select_type_device'), 'required', 'class' => 'listen-change', 'data-link' => route('brends.get'), 'data-target' => 'brend-select']) }}
        <span class="error-text" id="type_id-error"></span>
    </div>
    <div class="input-field col s12">
        {{ Form::select('brend_id',
         !empty($brends) ? $brends : array(),
         !empty($current['brend']) ? $current['brend']->id : null,
          ['placeholder' => trans('order.select_brend'), 'required', 'id' => 'brend-select', 'class' => 'listen-change', 'data-link' => route('models.get'), 'data-target' => 'model-select']) }}
        <span class="error-text" id="brend_id-error"></span>
    </div>
    <div class="input-field col s12">
        {{ Form::select('model_id',
         !empty($models) ? $models : array(),
         null,
          ['placeholder' => trans('order.select_model'), 'required', 'id' => 'model-select']) }}
        <span class="error-text" id="model_id-error"></span>
    </div>
    @endif
<div class="input-field col s12">
    {{ Form::label('cost', 'Стоимость') }}
    {{ Form::text('cost') }}
    <span class="error-text" id="cost-error"></span>
</div>
<div class="input-field col s12">
    {{ Form::label('pay', 'Предоплата') }}
    {{ Form::text('pay') }}
    <span class="error-text" id="pay-error"></span>
</div>
