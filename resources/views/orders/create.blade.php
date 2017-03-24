<section class="new-order-section" v-show="showAddForm">

    {{ Form::open(['route' => 'orders.store', 'method' => 'post', 'class' => 'col s12 ajax-form', '@submit.prevent' => 'createOrder']) }}
    <div class="input-field col s10">
        {{ Form::label('sn', 'Серийный номер') }}
        {{ Form::text('sn', '', ['v-model.lazy' => 'newOrder.sn']) }}
        <span class="error-text" id="sn-error" v-text="errors.get('sn')"></span>
    </div>
    <div class="input-field col s10">
        {{ Form::label('description', 'Описание') }}
        {{ Form::text('description', '', ['v-model.lazy' => 'newOrder.description']) }}
        <span class="error-text" id="description-error" v-text="errors.get('description')"></span>
    </div>
    <div class="input-field col s10 materialized">
        <combobox v-model.lazy="newOrder.status_id" :list="statuses" text="статус"></combobox>
        <span class="error-text" id="status_id-error" v-text="errors.get('status_id')"></span>
    </div>
    <div class="input-field col s10 materialized">
        <myselect v-model.lazy="newOrder.client_id" :list="clients.data" text="клиента"></myselect>
        <span class="error-text" id="client_id-error" v-text="errors.get('client_id')"></span>
        <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="clients.showModal=true"><i class="material-icons">add</i></a>
    </div>
    <div class="input-field col s10">
        <myselect v-model.lazy="newOrder.type_id" :list="types.data" text="тип устройства"></myselect>
        <span class="error-text" id="type_id-error" v-text="errors.get('type_id')"></span>
        <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="types.showModal=true"><i class="material-icons">add</i></a>
    </div>
    <div class="input-field col s10">
        <myselect v-model.lazy="newOrder.brend_id" @change="models.get(newOrder.brend_id)" :list="brends.data" text="бренд"></myselect>
        <span class="error-text" id="brend_id-error" v-text="errors.get('brend_id')"></span>
        <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="brends.showModal=true"><i class="material-icons">add</i></a>
    </div>
    <div class="input-field col s10">
        <myselect v-model.lazy="newOrder.model_id" :list="models.data" text="модель"></myselect>
        <span class="error-text" id="model_id-error" v-text="errors.get('model_id')"></span>
        <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="models.showModal=true"><i class="material-icons">add</i></a>
    </div>
    <div class="input-field col s10">
        {{ Form::label('cost', 'Стоимость') }}
        {{ Form::text('cost', '', ['v-model.lazy' => 'newOrder.cost']) }}
        <span class="error-text" id="cost-error" v-text="errors.get('cost')"></span>
    </div>
    <div class="input-field col s10">
        {{ Form::label('pay', 'Предоплата') }}
        {{ Form::text('pay', '', ['v-model.lazy' => 'newOrder.pay']) }}
        <span class="error-text" id="pay-error" v-text="errors.get('pay')"></span>
    </div>
    <div class="input-field col s10">
        <div class="input-field col s4">
            {{ Form::label('parts.name', 'Название Запчасти') }}
            {{ Form::text('parts.name', '', ['v-model' => 'newPart.name']) }}
        </div>
        <div class="input-field col s2">
            {{ Form::label('parts.numbers', 'Количество') }}
            {{ Form::text('parts.numbers', '', ['v-model' => 'newPart.numbers']) }}
        </div>
        <div class="input-field col s2">
            {{ Form::label('parts.price_own', 'Закупочная стоимость') }}
            {{ Form::text('parts.price_own', '', ['v-model' => 'newPart.price_own']) }}
        </div>
        <div class="input-field col s2">
            {{ Form::label('parts.price_sell', 'Стоимость реализации') }}
            {{ Form::text('parts.price_sell', '', ['v-model' => 'newPart.price_sell']) }}
        </div>
        <div @click="savePart()">Добавить</div>
    </div>
    <div class="input-field col s10">
        <ul>
            <li v-for="(part, key) in newOrder.parts">@{{ part.name }}/@{{ part.numbers }}/@{{ part.price_own }}/@{{ part.price_sell }}<a @click.prevent="removePart(key)">----------</a></li>
        </ul>
    </div>
    <div class="input-field col s10">
        <div class="input-field col s4">
            {{ Form::label('services.name', 'Название работы') }}
            {{ Form::text('services.name', '', ['v-model' => 'newService.name']) }}
        </div>
        <div class="input-field col s2">
            {{ Form::label('services.numbers', 'Количество') }}
            {{ Form::text('services.numbers', '', ['v-model' => 'newService.numbers']) }}
        </div>
        <div class="input-field col s2">
            {{ Form::label('services.price', 'Стоимость') }}
            {{ Form::text('services.price', '', ['v-model' => 'newService.price']) }}
        </div>
        <div @click="saveService()">Добавить</div>
    </div>
    <div class="input-field col s10">
        <ul>
            <li v-for="(service, key) in newOrder.services">@{{ service.name }}/@{{ service.numbers }}/@{{ service.price }}<a @click.prevent="removeService(key)">----------</a></li>
        </ul>
    </div>
    <div class="input-field col s10">
        {{ Form::submit('Создать', ['class' => 'btn waves-effect waves-light orange']) }}
    </div>
    {{ Form::close() }}
</section>