<template>
    <div class="combobox-wrap">
        <input v-model="filterQuery" type="text" v-bind:data-id="id" ref="input" @click="showFlag=true" :placeholder=text @change="updateValue()">
        <i class="down-icon" :class="showFlag ? 'open' : ''"></i>
        <div class="combobox-item" v-if="showFlag">
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
                filterQuery: '',
                showFlag: false,
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
                this.$emit('input', this.filterQuery);
                this.$emit('change', this.filterQuery);
            },
            selectItem: function(el) {
                this.id = el.dataset.id;
                this.name = el.dataset.name;
                this.filterQuery = el.dataset.name;
                this.showFlag = false;
                this.updateValue();
            }
        }
    }
</script>