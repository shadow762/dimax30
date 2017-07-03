
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
import { Validator } from 'vee-validate';

//Vue.use(Validator);

class Errors{
    constructor() {
        this.errors = {};
    }
    get(field) {
        if(this.errors[field]) {
            return this.errors[field][0];
        }
    }
    set(errors) {
        this.errors = errors;
    }
    clear() {
        this.errors = {};
    }
}
class Notifications{
    constructor() {
        this.notifications = {};
    }
    set(notifications) {
        this.notifications = notifications;
    }
    clearAll() {
        this.notifications = {};
    }
    clear(key) {
        this.notifications.splice(key, 1);
    }
}
class Clients {
    constructor() {
        this.data = {};
        this.new = {name:'', phone:'', email:''};
        this.errors = new Errors();
        this.formUrl = '/clients/create';
        this.saveUrl = '/clients';
        this.showModal = false;
    }
    clear() {
        this.new = {name:'', phone:'', email:''};
    }
    get() {
        axios.post('/getclients')
            .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }
    create() {
        axios.post(this.saveUrl, this.new)
            .then(this.createSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }
    createSuccess(response){
        //выводим сообщение, очищаем ошибки и данные нового элемента, обновляем список элементов
        alert(response.data.msg);
        this.clear();
        this.showModal = false;
        this.errors.clear();
        this.get();
    }
    onSuccess(response){
        this.data = response.data;
    }
    onFail(error){
        this.errors.set(error.response.data);
    }
}
class Parts {
    constructor() {
        this.data = {};
        this.get();
    }
    get() {
        axios.post('/getparts')
            .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }
    onSuccess(response){
        this.data = response.data;
    }
    onFail(error){
        this.errors.set(error.response.data);
    }
}
class Services {
    constructor() {
        this.data = {};
        this.get();
    }
    get() {
        axios.post('/getservices')
            .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }
    onSuccess(response){
        this.data = response.data;
    }
    onFail(error){
        this.errors.set(error.response.data);
    }
}
class Devices {
    constructor() {
        this.data = {};
        this.selected = {
            model: '',
            type: '',
            brend: ''
        };
        this.errors = new Errors();
    }
    get() {
        axios.post('/getdevices')
            .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }
    onSuccess(response){
        this.data = response.data;
    }
    onFail(errors){
        this.errors = errors.data;
    }
    clearSelected() {
        this.selected = {
            model: '',
            type: '',
            brend: ''
        };
    }
}

Vue.component('myselect', require('./components/Select.vue'));
Vue.component('combobox', require('./components/Combobox.vue'));
Vue.component('inputbox', require('./components/Inputbox.vue'));
Vue.component('comboboxwithadd', require('./components/Comboboxcustom.vue'));

const partValidator = new Validator({
    id: 'required',
    name: 'required',
    numbers: 'required',
    price_own: 'required',
    price_sell: 'required'
});
const serviceValidator = new Validator({
    id: 'required',
    name: 'required',
    numbers: 'required',
    price: 'required'
});

const order = new Vue({
    el: '#orders-block',
    data: {
        partValidator: partValidator,
        serviceValidator: serviceValidator,
        //Вспомогательные данные
        errors: new Errors(),
        notifications: new Notifications(),
        devices: new Devices(),
        clients: new Clients(),
        parts: new Parts(),
        services: new Services(),
        statuses: [],

        //Заказы
        orders: [],
        newOrder: {
            'sn': '',
            'description': '',
            'status_id': '',
            client_id: '',
            cost: '',
            pay: '',
            parts: [],
            services: []
        },
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,

        newPart: {
            id: -1,
            name: '',
            numbers: '',
            price_own: '',
            price_sell: ''
        },
        newService: {
            id: -1,
            name: '',
            numbers: '',
            price: ''
        },
        editingOrder: {},
        showAddForm: false,
        showModal: false,
        showEditSection: false,
    },
    mounted: function () {
        this.getOrders(this.pagination.current_page);
        this.getStatuses();
        this.clients.get();
        this.devices.get();
    },
    computed: {
        //pagination
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },

        //devices computing
        devicesType: function() {
            if(this.devicesFilter && this.devicesFilter !== 'undefined') {
                var result = this.devicesFilter.map(function (item) {
                    return item.type;
                });
                result.sort();
                var i = result.length;
                while(i--) {
                    if(result[i] == result[i-1]) {
                        result.splice(i, 1);
                    }
                }

                return result;
            }
            else {
                return [];
            }
        },
        devicesBrend: function() {
            if(this.devicesFilter && this.devicesFilter !== 'undefined') {
                var result = this.devicesFilter.map(function (item) {
                    return item.brend;
                });
                result.sort();
                var i = result.length;
                while(i--) {
                    if(result[i] == result[i-1]) {
                        result.splice(i, 1);
                    }
                }

                return result;
            }
            else {
                return [];
            }
        },
        devicesModel: function() {
            if(this.devicesFilter && this.devicesFilter !== 'undefined') {
                return this.devicesFilter.map(function (item) {
                    return item.model;
                });
            }
            else {
                return [];
            }
        },
        devicesFilter: function () {
            var self = this;

            if(self.devices.data.length > 0) {
                return self.devices.data.filter(function(item) {
                    return item.brend.search(self.devices.selected.brend) !== -1;
                });
            }
        }
    },
    watch: {
    },
    methods: {
        /* order merhods */
        getOrders: function (page) {
            this.$http.get('/orders?page=' + page).then((response) => {
                this.$set(this, 'orders', response.data.data.data);
            this.$set(this, 'pagination', response.data.pagination);
        });
        },
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getOrders(page);
        },
        createOrder: function(){
            //Очищаем ошибки
            this.errors.clear();

            //Выбранное устройство переносим в новый заказ
            for(var key in this.devices.selected) {
                this.newOrder[key] = this.devices.selected[key];
            };

            //Отправляем данные заказа и очищаем объект
            this.$http.post('/orders', this.newOrder).then((response) => {
                this.showAddForm = false;
                this.newOrder = {
                    'sn': '',
                    'description': '',
                    'status_id': '',
                    client_id: '',
                    pay: '',
                    parts: [],
                    services: []
                };
                this.notifications.notifications = response.body;
                this.devices.clearSelected();
                this.getOrders(this.pagination.current_page);
            }, (response) => {
                this.errors.set(response.body);
            });
        },
        editOrder: function(id) {
            //Показывает окно редактирования
            this.showEditSection = true

            //Получаем данные заказа
            this.$http.get('/api/json/getorder/' + id).then(response => {
                //Помещаем данные об устройстве в devices.selected
                this.$set(this.devices, 'selected', response.body.device);
                delete(response.body.device);

                //Получаем данные об устройствах
                this.devices.get();

                this.$set(this, 'editingOrder', response.body);
            }, response => {
                alert('error');
            });
        },
        updateOrder: function(){
            this.errors.clear();
            //Выбранное устройство переносим в  заказ
            for(var key in this.devices.selected) {
                this.editingOrder[key] = this.devices.selected[key];
            };
            this.$http.post('/orders/update', this.editingOrder).then((response) => {
                this.editingOrder = {};
                this.devices.selected = {};
                this.showEditSection = false;
                this.notifications.notifications = response.body;
                this.getOrders(this.pagination.current_page);
            }, (response) => {
                this.errors.set(response.body);
            });
        },
        getStatuses: function() {
            this.$http.post('/getstatuses').then(response => {
                this.$set(this, 'statuses', response.body);
            });
        },
        savePart: function(object) {
            partValidator.validateAll(this.newPart).then(result => {
                if (!result)
                {
                    return false;
                }
                object.parts.push(this.newPart);
                this.newPart =  {id: -1, name: '', 'numbers': '', 'price_own': '', 'price_sell': ''};
            }).catch(error => {
            });
        },
        removePart: function(object, key) {
            object.parts.splice(key, 1);
        },
        saveService: function(object) {
            serviceValidator.validateAll(this.newService).then(result => {
                if (!result)
                {
                    return false;
                }
                object.services.push(this.newService);
                this.newService =  {id: -1, name: '', numbers: '', price: ''};
        }).catch(error => {
            });
        },
        removeService: function(object, key) {
            object.services.splice(key, 1);
        }
    }
});