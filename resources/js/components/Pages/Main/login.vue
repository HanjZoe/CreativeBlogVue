<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Форма входа</div>

                    <div class="card-body">

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

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button @click.prevent="login()" type="submit" class="btn btn-primary">
                                    Войти
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
    name: "login",
    data(){
        return{

            email: null,
            password: null,
            placeholder_email: 'Email',
            placeholder_password: 'Пароль',
            errorEmail: null,
            errorPassword: null,
        }


    },
    methods:{
      login(){
          axios.post('/api/auth/login' ,{email: this.email, password: this.password})
              .then(data => {
                  localStorage.setItem('access_token', data.data.access_token)
              }).catch(data =>{
              this.errorEmail =  data.response.data.errors && data.response.data.errors.email ? data.response.data.errors.email[0] : null;
              this.errorPassword = data.response.data.errors && data.response.data.errors.password ? data.response.data.errors.password[0] : null;

          })
      }
    },
}
</script>

<style scoped>

</style>
