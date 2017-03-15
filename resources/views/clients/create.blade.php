<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 11.01.2017
 * Time: 16:57
 */
?>
@extends('ajax')
@section('content')
<div class="row">
{{ Form::open(['route' => 'clients.store', 'method' => 'post', 'class' => 'col s12 ajax-form', 'data-url' => 'clients']) }}
    @include('clients._form')
{{ Form::close() }}
</div>
@stop