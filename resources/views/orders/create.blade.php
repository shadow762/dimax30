<section class="new-order-section" v-if="showAddForm">

    {{ Form::open(['route' => 'orders.store', 'method' => 'post', 'class' => 'col s12 ajax-form', '@submit.prevent' => 'createOrder']) }}
    <div class="clearfix">
        <section class="client-section">
            <fieldset>
                <legend>Клиент</legend>
                <div class="combobox-field with-add">
                    <combobox v-model.lazy="newOrder.client_id" :list="clients.data" text="Выберите клиента"></combobox>
                    <div class="combobox-add"><div class="combobox-add-btn" @click="clients.showModal=true"><i></i></div></div>
                <span class="error-text" id="client_id-error" v-text="errors.get('client_id')"></span>
                </div>
            </fieldset>
        </section>
        <section class="device-section">
            <fieldset>
                <legend>Устройство</legend>
                <div class="combobox-field">
                    <inputbox v-model.lazy="devices.selected.type" :list="devicesType ? devicesType : []" text="Тип устройства"></inputbox>
                    <span class="error-text" id="type-error" v-text="errors.get('type')"></span>
                </div>
                <div class="combobox-field">
                    <inputbox v-model.lazy="devices.selected.brend" :list="devicesBrend ? devicesBrend : []" text="Бренд"></inputbox>
                    <span class="error-text" id="brend-error" v-text="errors.get('brend')"></span>
                </div>
                <div class="combobox-field">
                    <inputbox v-model.lazy="devices.selected.model" :list="devicesModel ? devicesModel : []" text="Модель"></inputbox>
                    <span class="error-text" id="model-error" v-text="errors.get('model')"></span>
                </div>
            </fieldset>
        </section>
        <section class="other-section">
            <fieldset>
                <div class="input-field">
                    {{ Form::text('sn', '', ['v-model.lazy' => 'newOrder.sn', 'class' => 'text-field', 'placeholder' => 'Серийный номер']) }}
                    <span class="error-text" id="sn-error" v-text="errors.get('sn')"></span>
                </div>
                <div class="input-field">
                    {{ Form::text('description', '', ['v-model.lazy' => 'newOrder.description', 'class' => 'text-field', 'placeholder' => 'Описание'] ) }}
                    <span class="error-text" id="description-error" v-text="errors.get('description')"></span>
                </div>
                <div class="input-field col s10">
                    {{ Form::text('pay', '', ['v-model.lazy' => 'newOrder.pay', 'class' => 'text-field', 'placeholder' => 'Предоплата']) }}
                    <span class="error-text" id="pay-error" v-text="errors.get('pay')"></span>
                </div>
                <div class="combobox-field with-add">
                    <combobox v-model.lazy="newOrder.status_id" :list="statuses" text="статус"></combobox>
                    <div class="combobox-add"><div class="combobox-add-btn"><i></i></div></div>
                    <span class="error-text" id="status_id-error" v-text="errors.get('status_id')"></span>
                </div>
            </fieldset>
        </section>
        <section class="service-section">
            <div class="parts-section">
                <div class="clearfix add-part-fields">
                    <div class="name-field combobox-field">
                        <comboboxwithadd v-model="newPart.name" :list="parts.data" text="Наименование"></comboboxwithadd>
                        <div v-show="partValidator.errorBag.has('name')" class="help is-danger">@{{ partValidator.errorBag.first('name') }}</div>
                    </div>
                    <div class="number-field">
                        {{ Form::text('parts.numbers', '', ['v-model' => 'newPart.numbers', 'class' => 'text-field', 'placeholder' => 'Количество']) }}
                        <div v-show="partValidator.errorBag.has('numbers')" class="help is-danger">@{{ partValidator.errorBag.first('numbers') }}</div>
                    </div>
                    <div class="icost-field">
                        {{ Form::text('parts.price_own', '', ['v-model' => 'newPart.price_own', 'class' => 'text-field', 'placeholder' => 'Закупочная стоимость']) }}
                        <div v-show="partValidator.errorBag.has('price_own')" class="help is-danger">@{{ partValidator.errorBag.first('price_own') }}</div>
                    </div>
                    <div class="ocost-field">
                        {{ Form::text('parts.price_sell', '', ['v-model' => 'newPart.price_sell', 'class' => 'text-field', 'placeholder' => 'Стоимость реализации']) }}
                        <div v-show="partValidator.errorBag.has('price_sell')" class="help is-danger">@{{ partValidator.errorBag.first('price_sell') }}</div>
                    </div>
                    <div class="add-field" ><i @click="savePart(newOrder)"></i></div>
                </div>
                <div class="parts-list">
                    <ul>
                        <li v-for="(part, key) in newOrder.parts" class="clearfix list-item">
                            <div class="name-field">@{{ part.name }}</div>
                            <div class="number-field">@{{ part.numbers }}</div>
                            <div class="icost-field">@{{ part.price_own }}</div>
                            <div class="ocost-field">@{{ part.price_sell }}</div>
                            <div class="rm-field" @click="removePart(newOrder, key)"><i></i></div>
                </li>
                </ul>
            </div>
            </div>
            <div class="jobs-section">
                <div class="clearfix add-job-fields">
                    <div class="name-field combobox-field">
                        <comboboxwithadd v-model="newService.name" :list="services.data" text="Наименование"></comboboxwithadd>
                        <div v-show="serviceValidator.errorBag.has('name')" class="help is-danger">@{{ serviceValidator.errorBag.first('name') }}</div>
                    </div>
                    <div class="number-field">
                        {{ Form::text('services.numbers', '', ['v-model' => 'newService.numbers', 'class' => 'text-field', 'placeholder' => 'Количество']) }}
                        <div v-show="serviceValidator.errorBag.has('numbers')" class="help is-danger">@{{ serviceValidator.errorBag.first('numbers') }}</div>
                    </div>
                    <div class="cost-field">
                        {{ Form::text('services.price', '', ['v-model' => 'newService.price', 'class' => 'text-field', 'placeholder' => 'Стоимость']) }}
                        <div v-show="serviceValidator.errorBag.has('price')" class="help is-danger">@{{ serviceValidator.errorBag.first('price') }}</div>
                    </div>
                    <div class="add-field"><i @click="saveService(newOrder)"></i></div>
                </div>
                <div class="jobs-list">
                    <ul>
                        <li v-for="(service, key) in newOrder.services" class="clearfix list-item">
                            <div class="name-field">@{{ service.name }}</div>
                            <div class="number-field">@{{ service.numbers }}</div>
                            <div class="cost-field">@{{ service.price }}</div>
                            <div class="rm-field" @click="removeService(newOrder, key)"><i></i></div>
                </li>
                </ul>
            </div>
            </div>
        </section>

        <div class="input-field col s10">
            {{ Form::submit('Создать', ['class' => 'btn waves-effect waves-light orange']) }}
        </div>
    {{ Form::close() }}
</section>