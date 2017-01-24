<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 18.01.2017
 * Time: 16:49
 */
?>
@extends('app')

@section('content')
    <div class="row">
        {{ Form::open(['route' => 'orders.store', 'method' => 'post'], ['class' => 'col s12', 'data-url' => 'orders']) }}
            @include('orders._form')
        {{ Form::close() }}
    </div>
    @stop
