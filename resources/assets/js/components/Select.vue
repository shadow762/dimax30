<template>
    <select v-model="id" ref="input" v-bind:value="value" v-on:change="updateValue($event.target.value)">
        <option value="">Выберите {{ text }}</option>
        <option v-for="item in list" :value="item.id">{{ item.name }}</option>
    </select>
</template>
<script>
    export default {
        props:['list', 'text', 'value'],
        data() {
            return {id:''}
        },
        methods: {
            updateValue: function(value) {
                this.$emit('input', value);
                this.$emit('change', value);
            }
        }
    }
</script>