<template>
    <div>
        <label>Название категории</label>
        <my-input :placeholder="placeholder" v-model="newTitle"/>
    </div>
    <div class="btni">
        <button :disabled = "!isDisabled" @click.prevent="storeCategory(newTitle)"  class="btn btn-primary">Добавить</button>
    </div>
</template>

<script>
export default {
    name: "PostEdit",
    data() {
        return {
            placeholder: 'Название категории',
            newTitle: null,
        }
    },
    emits: ['store', 'show'],
    methods: {
        storeCategory(newTitle){
            this.$emit('show')
            this.$emit('store', newTitle)
        },
    },
    computed:{
        isDisabled(){
            return this.newTitle
        }
    }
}
</script>

<style scoped>
.btni{
    position: relative;
    left: 73%;
    padding-top: 18px;
}
</style>
