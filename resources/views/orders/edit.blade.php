@extends(!Request::ajax() ? 'app' : 'ajax')

@section('content')
    <div class="row">
        {{ Form::model(
            $order,
            ['route' => ['orders.update', $order->id], 'method' => 'PUT', 'class' => 'col s12 ajax-form', 'data-url' => route('orders.update', ['id' => $order->id])])
        }}
            @include('orders._form')
        {{ Form::submit('Отправить', ['class' => 'btn waves-effect waves-light orange']) }}
        {{ Form::close() }}
    </div>
    <script>$('form select').material_select();</script>
@stop