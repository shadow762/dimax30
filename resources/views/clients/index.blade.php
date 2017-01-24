<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 11.01.2017
 * Time: 16:57
 */
?>
@extends('app')

@section('content')
    <table class="bordered responsive-table highlight">
        <thead>
            <tr>
                <td>Имя</td>
                <td>Телефон</td>
                <td>E-mail</td>
            </tr>
        </thead>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
            </tr>
        @endforeach
    </table>
{{ link_to_route('clients.create', 'create') }}
@stop