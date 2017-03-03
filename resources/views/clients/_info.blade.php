<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 16.01.2017
 * Time: 15:14
 */
?>
<div class="row">
    <div class="col s12">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text">
                <span class="card-title">Данные Клиента</span>
                <p>Номер клиента: {{ $client->id }}</p>
                <p>Имя клиента: {{ $client->name }}</p>
                <p>Телефон клиента: {{ $client->phone }}</p>
                <p>email клиента: {{ $client->email }}</p>
            </div>
            <div class="card-action">
                {{ link_to_route(
                    'clients.edit',
                    trans('common.edit'),
                    ['id' => $client->id],
                    ['class' => 'create-modal', 'data-url' => route('clients.edit', ['id' => $client->id])]) }}
                <!-- TODO Доработать после того как разберусь с удалением записей -->
                {{ link_to_route('clients.destroy', trans('common.delete'), ['id' => $client->id]) }}
            </div>
        </div>
    </div>
</div>
