@extends(!Request::ajax() ? 'app' : 'ajax')

@section('content')
    <div class="row">
        {{ Form::model(
            $order,
            ['route' => ['orders.update', $order->id], 'method' => 'put'],
            ['class' => 'col s12', 'data-url' => route('orders.update', ['id' => $order->id])])
        }}
            @include('orders._form')
        {{ Form::close() }}
    </div>
    <script>$('form select').material_select();</script>
@stop