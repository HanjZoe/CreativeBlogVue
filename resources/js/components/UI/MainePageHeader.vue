<template>
    <header class="edica-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="/"><img src="/assets/images/logo.svg" alt="Edica"></a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                        data-target="#edicaMainNav" aria-controls="collapsibleNavId" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="edicaMainNav">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Блог <span class="sr-only">(current)</span></a>
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

                                <a v-if="userRole === 0" class="dropdown-item" href="/admin">
                                    Админ панель
                                </a>
                                <a class="dropdown-item" href="/personal'">
                                    Личный кабинет
                                </a>
                                <a class="dropdown-item" href="#"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Выйти
                                </a>

                                <form id="logout-form" action="#" method="POST" class="d-none">

                                </form>

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    name: "MainePageHeader",
    props: {
        userName: null,
    },
    mounted() {

    }
}

</script>

<style>

</style>
