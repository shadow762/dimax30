{{ Form::open(['route' => 'orders.update', 'method' => 'post', 'class' => 'col s12 ajax-form', '@submit.prevent' => 'updateOrder', 'v-if' => 'showEditSection']) }}
<div class="edit-order-section">
    <div class="input-field">
        {{ Form::text('sn', '', ['v-model.lazy' => 'editingOrder.sn', 'class' => 'text-field', 'placeholder' => 'Серийный номер']) }}
        <span class="error-text" id="sn-error" v-text="errors.get('sn')"></span>
    </div>
    <div class="input-field">
        {{ Form::text('description', '', ['v-model.lazy' => 'editingOrder.description', 'class' => 'text-field', 'placeholder' => 'Описание'] ) }}
        <span class="error-text" id="description-error" v-text="errors.get('description')"></span>
    </div>
    <div class="combobox-field with-add">
        <combobox v-model.lazy="editingOrder.status_id" :list="statuses" text="статус" :current="editingOrder.status_id"></combobox>
        <div class="combobox-add"><div class="combobox-add-btn"><i></i></div></div>
        <span class="error-text" id="status_id-error" v-text="errors.get('status_id')"></span>
    </div>
    <div class="combobox-field with-add">
        <combobox v-model.lazy="editingOrder.client_id" :list="clients.data" text="Выберите клиента" :current="editingOrder.client_id"></combobox>
        <div class="combobox-add"><div class="combobox-add-btn" @click="clients.showModal=true"><i></i></div></div>
    <span class="error-text" id="client_id-error" v-text="errors.get('client_id')"></span>
    </div>
    <div class="combobox-field with-add">
        <combobox v-model.lazy="editingOrder.type_id" :list="types.data" text="Выберите тип устройства" :current="editingOrder.type_id"></combobox>
        <div class="combobox-add"><div class="combobox-add-btn" @click="types.showModal=true"><i></i></div></div>
    <span class="error-text" id="type_id-error" v-text="errors.get('type_id')"></span>
    </div>
    <div class="combobox-field with-add">
        <combobox v-model.lazy="editingOrder.brend_id" @change="models.get(editingOrder.brend_id)" :list="brends.data" text="Выберите бренд" :current="editingOrder.brend_id"></combobox>
        <div class="combobox-add"><div class="combobox-add-btn" @click="brends.showModal=true"><i></i></div></div>
    <span class="error-text" id="brend_id-error" v-text="errors.get('brend_id')"></span>
    </div>
    <div class="combobox-field with-add">
        <combobox v-model.lazy="editingOrder.model_id" :list="models.data" text="Выберите модель" :current="editingOrder.model_id"></combobox>
        <div class="combobox-add"><div class="combobox-add-btn" @click="models.showModal=true"><i></i></div></div>
    <span class="error-text" id="model_id-error" v-text="errors.get('model_id')"></span>
    </div>
    <div class="input-field col s10">
        {{ Form::text('cost', '', ['v-model.lazy' => 'editingOrder.cost', 'class' => 'text-field', 'placeholder' => 'Стоимость']) }}
        <span class="error-text" id="cost-error" v-text="errors.get('cost')"></span>
    </div>
    <div class="input-field col s10">
        {{ Form::text('pay', '', ['v-model.lazy' => 'editingOrder.pay', 'class' => 'text-field', 'placeholder' => 'Предоплата']) }}
        <span class="error-text" id="pay-error" v-text="errors.get('pay')"></span>
    </div>
    <section class="add-order-section">
        <div class="right-part">
            <div class="parts-section">
                <div class="clearfix add-part-fields">
                    <div class="name-field combobox-field">
                        <comboboxwithadd v-model="newPart.name" :list="parts.data" text="Наименование"></comboboxwithadd>
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
                    <div class="add-field" ><i @click="savePart(editingOrder)"></i></div>
                </div>
                <div class="parts-list">
                    <ul>
                        <li v-for="(part, key) in editingOrder.parts" class="clearfix list-item">
                            <div class="name-field">@{{ part.name }}</div>
                            <div class="number-field">@{{ part.numbers }}</div>
                            <div class="icost-field">@{{ part.price_own }}</div>
                            <div class="ocost-field">@{{ part.price_sell }}</div>
                            <div class="rm-field" @click="removePart(editingOrder, key)"><i></i></div>
                </li>
                </ul>
            </div>
            </div>
            <div class="jobs-section">
                <div class="clearfix add-job-fields">
                    <div class="name-field combobox-field">
                        <comboboxwithadd v-model="newService.name" :list="services.data" text="Наименование"></comboboxwithadd>
                    </div>
                    <div class="number-field">
                        {{ Form::text('services.numbers', '', ['v-model' => 'newService.numbers', 'class' => 'text-field', 'placeholder' => 'Количество']) }}
                    </div>
                    <div class="cost-field">
                        {{ Form::text('services.price', '', ['v-model' => 'newService.price', 'class' => 'text-field', 'placeholder' => 'Стоимость']) }}
                    </div>
                    <div class="add-field"><i @click="saveService(editingOrder)"></i></div>
                </div>
                <div class="jobs-list">
                    <ul>
                        <li v-for="(service, key) in editingOrder.services" class="clearfix list-item">
                            <div class="name-field">@{{ service.name }}</div>
                            <div class="number-field">@{{ service.numbers }}</div>
                            <div class="cost-field">@{{ service.price }}</div>
                            <div class="rm-field" @click="removeService(editingOrder, key)"><i></i></div>
                    </li>
                    </ul>
            </div>
            </div>
        </div>
    </section>
    <div class="input-field col s10">
        {{ Form::submit('Сохранить', ['class' => 'btn waves-effect waves-light orange']) }}
        <div @click="showEditSection=false">Закрыть</div>
    </div>
    {{ Form::close() }}
</div>