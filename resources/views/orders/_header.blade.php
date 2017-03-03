<?php
/**
 * Файл-шаблон шабки для раздела "Заказы"
 */
?>
@section('header')
    <ul>
        <li>{{Html::link(route('orders.create'), trans('order.new_order'), ['class' => 'create-modal', 'data-url' => route('orders.create')])}}</li>
    </ul>
@stop
