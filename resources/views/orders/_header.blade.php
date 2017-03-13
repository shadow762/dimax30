<?php
/**
 * Файл-шаблон шабки для раздела "Заказы"
 */
?>
    <ul>
        <li>{{Html::link(route('orders.create'), trans('order.new_order'), ['@click.prevent' => 'showAddForm=true', 'class' => 'create-modal', 'data-url' => route('orders.create')])}}</li>

    </ul>