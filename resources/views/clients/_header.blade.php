<?php
/**
 * Файл-шаблон шабки для раздела "Клиенты"
 */
?>
@section('header')
    <ul>
        <li>{{Html::link(route('clients.create'), trans('client.new_client'), ['class' => 'create-modal', 'data-url' => route('clients.create')])}}</li>
    </ul>
@stop
