<?php
/**
 * Файл-шаблон шабки для раздела "Заказы"
 */
?>
@section('header')
    <ul>
        <li><a href="{{ route('orders.create') }}">{{trans('order.new_order')}}</a></li>
    </ul>
@stop
