<!-- Элемент комбобокс. Передаваемые параметры:
 - Список значений (id - name)
 - id текущего значения (при наличии)
 - текст placeholder
 Возвращаемые параметры:
 - id выбранного элемента
 -->
<template>
    <div class="combobox-wrap">
        <input v-model="filterQuery" type="text" v-bind:data-id="id" ref="input" :placeholder=text v-bind:class="{ 'open': opened }" @click.stop>
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
                showFlag: false,
                opened: false
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
            },
            filterQuery: function(val) {
                if(val && this.filterList.length > 1)
                    this.showFlag = true;
                else
                    this.showFlag = false;
            },
            showPoint: function() {
                bus.$on('click', function(){
                    alert('123');
                });
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

                this.updateValue();
                this.showFlag = false;
            },
            toggle () {
                if (this.opened) {
                    return this.hide()
                }
                return this.show()
            },
            show () {
                this.opened = true;
                setTimeout(() => document.addEventListener('click',this.hide), 0);
            },
            hide () {
                this.opened = false;
                document.removeEventListener('click',this.hide);
            }
        }
    }
</script>