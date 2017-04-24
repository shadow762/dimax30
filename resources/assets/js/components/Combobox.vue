<!-- Элемент комбобокс. Передаваемые параметры:
 - Список значений (id - name)
 - id текущего значения (при наличии)
 - текст placeholder
 Возвращаемые параметры:
 - id выбранного элемента
 -->
<template>
    <div class="combobox-wrap">
        <input v-model="filterQuery" type="text" v-bind:data-id="id" ref="input" @click="showFlag=true" :placeholder=text>
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
        props:['list', 'text', 'value', 'current'],
        data() {
            return {
                id: '',
                filterQuery: '',
                showFlag: false
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
        watch: {
            current: function(val) {
                //Если передано значение
                if (val) {
                    var self = this;
                    this.$emit('change');
                    // TODO Костыль. Надо выполнять после подгрузки моделей
                    setTimeout(function(){
                        var currentIndex;
                        self.id = val;
                        //вычисляем name текущего элемента
                        currentIndex = self.list.findIndex(function (el) {
                            if (el.id == self.id)
                                return el;
                        }, self);
                        self.filterQuery = self.list[currentIndex].name;
                    }, 1000);

                }
            }
        },
        methods: {
            updateValue: function() {
                this.$emit('input', this.id);
                this.$emit('change', this.id);
            },
            selectItem: function(el) {
                this.id = el.dataset.id;
                this.filterQuery = el.dataset.name;
                this.showFlag = false;
                this.updateValue();
            }
        }
    }
</script>