<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 16.01.2017
 * Time: 15:13
 */
?>
@extends(Request::ajax() ? 'ajax' : 'app')

@section('content')
    <div class="row">
        {{ Form::model($client, ['route' => ['clients.update', $client->id], 'method' => 'PUT', 'class' => 'col s12 ajax-form', 'data-url' => route('clients.update', ['id' => $client->id])]) }}
            @include('clients._form')
        {{ Form::close() }}
    </div>
@stop
