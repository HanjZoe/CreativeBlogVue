<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Пользователи</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Пользователи</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
        <my-user-grid
            :users="users"
            :roles="roles"
            @remove= "deleteUser"
            @update = "updateUser"
            @store = "storeUser"
            ></my-user-grid>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
export default {
    data(){
        return{
            users: null,
            roles:null,
        }
    },
    mounted(){
        this.getUsers()
    },
   methods:{
       getUsers(){
           axios.get('/api/vue/admin/users/')
               .then(data => {
                   console.log(data)
                   data.data.users.forEach((element) => {
                       element.created_at = new Date(element.created_at).toLocaleString();
                   });
                    this.users = data.data.users;
                    this.roles = data.data.roles
               })
               .catch(function (){
                   console.log('sdsddsd')
       })
       },
       updateUser(id, newName, newEmail, newRole){
           console.log(id,newName,newEmail,newRole)
         axios.patch(`/api/vue/admin/users/${id}`,{name: newName, email: newEmail, role: newRole,user_id: id}).then(data => {
             console.log(data)
             this.getUsers()
         }).catch(function (e){
             console.log(e)
         })
       },
       deleteUser(user){
         axios.delete(`/api/vue/admin/users/${user}`)
           .then(data =>{
                this.getUsers()
               console.log(data)
           })
           .catch()

       },
       storeUser(email, name, role){
           console.log(email)
           console.log(name)
           console.log(role)

           axios.post(`/api/vue/admin/users`,{email: email, name:name, role:role})
               .then(data=>{
                   this.getUsers()
                   console.log(data)
               })
               .catch(function (e){
                   console.log(e)
               })
       },
   }

}
</script>

<style scoped>

</style>
