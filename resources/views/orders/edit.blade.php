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
        <combobox v-model.lazy="editingOrder.status_id" :list="statuses" text="статус"></combobox>
        <div class="combobox-add"><div class="combobox-add-btn"><i></i></div></div>
        <span class="error-text" id="status_id-error" v-text="errors.get('status_id')"></span>
    </div>
    <div class="combobox-field with-add">
        <combobox v-model.lazy="editingOrder.client_id" :list="clients.data" text="Выберите клиента" :current="editingOrder.client_id"></combobox>
        <div class="combobox-add"><div class="combobox-add-btn" @click="clients.showModal=true"><i></i></div></div>
    <span class="error-text" id="client_id-error" v-text="errors.get('client_id')"></span>
    </div>
    <div class="combobox-field with-add">
        <combobox v-model.lazy="editingOrder.type_id" :list="types.data" text="Выберите тип устройства"></combobox>
        <div class="combobox-add"><div class="combobox-add-btn" @click="types.showModal=true"><i></i></div></div>
    <span class="error-text" id="type_id-error" v-text="errors.get('type_id')"></span>
    </div>
    <div class="combobox-field with-add">
        <combobox v-model.lazy="editingOrder.brend_id" @change="models.get(newOrder.brend_id)" :list="brends.data" text="Выберите бренд"></combobox>
        <div class="combobox-add"><div class="combobox-add-btn" @click="brends.showModal=true"><i></i></div></div>
    <span class="error-text" id="brend_id-error" v-text="errors.get('brend_id')"></span>
    </div>
    <div class="combobox-field with-add">
        <combobox v-model.lazy="editingOrder.model_id" :list="models.data" text="Выберите модель"></combobox>
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
</div>