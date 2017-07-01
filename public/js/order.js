Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
window.onload = function () {
    new Vue({
        el: '#orders-block',
        data: {

            orders: [],

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

            newItem: {'title': '', 'description': ''},

            fillItem: {'title': '', 'description': '', 'id': ''}

        },
        ready: function () {
            this.getVueItems(this.pagination.current_page);
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
            getVueItems: function (page) {

                this.$http.get('/orders?page=' + page).then((response) => {

                    this.$set('orders', response.data.data.data);

                this.$set('pagination', response.data.pagination);

            })
                ;

            },
            changePage: function (page) {

                this.pagination.current_page = page;

                this.getVueItems(page);
            }
        }
    });
}