<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <ul class="pt-3 nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <router-link :to="{ name: 'personal.index'}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Главная
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'personal.like'}" class="nav-link">
                        <i class="nav-icon fas fa-thumbs-up"></i>
                        <p>
                            Понравившиеся посты
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'personal.comment'}" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Комментарии
                        </p>
                    </router-link>
                </li>
            </ul>
        </div>
    </aside>


</template>

<script>
export default {
    name: "MyNavBar"
}
</script>

<style scoped>

</style>
