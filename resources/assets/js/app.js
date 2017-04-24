
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

class Types {
    constructor() {
        this.data = {};
        this.new = {name:''};
        this.errors = new Errors();
        this.formUrl = '/types/create';
        this.saveUrl = '/types';
        this.showModal = false;
    }
    clear() {
        this.new = {name:''};
    }
    get() {
        axios.post('/getdevicetypes')
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
class Brends{
    constructor() {
        this.data = {};
        this.new = {};
        this.errors = new Errors();
        this.formUrl = '/brends/create';
        this.saveUrl = '/brends';
        this.showModal = false;
    }
    get(){
        axios.post('/getdevicebrends')
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
    onFail(errors){
        this.errors = errors.data;
    }
}
class Models{
    constructor() {
        this.data = {};
        this.new = {};
        this.errors = new Errors();
        this.formUrl = '/models/create';
        this.saveUrl = '/models';
        this.showModal = false;
    }
    get(brend_id){
        axios.post('/getdevicemodels', {id : brend_id})
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
    onFail(errors){
        this.errors = errors.data;
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


Vue.component('myselect', require('./components/Select.vue'));
Vue.component('combobox', require('./components/Combobox.vue'));
Vue.component('comboboxwithadd', require('./components/Comboboxcustom.vue'));

const order = new Vue({
    el: '#orders-block',
    data: {
        orders: [],
        statuses: [],
        types: new Types(),
        brends: new Brends(),
        models: new Models(),
        clients: new Clients(),
        errors: new Errors(),
        parts: new Parts(),
        services: new Services(),

        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        newOrder: {
            'sn': '',
            'description': '',
            'status_id': '',
            client_id: '',
            type_id: '',
            brend_id: '',
            model_id: '',
            cost: '',
            pay: '',
            parts: [],
            services: []
        },
        newPart: {
            id: -1,
            nama: '',
            numbers: '',
            price_own: '',
            price_sell: ''
        },
        newService: {
            name: {},
            numbers: '',
            price: ''
        },
        editingOrder: {},
        showAddForm: false,
        showModal: false
    },
    mounted: function () {
        this.getOrders(this.pagination.current_page);
        this.getStatuses();
        this.types.get();
        this.brends.get();
        this.clients.get();
    },
    computed: {
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
        }
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
            this.errors.clear();
            this.$http.post('/orders', this.newOrder).then((response) => {
                this.newOrder = {
                    'sn': '',
                    'description': '',
                    'status_id': '',
                    client_id: '',
                    type_id: '',
                    brend_id: '',
                    model_id: '',
                    cost: '',
                    pay: '',
                    parts: [],
                    services: []
                };
                this.showAddForm = false;
        }, (response) => {
                this.errors.set(response.body);
            });
        },
        editOrder: function(id) {
            this.$http.get('/api/json/getorder/' + id).then(response => {
                this.$set(this, 'editingOrder', response.body);
            }, response => {
                alert('error');
            });
        },
        updateOrder: function(){
            this.errors.clear();
            this.$http.post('/orders/update', this.editingOrder).then((response) => {
            }, (response) => {
                this.errors.set(response.body);
            });
        },
        getStatuses: function() {
            this.$http.post('/getstatuses').then(response => {
                this.$set(this, 'statuses', response.body);
            });
        },
        savePart: function() {
            this.newOrder.parts.push(this.newPart);
            this.newPart =  {'id': -1, name: '', 'numbers': '', 'price_own': '', 'price_sell': ''};
        },
        removePart: function(key) {
            this.newOrder.parts.splice(key, 1);
        },
        saveService: function() {
            this.newOrder.services.push(this.newService);
            this.newService =  {data: {}, numbers: '', price: ''};
        },
        removeService: function(key) {
            this.newOrder.services.splice(key, 1);
        }
    }
});
