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
    <div class="row" id="orders-block">
        @include('orders._header')
        <section class="new-order-section" v-show="showAddForm">
            {{ Form::open(['route' => 'orders.store', 'method' => 'post', 'class' => 'col s12 ajax-form', '@submit.prevent' => 'createOrder']) }}
            <div class="input-field col s12">
                {{ Form::label('sn', 'Серийный номер') }}
                {{ Form::text('sn', '', ['v-model' => 'newOrder.description']) }}
                <span class="error-text" id="sn-error"></span>
            </div>
            <div class="input-field col s12">
                {{ Form::label('description', 'Описание') }}
                {{ Form::text('description', '', ['v-model' => 'newOrder.description']) }}
                <span class="error-text" id="description-error"></span>
            </div>
            <div class="input-field col s12 materialized">
                <select v-model="newOrder.status_id">
                    <option v-for="status in statuses" :value="status.id">@{{ status.name }}</option>
                </select>
                <span class="error-text" id="status_id-error"></span>
            </div>
            {{ Form::submit('Создать', ['class' => 'btn waves-effect waves-light orange']) }}
            {{ Form::close() }}
        </section>
        <table>
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
                <tr v-for="order in orders" class="create-modal-dbl">
                    <td>@{{ order.id }}</td>
                    <td>@{{ order.status }}</td>
                    <td>@{{ order.client_name }}</td>
                    <td>@{{ order.created }}</td>
                    <td>@{{ order.sn }}</td>
                    <td>@{{ order.type_name }}</td>
                    <td>@{{ order.brend_name + ' ' + order.model_name }}</td>
                    <td>@{{ order.creator_name }}</td>
                    <td>@{{ order.resp_name }}</td>
                </tr>
            </tbody>
        </table>
        <ul class="pagination">
            <li v-if="pagination.current_page > 1">
                <a href="#" aria-label="Previous"
                   @click.prevent="changePage(pagination.current_page - 1)">
                    <i class="material-icons">chevron_left</i>
                </a>
            </li>
            <li v-for="page in pagesNumber"
                v-bind:class="[ page == isActived ? 'active' : 'waves-effect']">
                <a href="#"
                   @click.prevent="changePage(page)">@{{ page }}</a>
            </li>
            <li class="waves-effect" v-if="pagination.current_page < pagination.last_page">
                <a href="#" aria-label="Next"
                   @click.prevent="changePage(pagination.current_page + 1)">
                    <i class="material-icons">chevron_right</i>
                </a>
            </li>
        </ul>
    </div>

@stop
