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
    <div class="row" id="orders-block">
        @include('orders._header')
        <section class="new-order-section" v-show="showAddForm">
            {{ Form::open(['route' => 'orders.store', 'method' => 'post', 'class' => 'col s12 ajax-form', '@submit.prevent' => 'createOrder']) }}
            <div class="input-field col s12">
                {{ Form::label('sn', 'Серийный номер') }}
                {{ Form::text('sn', '', ['v-model.lazy' => 'newOrder.sn']) }}
                <span class="error-text" id="sn-error" v-text="errors.get('sn')"></span>
            </div>
            <div class="input-field col s12">
                {{ Form::label('description', 'Описание') }}
                {{ Form::text('description', '', ['v-model.lazy' => 'newOrder.description']) }}
                <span class="error-text" id="description-error" v-text="errors.get('description')"></span>
            </div>
            <div class="input-field col s12 materialized">
                <myselect v-model="newOrder.status_id" :list="statuses" text="статус">

                </myselect>
                <span class="error-text" id="status_id-error" v-text="errors.get('status_id')"></span>
            </div>
            <div class="input-field col s12">
                <select v-model.lazy="newOrder.type_id">
                    <option v-for="type in types" :value="type.id">@{{ type.name }}</option>
                </select>
                <span class="error-text" id="client_id-error" v-text="errors.get('type_id')"></span>
            </div>
            <div class="input-field col s12">
                <select v-model.lazy="newOrder.brend_id" @change="getDeviceModels(newOrder.brend_id)">
                    <option v-for="brend in brends" :value="brend.id">@{{ brend.name }}</option>
                </select>
                <span class="error-text" id="brend_id-error" v-text="errors.get('brend_id')"></span>
            </div>
            <div class="input-field col s12">
                <select v-model.lazy="newOrder.model_id">
                    <option v-for="model in models" :value="model.id">@{{ model.name }}</option>
                </select>
                <span class="error-text" id="model_id-error" v-text="errors.get('model_id')"></span>
            </div>
            <div class="input-field col s12">
                {{ Form::label('cost', 'Стоимость') }}
                {{ Form::text('cost', '', ['v-model.lazy' => 'newOrder.cost']) }}
                <span class="error-text" id="cost-error" v-text="errors.get('cost')"></span>
            </div>
            <div class="input-field col s12">
                {{ Form::label('pay', 'Предоплата') }}
                {{ Form::text('pay', '', ['v-model.lazy' => 'newOrder.pay']) }}
                <span class="error-text" id="pay-error" v-text="errors.get('pay')"></span>
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
