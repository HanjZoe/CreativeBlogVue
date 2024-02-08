<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 mb-3">

                <router-link :to="{ name: 'post.create'}" class="btn btn-block btn-primary">Добавить</router-link>
            </div>
        </div>
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
                                <th class="text-center">Дата создания</th>
                                <th colspan="3" class="text-center">Удалить/Изменить</th>
                            </tr>
                            </thead>
                            <tbody v-for="post in posts">
                            <tr>

                                <td class="text-center">{{ post.id }}</td>
                                <td class="text-center">{{ post.title }}</td>
                                <td class="text-center">{{ post.created_at }}</td>
                                <td class="text-center">

                                    <my-popup v-model:show="this.EditElementVisible">
                                        <post-show :post="postSelect"  @show="hidenDialog" @remove="deletePost"/>
                                    </my-popup>

                                    <a class="text-center" href="#" @click.prevent="ShowDialog(post)"><i class="fas fa-eye"></i></a>
                                </td>
                                <td>
                                    <a href="#"  class="text-success text-center" ><i class="fas fa-pen"></i></a>
                                </td>
                                <td>
                                    <a href="#" @click.prevent = "deletePost(post.id)" ><i class="far fa-trash-alt text-danger text-center"></i></a>
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
</template>

<script>
import PostShow from "../Pages/Admin/Posts/PostShow";
export default {
    name: "MyPostGrid",
    components: {PostShow},
    props: {
    },
    data() {
        return {
            newTitle: null,
            show: false,
            postSelect:null,
            targetCategory: null,
            categorySelect: null,
            CreateElementVisible: false,
            EditElementVisible: false,
            posts:{
                Type: Array,
                default: () => [],
            }
        }
    },
    mounted() {
        this.getPosts()
    },
    methods: {
        getPosts(){
            axios.get('/api/vue/admin/post').then(data =>{
                    console.log(data)
                    data.data.forEach((element) => {
                        element.created_at = new Date(element.created_at).toLocaleString();
                    });
                    console.log(data.data);
                    this.posts = data.data
                }
            ).catch(function (e){
                console.log(e)
            })
        },
        deletePost(post){
            axios.delete(`/api/vue/admin/post/${post}`)
                .then(data =>{
                    this.getPosts()
                })
                .catch(function (e){
                    console.log(e)
                })
        },
        ShowDialog(post) {
            this.EditElementVisible = true
            this.postSelect = post

        },
        hidenDialog(){
            this.EditElementVisible = false
        },
    },
}
</script>

<style scoped>
</style>
