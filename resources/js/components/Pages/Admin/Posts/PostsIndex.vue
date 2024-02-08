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
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Посты</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
        <my-post-grid/>
        </section>
        <!-- /.content -->
    </div>
</template>
<script>
export default {
    name: "PostsIndex",
    data() {
        return {

        }
    },
    mounted() {
        this.getCategory()
    },
    methods: {
        getCategory(){
            axios.get('/api/vue/admin/category').then(data =>{
                console.log(data)
                data.data.forEach((element) => {
                    element.created_at = new Date(element.created_at).toLocaleString();
                });
                this.categories = data.data
                }
            ).catch(function (e){
                console.log(e)
            })
        },
        updateCategory(id, newTitle){
            axios.patch(`/api/vue/admin/category/${id}`,{title: newTitle})
                .then(data => {
                this.getCategory()
            }).catch(function (e){
                console.log(e)
            })
        },
        deleteCategory(category){
            axios.delete(`/api/vue/admin/category/${category}`)
                .then(data =>{
                    this.getCategory()
                })
                .catch(function (e){
                    console.log(e)
                })
        },

        storeCategory(title){
            console.log(title)
            axios.post(`/api/vue/admin/category`,{title: title})
                .then(data=>{

                    this.getCategory()
                })
                .catch(function (e){
                    console.log(e)
                })
        }
    },
}
</script>
<style scoped>
</style>
