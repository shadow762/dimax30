<template>
    <div class="combobox">
        <input v-model="filterQuery" type="text" v-bind:data-id="id" ref="input">
        <div class="combobox-item" v-if="filterQuery">
            <ul>
                <li v-for="item in filterList" :data-id="item.id" :data-name="item.name" @click="selectItem($event.target)">{{ item.name }}</li>
            </ul>
        </div>
    </div>



</template>
<script>
    export default {
        props:['list', 'text', 'value'],
        data() {
            return {
                id:'',
                name:'',
                filterQuery: ''
            }
        },
        computed: {
            filterList: function() {
                var self = this;
                return self.list.filter(function(item){
                    return item.name.search(self.filterQuery) !== -1;
                })
            }
        },
        methods: {
            updateValue: function() {
                this.$emit('input', this.id);
                this.$emit('change', this.id);
            },
            selectItem: function(el) {
                this.id = el.dataset.id;
                this.name = el.dataset.name;
                this.filterQuery = el.dataset.name;
                this.updateValue();
            }
        }
    }
</script>