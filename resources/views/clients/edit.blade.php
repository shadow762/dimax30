<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 16.01.2017
 * Time: 15:13
 */
?>
@extends('app')

@section('content')
    <div class="row">
        {{ Form::model($client, ['route' => ['clients.update', $client->id], 'method' => 'PUT']) }}
            @include('clients._form')
        {{ Form::close() }}
    </div>
@stop
