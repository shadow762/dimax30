<template>
    <select v-model="id">
        <option hidden>Выберите {{ text }}</option>
        <option v-for="item in list" :value="item.id">{{ item.name }}</option>
    </select>
</template>
<script>
    export default {
        props:['list', 'text'],
        data() {
            return {id:''}
        },
        model: {
            prop: 'value',
            event: 'change'
        }
    }
</script>