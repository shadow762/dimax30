$(document).ready(function(){
    new Vue({
        el: '#app',
        data: {
            modals: [],
            message: '123'
        },
        ready: function(){
            this.changetest('543');
        },
        methods: {
            changetest: function(new_text){
                this.message = new_text;
            }
        }
    });
})

