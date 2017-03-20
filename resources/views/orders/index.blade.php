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
    <style>select{display: block;}</style>
    <style>
        .input-field{position: relative}
        .add-btn{position: absolute; top:0; right: -50px;}
    </style>

    <div class="row" id="orders-block">
        @include('types._modal')
        @include('clients._modal')
        @include('brends._modal')
        @include('models._modal')
        @include('orders._header')
        <section class="new-order-section" v-show="showAddForm">

            {{ Form::open(['route' => 'orders.store', 'method' => 'post', 'class' => 'col s12 ajax-form', '@submit.prevent' => 'createOrder']) }}
            <div class="input-field col s10">
                {{ Form::label('sn', 'Серийный номер') }}
                {{ Form::text('sn', '', ['v-model.lazy' => 'newOrder.sn']) }}
                <span class="error-text" id="sn-error" v-text="errors.get('sn')"></span>
            </div>
            <div class="input-field col s10">
                {{ Form::label('description', 'Описание') }}
                {{ Form::text('description', '', ['v-model.lazy' => 'newOrder.description']) }}
                <span class="error-text" id="description-error" v-text="errors.get('description')"></span>
            </div>
            <div class="input-field col s10 materialized">
                <myselect v-model.lazy="newOrder.status_id" :list="statuses" text="статус"></myselect>
                <span class="error-text" id="status_id-error" v-text="errors.get('status_id')"></span>
            </div>
            <div class="input-field col s10 materialized">
                <myselect v-model.lazy="newOrder.client_id" :list="clients.data" text="клиента"></myselect>
                <span class="error-text" id="client_id-error" v-text="errors.get('client_id')"></span>
                <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="clients.showModal=true"><i class="material-icons">add</i></a>
            </div>
            <div class="input-field col s10">
                <myselect v-model.lazy="newOrder.type_id" :list="types.data" text="тип устройства"></myselect>
                <span class="error-text" id="type_id-error" v-text="errors.get('type_id')"></span>
                <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="types.showModal=true"><i class="material-icons">add</i></a>
            </div>
            <div class="input-field col s10">
                <myselect v-model.lazy="newOrder.brend_id" @change="models.get(newOrder.brend_id)" :list="brends.data" text="бренд"></myselect>
                <span class="error-text" id="brend_id-error" v-text="errors.get('brend_id')"></span>
                <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="brends.showModal=true"><i class="material-icons">add</i></a>
            </div>
            <div class="input-field col s10">
                <myselect v-model.lazy="newOrder.model_id" :list="models.data" text="модель"></myselect>
                <span class="error-text" id="model_id-error" v-text="errors.get('model_id')"></span>
                <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="models.showModal=true"><i class="material-icons">add</i></a>
            </div>
            <div class="input-field col s10">
                {{ Form::label('cost', 'Стоимость') }}
                {{ Form::text('cost', '', ['v-model.lazy' => 'newOrder.cost']) }}
                <span class="error-text" id="cost-error" v-text="errors.get('cost')"></span>
            </div>
            <div class="input-field col s10">
                {{ Form::label('pay', 'Предоплата') }}
                {{ Form::text('pay', '', ['v-model.lazy' => 'newOrder.pay']) }}
                <span class="error-text" id="pay-error" v-text="errors.get('pay')"></span>
            </div>
            <div class="input-field col s10">
                {{ Form::submit('Создать', ['class' => 'btn waves-effect waves-light orange']) }}
            </div>
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
