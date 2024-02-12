<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <ul class="pt-3 nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <router-link :to="{ name: 'admin.index'}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Главная
                    </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'admin.category'}" class="nav-link">
                    <i class="nav-icon fas fa-solid fa-bars"></i>
                    <p>
                        Категории
                    </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'admin.tag'}" class="nav-link">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>
                        Тэги
                    </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'post.index'}" class="nav-link">
                    <i class="nav-icon fas fa-clipboard"></i>
                    <p>
                        Посты
                    </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'admin.user'}" class="nav-link">
                    <i class="nav-icon fas fa-user-alt"></i>
                    <p>
                        Пользователи
                    </p>
                    </router-link>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script>
export default {
    name: "AdminNavBar"
}
</script>

<style scoped>

</style>
