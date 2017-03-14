
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

Vue.component('myselect', require('./components/Select.vue'));

/*const app = new Vue({
    el: '#app'
});*/
const order = new Vue({
    el: '#orders-block',
    data: {
        orders: [],
        statuses: [],
        types:[],
        brends:[],
        models:[],
        errors: new Errors(),
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        formErrors: {},
        formErrorsUpdate: {},
        newOrder: {'sn': '', 'description': '', 'status_id': '', type_id: '', brend_id: '', model_id: '', cost: '', pay: ''},
        fillItem: {'title': '', 'description': '', 'id': ''},
        showAddForm: false
    },
    mounted: function () {
        this.getOrders(this.pagination.current_page);
        this.getStatuses();
        this.getDeviceTypes();
        this.getDeviceBrends();
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
            this.$http.post('/orders', this.newOrder).then((response) => {
                console.log(response.body);
        }, (response) => {
                this.errors.set(response.body);
            });
        },
        /* */
        getStatuses: function() {
            this.$http.post('/getstatuses').then(response => {
                this.$set(this, 'statuses', response.body);
            });
        },
        getDeviceTypes: function() {
            this.$http.post('/getdevicetypes').then(response => {
                this.$set(this, 'types', response.body);
            });
        },
        getDeviceBrends: function() {
            this.$http.post('/getdevicebrends').then(response => {
                this.$set(this, 'brends', response.body);
            });
        },
        getDeviceModels: function(brend) {

            this.$http.post('/getdevicemodels', {id: brend}).then(response => {
                this.$set(this, 'models', response.body)
            });
        }
    }
});
