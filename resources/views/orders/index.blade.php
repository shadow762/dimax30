<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 16.01.2017
 * Time: 16:59
 */
?>
@extends('app')
@include('orders._header')
@section('content')
    <div class="row" id="orders-block">
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
                <tr v-for="order in orders" class="create-modal-dbl">
                    <td>@{{ order.id }}</td>
                    <td>@{{ order.sn }}</td>
                </tr>
            </tbody>
        </table>

    </div>
@stop
