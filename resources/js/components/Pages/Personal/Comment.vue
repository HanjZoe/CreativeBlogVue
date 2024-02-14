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
                            <li class="breadcrumb-item">
                                <router-link :to="{ name: 'personal.index'}">Главная</router-link>
                            </li>
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
                                        <th class="text-center">Комментарий</th>
                                        <th colspan="2" class="text-center">Удалить/Изменить</th>
                                    </tr>
                                    </thead>
                                    <tbody v-for="comment in this.comments">

                                    <tr :class="showEdit(comment.id) ? 'd-none' : ''">
                                        <td class="text-center">{{ comment.id }}</td>
                                        <td class="text-center">{{ comment.message }}</td>
                                        <td class="text-center"><a @click.prevent="changeEdit(comment.id)" class="text-success"><i class="fas fa-pen"></i></a></td>
                                        <td class="text-center">
                                            <a @click.prevent="deleteComment(comment.id)" class="border-0 bg-transparent">
                                                <i class="far fa-trash-alt text-danger" role="button"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr :class="showEdit(comment.id) ? '' : 'd-none'">
                                        <td class="text-center">{{ comment.id }}</td>
                                        <td class="text-center">
                                            <my-input :placeholder="comment.message" v-model="newMessage"/>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" @click.prevent="editComment(comment.id, true, newMessage)"
                                               class="text-success"><i class="fas fa-pen"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" @click.prevent="editComment(comment.id, false, newMessage)"><i
                                                class="fas fa-ban text-danger"></i></a>
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
    name: "Comment",
    data() {
        return {
            comments: null,
            commentSelect: null,
            targetComment: null,
            newMessage: null,
        }
    },
    methods: {
        get() {
            api.post('/api/vue/personal/comment').then(data => {
                this.comments = data.data
            })

        },
        deleteComment(comment) {
            api.delete(`/api/vue/personal/comment/${comment}`).then(() => {
                this.get()
            })
        },
        changeEdit(id) {
            this.commentSelect = id
        },
        showEdit(id) {
            return this.commentSelect === id
        },
        editComment(id, edit, newMessage) {
            if (newMessage != null) {
                if (edit) {
                    api.patch(`/api/vue/personal/comment/${this.commentSelect}`,{
                        message:  this.newMessage
                    }).then(data => {
                        this.get()
                    })
                }
            }
            this.commentSelect = null
            this.newMessage = null
        },
    },
    mounted() {
        this.get()
    }
}
</script>

<style scoped>

</style>
