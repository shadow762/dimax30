@extends(!Request::ajax() ? 'app' : 'ajax')

@section('content')
    <div class="row">
        {{ Form::open(['route' => 'orders.store', 'method' => 'post', 'class' => 'col s12 ajax-form', 'data-url' => 'orders']) }}
            @include('orders._form')
        {{ Form::submit('Отправить', ['class' => 'btn waves-effect waves-light orange']) }}
        {{ Form::close() }}
    </div>
    <script>//$('form select').material_select();</script>
    @stop
