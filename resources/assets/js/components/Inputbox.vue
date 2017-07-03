<!-- Элемент комбобокс. Передаваемые параметры:
 - Список значений (id - name)
 - id текущего значения (при наличии)
 - текст placeholder
 Возвращаемые параметры:
 - id выбранного элемента
 -->
<template>
    <div class="combobox-wrap">
        <input v-bind:value="value" v-on:input="updateValue()" type="text" ref="input" :placeholder=text v-click-outside="notShow" @click="showFlag=true">
        <i class="down-icon" :class="showFlag ? 'open' : ''"></i>
        <div class="combobox-item" v-if="showFlag">
            <ul>
                <li v-for="item in filterList" :data-name="item" @click="selectItem($event.target)">{{ item }}</li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        props:['list', 'text', 'current', 'value'],
        data() {
            return {
                showFlag: false
            }
        },
        computed: {
            filterList: function () {
                var self = this;

                if(self.list.length > 0) {
                    return self.list.filter(function(item) {
                        return item.search(self.value) !== -1;
                    });
                }
            }
        },
        watch: {
            current: function(val) {
                //Если передано значение
                if (val) {
                    this.value = val;
                }
            }
        },
        methods: {
            notShow: function(){
                this.showFlag = false;
            },
            updateValue: function() {
                this.$emit('input', this.value);
                this.$emit('change', this.value);
            },
            selectItem: function(el) {
                this.value = el.dataset.name;
                this.updateValue();
                this.showFlag = false;
            }
        },
        directives: {
            'click-outside': {
              bind: function(el, binding, vNode) {
                // Provided expression must evaluate to a function.
                if (typeof binding.value !== 'function') {
                    const compName = vNode.context.name
                  let warn = `[Vue-click-outside:] provided expression '${binding.expression}' is not a function, but has to be`
                  if (compName) { warn += `Found in component '${compName}'` }

                  console.warn(warn)
                }
                // Define Handler and cache it on the element
                const bubble = binding.modifiers.bubble
                const handler = (e) => {
                  if (bubble || (!el.contains(e.target) && el !== e.target)) {
                    binding.value(e)
                  }
                }
                el.__vueClickOutside__ = handler

                // add Event Listeners
                document.addEventListener('click', handler)
                    },

              unbind: function(el, binding) {
                // Remove Event Listeners
                document.removeEventListener('click', el.__vueClickOutside__)
                el.__vueClickOutside__ = null

              }
            }
          }
    }
</script>