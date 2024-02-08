<template>
    <div class="col-12">
        <div>

            <label>Имя пользователя</label>
            <div class="form-group">
                <my-input :placeholder="placeholderName" v-model="this.newName"/>
            </div>


            <label>Адрес электронной почты</label>
            <div class="form-group">
                <my-input :placeholder="placeholderEmail" v-model="this.newEmail"/>
                <div v-if="this.emailError" class="text-danger m-2"> {{ this.emailError }}</div>
            </div>

            <label>
                Роль пользователя
            </label>
            <div class="form-group">
                <select v-model="this.selectedRole">
                    <option v-for="(role,id) in roles " :key="id" :value="id"
                    >{{ role }}
                    </option>
                </select>
            </div>


        </div>
        <div class="btni">
            <button :disabled="!isDisabled" @click.prevent="storeUser()"
                    class="btn btn-primary">Добавить
            </button>
        </div>
    </div>

</template>

<script>
export default {
    name: "CreateUser",
    props: {
        roles: null,
        emailError: null,
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
        storeUser() {
            this.$emit('show')
            this.$emit('store', this.newEmail, this.newName, this.selectedRole)

        },

    },
    computed: {
        isDisabled() {
            return this.newEmail && this.newName
        }
    }

}
</script>

<style scoped>
.btni {
    position: relative;
    left: 62%;
    padding-top: 18px;
}
</style>
