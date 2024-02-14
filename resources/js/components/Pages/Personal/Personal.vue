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
                                <h3>{{this.likeCount}}</h3>

                                <p>Понравившиеся посты</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-thumbs-up"></i>
                            </div>
                            <router-link :to="{ name: 'personal.like'}" class="small-box-footer">  Подробнее <i class="fas fa-arrow-circle-right"></i> </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{this.commentCount}}</h3>

                                <p>Оставленные комментарии</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <router-link :to="{ name: 'personal.comment'}" class="small-box-footer"> Подробнее <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </div>
                    <!-- ./col -->
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
    name: "Personal",
        data(){
        return{
            likeCount: null,
            commentCount: null,
        }
        },
    methods:{
        index() {
            api.post('/api/vue/personal').then(data => {
                this.likeCount = data.data.posts
                this.commentCount = data.data.comments
            })
        }
    },
    mounted() {
        this.index()
    }
}
</script>

<style scoped>

</style>
