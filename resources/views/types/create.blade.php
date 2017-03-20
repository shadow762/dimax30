@extends('ajax')
@section('content')
    <div class="row">
        {{ Form::open(['route' => 'types.store', 'method' => 'post', 'class' => 'col s12 ajax-form', 'data-url' => 'types', '@submit.prevent' => 'types.create']) }}
        @include('types._form')
        {{ Form::close() }}
    </div>
@stop