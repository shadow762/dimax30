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
        @include('clients._modal')
        @include('orders._header')
        @include('orders.create')
        @include('orders.edit')
        <div class="table-container">
            <table border="1">
            <thead>
                <tr>
                    <td>Номер</td>
                    <td>Статус</td>
                    <td>Клиент</td>
                    <td>Дата принятия</td>
                    <td>s/n</td>
                    <td>Тип устройства</td>
                    <td>Устройство</td>
                    <td>Принял</td>
                    <td>Ответственный</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" @click="editOrder(order.id)">
                    <td>@{{ order.id }}</td>
                    <td>@{{ order.status }}</td>
                    <td>@{{ order.client_name }}</td>
                    <td>@{{ order.created }}</td>
                    <td>@{{ order.sn }}</td>
                    <td>@{{ order.type }}</td>
                    <td>@{{ order.brend + ' ' + order.model }}</td>
                    <td>@{{ order.creator_name }}</td>
                    <td>@{{ order.resp_name }}</td>
                </tr>
            </tbody>
        </table>
        </div>
        <ul class="pagination clearfix">
            <li :class="pagination.current_page > 1 ? '' : 'disable'">
                <a href="#" aria-label="Previous"
                   @click.prevent="changePage(pagination.current_page - 1)">
                    <i class="material-icons">chevron_left</i>
                </a>
            </li>
            <li v-for="page in pagesNumber"
                v-bind:class="[ page == isActived ? 'disable' : 'waves-effect']">
                <a href="#"
                   @click.prevent="changePage(page)">@{{ page }}</a>
            </li>
            <li :class="pagination.current_page < pagination.last_page ? '' : 'disable'">
                <a href="#" aria-label="Next"
                   @click.prevent="changePage(pagination.current_page + 1)">
                    <i class="material-icons">chevron_right</i>
                </a>
            </li>
        </ul>
    </div>
    <div class="modal-bg" v-if="showEditSection" @click="showEditSection = 0"></div>
@stop
