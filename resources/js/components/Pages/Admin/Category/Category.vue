<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Категории</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Категории</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
        <my-category-grid
            :categories = "this.categories"
        @remove = "deleteCategory"
        @update = "updateCategory"
        @store = "storeCategory"/>
        </section>
        <!-- /.content -->
    </div>
</template>
<script>
import api from "../../../../api";
export default {
    name: "Category",

    data() {
        return {
            categories:{
                Type: Array,
                default: () => [],
            }
        }
    },
    mounted() {
        this.getCategory()
    },
    methods: {
        getCategory(){
            api.get('/api/vue/admin/category').then(data =>{
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
            api.patch(`/api/vue/admin/category/${id}`,{title: newTitle})
                .then(data => {
                this.getCategory()
            }).catch(function (e){
                console.log(e)
            })
        },
        deleteCategory(category){
            api.delete(`/api/vue/admin/category/${category}`)
                .then(data =>{
                    this.getCategory()
                })
                .catch(function (e){
                    console.log(e)
                })
        },

        storeCategory(title){
            console.log(title)
            api.post(`/api/vue/admin/category`,{title: title})
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
