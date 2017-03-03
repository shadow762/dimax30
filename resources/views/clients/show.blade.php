<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 16.01.2017
 * Time: 14:21
 */
?>
@extends(Request::ajax() ? 'ajax' : 'app')

@section('content')
    <div class="row">
        @include('clients._info')
    </div>
@stop


