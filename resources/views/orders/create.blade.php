<section class="new-order-section" v-show="showAddForm">

    {{ Form::open(['route' => 'orders.store', 'method' => 'post', 'class' => 'col s12 ajax-form', '@submit.prevent' => 'createOrder']) }}
    <section class="clearfix">
    <div class="left-part pull-left">
        <div class="input-field">
            {{ Form::text('sn', '', ['v-model.lazy' => 'newOrder.sn', 'class' => 'text-field', 'placeholder' => 'Серийный номер']) }}
            <span class="error-text" id="sn-error" v-text="errors.get('sn')"></span>
        </div>
        <div class="input-field">
            {{ Form::text('description', '', ['v-model.lazy' => 'newOrder.description', 'class' => 'text-field', 'placeholder' => 'Описание'] ) }}
            <span class="error-text" id="description-error" v-text="errors.get('description')"></span>
        </div>
        <div class="input-field">
            <combobox v-model.lazy="newOrder.status_id" :list="statuses" text="статус"></combobox>
            <span class="error-text" id="status_id-error" v-text="errors.get('status_id')"></span>
        </div>
        <div class="input-field">
            <myselect v-model.lazy="newOrder.client_id" :list="clients.data" text="клиента"></myselect>
            <span class="error-text" id="client_id-error" v-text="errors.get('client_id')"></span>
            <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="clients.showModal=true"><i class="material-icons">add</i></a>
        </div>
        <div class="input-field">
            <myselect v-model.lazy="newOrder.type_id" :list="types.data" text="тип устройства"></myselect>
            <span class="error-text" id="type_id-error" v-text="errors.get('type_id')"></span>
            <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="types.showModal=true"><i class="material-icons">add</i></a>
        </div>
        <div class="input-field">
            <myselect v-model.lazy="newOrder.brend_id" @change="models.get(newOrder.brend_id)" :list="brends.data" text="бренд"></myselect>
            <span class="error-text" id="brend_id-error" v-text="errors.get('brend_id')"></span>
            <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="brends.showModal=true"><i class="material-icons">add</i></a>
        </div>
        <div class="input-field">
            <myselect v-model.lazy="newOrder.model_id" :list="models.data" text="модель"></myselect>
            <span class="error-text" id="model_id-error" v-text="errors.get('model_id')"></span>
            <a class="btn-floating waves-effect waves-light red add-btn" @click.prevent="models.showModal=true"><i class="material-icons">add</i></a>
        </div>
        <div class="input-field col s10">
            {{ Form::text('cost', '', ['v-model.lazy' => 'newOrder.cost', 'class' => 'text-field', 'placeholder' => 'Стоимость']) }}
            <span class="error-text" id="cost-error" v-text="errors.get('cost')"></span>
        </div>
        <div class="input-field col s10">
            {{ Form::text('pay', '', ['v-model.lazy' => 'newOrder.pay', 'class' => 'text-field', 'placeholder' => 'Предоплата']) }}
            <span class="error-text" id="pay-error" v-text="errors.get('pay')"></span>
        </div>
    </div>
    <div class="right-part pull-left">
        <div class="parts-section">
            <div class="clearfix">
                <div class="name-field">
                    {{ Form::text('parts.name', '', ['v-model' => 'newPart.name', 'class' => 'text-field', 'placeholder' => 'Наименование']) }}
                </div>
                <div class="number-field">
                    {{ Form::text('parts.numbers', '', ['v-model' => 'newPart.numbers', 'class' => 'text-field', 'placeholder' => 'Количество']) }}
                </div>
                <div class="icost-field">
                    {{ Form::text('parts.price_own', '', ['v-model' => 'newPart.price_own', 'class' => 'text-field', 'placeholder' => 'Закупочная стоимость']) }}
                </div>
                <div class="ocost-field">
                    {{ Form::text('parts.price_sell', '', ['v-model' => 'newPart.price_sell', 'class' => 'text-field', 'placeholder' => 'Стоимость реализации']) }}
                </div>
                <div class="add-field" ><i @click="savePart()"></i></div>
            </div>
            <div class="parts-list">
                <ul>
                    <li v-for="(part, key) in newOrder.parts" class="clearfix list-item">
                        <div class="name-field">@{{ part.name }}</div>
                        <div class="number-field">@{{ part.numbers }}</div>
                        <div class="icost-field">@{{ part.price_own }}</div>
                        <div class="ocost-field">@{{ part.price_sell }}</div>
                        <div class="rm-field"><a @click.prevent="removePart(key)"><i></i></a></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="jobs-section">
            <div class="input-field">
                <div class="name-field">
                    {{ Form::text('services.name', '', ['v-model' => 'newService.name', 'class' => 'text-field', 'placeholder' => 'Наименование']) }}
                </div>
                <div class="number-field">
                    {{ Form::text('services.numbers', '', ['v-model' => 'newService.numbers', 'class' => 'text-field', 'placeholder' => 'Количество']) }}
                </div>
                <div class="cost-field">
                    {{ Form::text('services.price', '', ['v-model' => 'newService.price', 'class' => 'text-field', 'placeholder' => 'Стоимость']) }}
                </div>
                <div class="add-field"><i @click="saveService()"></i></div>
            </div>
            <div class="input-field col s10">
                <ul>
                    <li v-for="(service, key) in newOrder.services">@{{ service.name }}/@{{ service.numbers }}/@{{ service.price }}<a @click.prevent="removeService(key)">----------</a></li>
                </ul>
            </div>
        </div>
        </div>
    </section>
    <div class="input-field col s10">
        {{ Form::submit('Создать', ['class' => 'btn waves-effect waves-light orange']) }}
    </div>
    {{ Form::close() }}
</section>