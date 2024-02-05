<template>
    <div class="col-12">
    <div>

        <label>Имя пользователя</label>
        <div class="form-group">
        <my-input :placeholder="placeholderName" v-model="newName"/>
        </div>


        <label>Адрес электронной почты</label>
        <div class="form-group">
        <my-input :placeholder="placeholderEmail" v-model="newEmail"/>
        </div>

        <label>
            Роль пользователя
        </label>
        <div class="form-group">
            <select v-model="selectedRole">
                <option v-for="(rl,id) in roles " :key="id" :value="id"
                >{{ rl }}
                </option>
            </select>
        </div>


    </div>
        <div class="btni">
            <button :disabled = "!isDisabled" @click.prevent="storeCategory(newName, newEmail, selectedRole)"  class="btn btn-primary">Добавить</button>
        </div>
        </div>

</template>

<script>
export default {
    name: "CreateUser",
    props:{
      roles: null,
    },
    data() {
        return {
            placeholderName: 'Имя пользователя',
            placeholderEmail: 'Email',
            newName: null,
            newEmail: null,
            selectedRole: 0,
        }
    },
    emits: ['store', 'show'],
    methods: {
        storeCategory(newName, newEmail, selectedRole){
            this.$emit('show')
            this.$emit('store', newEmail, newName,selectedRole)
        },

    },
    computed:{
        isDisabled(){
            return this.newEmail && this.newName
        }
    }

}
</script>

<style scoped>
.btni{
    position: relative;
    left: 62%;
    padding-top: 18px;
}
</style>
