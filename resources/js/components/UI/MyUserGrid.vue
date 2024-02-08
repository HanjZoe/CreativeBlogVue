<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 mb-3">

                <my-popup v-model:show = "this.CreateElementVisible">
                    <create-user v-model:roles = "this.roles"
                                 :emailError = "emailError"
                        @store = "storeUser"
                        @show = "showCreate"
                    />
                </my-popup>

                <a href="#" @click.prevent="showCreate" type="button" class="btn btn-block btn-primary " :disabled="!isDisabled">Добавить</a>

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
                        <th class="text-center">Имя пользователя</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Дата создания</th>
                        <th colspan="3" class="text-center">Действия</th>
                            </tr>
                            </thead>
                    <tbody v-for="user in users">
                    <tr :class="showEdit(user.id) ? 'd-none' : ''">
                        <td class="text-center">{{ user.id }}</td>
                        <td class="text-center">{{ user.name }}</td>
                        <td class="text-center">{{ user.email }}</td>
                        <td class="text-center">{{ user.created_at }}</td>
                        <td class="text-center">
                            <my-popup v-model:show = "CreatePostVisible"><show-user :user="userSelect" @remove ="deleteUser(id)"  @show = "hidenDialog" /></my-popup>
                            <a href="#" @click.prevent="ShowDialog(user)"><i class="fas fa-eye"></i></a>
                        </td>
                        <td>
                            <a href="#" @click.prevent="changeEditUserId(user.id,user.role)"class="text-success" ><i class="fas fa-pen"></i></a>
                        </td>
                        <td>
                            <a href="#" @click.prevent="deleteUser(user.id)"><i class="far fa-trash-alt text-danger"></i></a>
                        </td>
                    </tr>

                    <tr :class="showEdit(user.id) ? '' : 'd-none'">
                        <td class="text-center">{{ user.id }}</td>
                        <td class="text-center">
                            <my-input :placeholder="user.name" v-model="newName"/>
                        </td>
                        <td class="text-center">
                            <my-input :placeholder="user.email" v-model="newEmail"/>
                        </td>
                        <td class="text-center">{{ user.created_at }}</td>
                        <td class="text-center">
                            <select v-model="selectedRole">
                                <option v-for="(rl,id) in roles " :key="id" :value="id"
                                        >{{ rl }}
                                </option>
                            </select>
                        </td>
                        <td class="text-center">
                                <a href="#" @click.prevent="editUser(user.id, true, newName, newEmail, selectedRole)"class="text-success" ><i class="fas fa-pen"></i></a>
                    </td>
                        <td class="text-center">
                                <a href="#" @click.prevent="editUser(user.id, false,newName, newEmail, selectedRole)"><i class="fas fa-ban text-danger"></i></a>
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

import ShowUser from "../Pages/Admin/Users/ShowUser";
import MyPopup from "./MyPopup";
export default {
    components: {MyPopup, ShowUser},
    props: {
        users: null,
        roles: null,
        emailError: null,
        CreatePost: false
    },
    data() {
        return {
            newName: null,
            newEmail: null,
            show: false,
            targetUser: null,
            selectedRole: null,
            CreatePostVisible: false,
            userSelect:null,
            CreateElementVisible: false,

        }
    },
    mounted() {

    },
    methods: {
        editUser(id, edit, newName, newEmail,selectedRole) {
            if(edit){
                 this.$emit('update', id, newName, newEmail,selectedRole)
            }
            this.targetUser = null
            this.newName = null
            this.newEmail = null

        },
        changeEditUserId(id, role) {
            this.selectedRole = role
            this.targetUser = id
        },
        showEdit(id) {
            return this.targetUser === id
        },
        ShowDialog(user){
            this.CreatePostVisible = true
            this.userSelect = user

        },
        hidenDialog(){
            this.CreatePostVisible = false
        },
        deleteUser(id){
            this.$emit('remove', id)
        },
        storeUser(email, name,role){
            this.$emit('store', email,name,role)
        },
        hidenCreate(){
            this.CreateElementVisible = false
        },
        showCreate(){
            this.CreateElementVisible = !this.CreateElementVisible
        }
    },
    name: "MyUserGrid"
}


</script>

<style scoped>

</style>
