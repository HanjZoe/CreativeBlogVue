<template>
    <header class="edica-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="/"><img src="/assets/images/logo.svg" alt="Edica"></a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#edicaMainNav" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="edicaMainNav">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Блог <span class="sr-only">(current)</span></a>
                        </li>
                        //if

                        <li class="nav-item">
                            <a class="nav-link" href="/vue/login">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vue/registration">Регистрация</a>
                        </li>

                      //else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="/vue/personal" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                имя пользователя
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                               // if
                                <a class="dropdown-item" href="/vue/admin">
                                    Админ панель
                                </a>
                              // endif
                                <a class="dropdown-item" href="/vue/personal'">
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
                       // endif
                    </ul>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    name: "MainePageHeader"
}
</script>

<style>

</style>
