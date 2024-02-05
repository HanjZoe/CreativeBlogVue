<template>
    <div>
        <label>Название тега</label>
        <my-input :placeholder="placeholder" v-model="newTitle"/>
    </div>
    <div class="btni">
        <button :disabled = "!isDisabled" @click.prevent="storeTag(newTitle)"  class="btn btn-primary">Добавить</button>
    </div>
</template>

<script>

export default {
    name: "CreateTag",
    data() {
        return {
            placeholder: 'Название тега',
            newTitle: null,
        }
    },
    emits: ['store', 'show'],
    methods: {
        storeTag(newTitle){
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
