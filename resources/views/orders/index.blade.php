<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 16.01.2017
 * Time: 16:59
 */
?>
@extends('app')

@section('content')
    <div class="row">
        <table>
            <thead>
                <tr>
                    <td>Номер</td>
                    <td>Статус</td>
                    <td>Клиент</td>
                    <td>Дата принятия</td>
                    <td>s/n</td>
                    <td>Устройство</td>
                    <td>Принял</td>
                    <td>Ответственный</td>
                </tr>
            </thead>
            <tbody>

                @foreach($orders as $order)
                    <tr class="create-modal-dbl" data-url="{{ route('orders.show', ['id' => $order->id]) }}">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->client_name }}</td>
                        <td>{{ $order->created }}</td>
                        <td>{{ $order->sn }}</td>
                        <td>{{ $order->model_name }}</td>
                        <td>{{ $order->creator_name }}</td>
                        <td>{{ $order->resp_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@stop
