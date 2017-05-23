<template>
    <div class="combobox-wrap">
        <input v-model="filterQuery" type="text" v-bind:data-id="id" ref="input" v-click-outside="notShow" @click="showFlag=true" :placeholder=text @change="updateValue()">
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
            notShow: function(){
                this.showFlag = false;
            },
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