<template>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Посты</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><router-link :to="{ name: 'personal.index'}">Главная</router-link></li>
                            <li class="breadcrumb-item active">Понравившиеся посты</li>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th class="text-center">id</th>
                                        <th class="text-center">Название</th>
                                        <th class="text-center">Удалить</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr v-for="post in this.post">
                                        <td class="text-center">{{post.id}}</td>
                                        <td class="text-center">{{post.title}}</td>
                                        <td class="text-center">
                                                <a @click.prevent="unLike(post.id)" class="border-0 bg-transparent">
                                                    <i class="far fa-trash-alt text-danger" role="button"></i>
                                                </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div>


                </div><!-- /.container-fluid -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
import api from "../../../api";
export default {
    name: "Like",
    data(){
        return{
            post: null,
        }
    },
    methods:{
        get(){
            api.post('/api/vue/personal/like').then(data =>{
                this.post = data.data
            })
        },
        unLike(post){
            api.delete(`/api/vue/personal/like/${post}`).then(data =>{
                this.get()
            })
        }
    },
    mounted() {
        this.get()
    }

}
</script>

<style scoped>

</style>
