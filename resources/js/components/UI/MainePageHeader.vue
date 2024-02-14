<template>
    <header class="edica-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <router-link class="navbar-brand" :to="{ name: 'main.index'}"><img src="/assets/images/logo.svg" alt="Edica"></router-link>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                        data-target="#edicaMainNav" aria-controls="collapsibleNavId" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="edicaMainNav">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{ name: 'main.index'}">Блог <span class="sr-only">(current)</span></router-link>
                        </li>


                        <li v-if="!userName" class="nav-item">
                            <a class="nav-link" href="/login">Войти</a>
                        </li>
                        <li v-if="!userName" class="nav-item">
                            <a class="nav-link" href="/registration">Регистрация</a>
                        </li>

                        <li v-if="userName" class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ userName.name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <a v-if="userName.role === 0" class="dropdown-item" href="/admin">
                                    Админ панель
                                </a>
                                <a class="dropdown-item" href="/personal">
                                    Личный кабинет
                                </a>
                                <a @click.prevent="this.logout()" class="dropdown-item">
                                    Выйти
                                </a>

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
import api from "../../api";

export default {
    name: "MainePageHeader",
    props: {
        userName: null,
    },
    methods:{
        logout(){
            api.post('/api/auth/logout').then(() => {
                localStorage.removeItem('access_token')
                document.location.href = '/login'
            })
        }
    },
    mounted() {

    }
}

</script>

<style>

</style>
