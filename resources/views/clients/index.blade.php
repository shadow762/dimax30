<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 11.01.2017
 * Time: 16:57
 */
?>
@extends('app')
@include('clients._header')
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
            <tr class="create-modal-dbl" data-url="{{ route('clients.show', ['id' => $client->id]) }}">
                <td>{{ $client->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
            </tr>
        @endforeach
    </table>
@stop