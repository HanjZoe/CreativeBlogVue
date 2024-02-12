<template>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Главная</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Главная</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{this.categoriesCount}}</h3>

                                <p>Категории</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-solid fa-bars"></i>
                            </div>
                            <router-link :to="{ name: 'admin.category'}" class="small-box-footer">  Подробнее <i class="fas fa-arrow-circle-right"></i> </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{this.tagsCount}}</h3>

                                <p>Тэги</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <router-link :to="{ name: 'admin.tag'}" class="small-box-footer"> Подробнее <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{this.postsCount}}</h3>

                                <p>Посты</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clipboard"></i>
                            </div>
                            <router-link :to="{ name: 'post.index'}" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i> </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{this.usersCount}}</h3>

                                <p>Пользователи</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-alt"></i>
                            </div>
                            <router-link :to="{ name: 'admin.user'}" class="small-box-footer"> Подробнее <i class="fas fa-arrow-circle-right"></i> </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

</template>

<script>
import api from "../../../api";
export default {
    name: "Admin",
    data(){
        return{
            usersCount: null,
            postsCount: null,
            categoriesCount: null,
            tagsCount: null,
        }
    },
    methods: {
        getAdmin() {
            api.get('/api/vue/admin').then(data => {
                console.log(data)
                this.usersCount = data.data.usersCount
                this.postsCount = data.data.postsCount
                this.categoriesCount = data.data.categoriesCount
                this.tagsCount = data.data.tagsCount
            })
        }
    },
    mounted() {
        this.getAdmin()
    }
}
</script>

<style scoped>

</style>
