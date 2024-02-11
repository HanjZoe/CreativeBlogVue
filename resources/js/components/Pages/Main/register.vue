<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Регистрация</div>

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>

                            <div class="col-md-6">
                                <my-input :placeholder = "placeholder_name" v-model = "name" type="text" class="form-control  " :class="{ 'is-invalid' :errorName}"  />


                                <span v-if="errorName" class="invalid-feedback" role="alert">
                                        <strong>{{ errorName }} </strong>
                                    </span>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <my-input  :placeholder = "placeholder_email" v-model = "email" type="email" class="form-control  " :class="{ 'is-invalid' :errorEmail}"
                                           autocomplete="email" />


                                <span v-if="errorEmail" class="invalid-feedback" role="alert">
                                        <strong> {{ errorEmail }}</strong>
                                    </span>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                            <div class="col-md-6">
                                <my-input :placeholder = "placeholder_password" v-model = "password" type="password" class="form-control  " :class="{ 'is-invalid' :errorPassword}"  />


                                <span v-if="errorPassword" class="invalid-feedback" role="alert">
                                        <strong>{{errorPassword}}</strong>
                                    </span>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Подтвердите
                                пароль</label>

                            <div class="col-md-6">
                                <my-input  :placeholder = "placeholder_password_confirmation" v-model = "password_confirmation" type="password" class="form-control" />
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click.prevent ="store()" type="submit" class="btn btn-primary">
                                    Регистрация
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "register",
    data(){
        return{
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            placeholder_name: 'Имя пользователя',
            placeholder_email: 'Email',
            placeholder_password: 'Пароль',
            placeholder_password_confirmation: 'Подтвердите пароль',

            errorName: null,
            errorEmail: null,
            errorPassword: null,
        }


    },
    methods:{
        store(){
            axios.post('/api/vue/user/reg' ,{name: this.name,email: this.email,password: this.password, password_confirmation:this.password_confirmation})
            .then(data => {

              localStorage.setItem('access_token', data.data.access_token)
            }).catch(data =>{
                this.errorName = data.response.data.errors && data.response.data.errors.name ? data.response.data.errors.name[0] : null;
                this.errorEmail =  data.response.data.errors && data.response.data.errors.email ? data.response.data.errors.email[0] : null;
                this.errorPassword = data.response.data.errors && data.response.data.errors.password ? data.response.data.errors.password[0] : null;

            })
        }
    }
}
</script>

<style scoped>

</style>
