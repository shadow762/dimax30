<div class="row">
    <div class="col s12">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text">
                <span class="card-title">Данные заказа</span>
                <p>Номер заказа: {{ $order->id }}</p>
                <p>Принят: {{ $order->created }}</p>
                <!-- TODO продумать параметр для проверки заказа на статус "закрыт"-->
                @if($order->closed && $order->status->name == "Закрыт")
                    <p>Закрыт: {{ $order->closed }}</p>
                @endif
                <p>Статус: {{ $order->status->name }}</p>
                <p>Стоимость: {{ $order->cost ? $order->cost . 'руб.' : 'не указано' }} </p>
                <p>Оплачено: {{ $order->pay ? $order->pay : 0 }}</p>
                <p>Устройство: В разработке</p>
                <p>Клиент: {{ $order->client->name }}</p>
                <p>Телефон клиента: {{ $order->client->phone }}</p>
                <p>Email клиента: {{ $order->client->email }}</p>
                <!-- TODO реализовать вывод информации об участвующих пользователях -->
            </div>
            <div class="card-action">
                {{ link_to_route(
                    'orders.edit',
                    trans('common.edit'),
                    ['id' => $order->id],
                    ['class' => 'create-modal', 'data-url' => route('orders.edit', ['id' => $order->id])])
                }}
                {{ link_to_route('orders.destroy', trans('common.delete'), ['id' => $order->id]) }}
            </div>
        </div>
    </div>
</div>