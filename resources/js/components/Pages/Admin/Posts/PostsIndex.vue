<template>
    <div className="content-wrapper">
        <!-- Content Header (Page header) -->
        <div className="content-header">
            <div className="container-fluid">
                <div className="row mb-2">
                    <div className="col-sm-6">
                        <h1 className="m-0">Посты</h1>
                    </div><!-- /.col -->
                    <div className="col-sm-6">
                        <ol className="breadcrumb float-sm-right">
                            <li className="breadcrumb-item"><a href="#">Главная</a></li>
                            <li className="breadcrumb-item active">Посты</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section className="content">
            <my-post-grid/>
        </section>
        <!-- /.content -->
    </div>
</template>
<script>
import api from "../../../../api";
export default {

    name: "PostsIndex",
    data() {
        return {}
    },
    mounted() {
        this.getCategory()
    },
    methods: {
        getCategory() {
            api.get('/api/vue/admin/category').then(data => {
                    console.log(data)
                    data.data.forEach((element) => {
                        element.created_at = new Date(element.created_at).toLocaleString();
                    });
                    this.categories = data.data
                }
            ).catch(function (e) {
                console.log(e)
            })
        },
        updateCategory(id, newTitle) {
            api.patch(`/api/vue/admin/category/${id}`, {title: newTitle})
                .then(data => {
                    this.getCategory()
                }).catch(function (e) {
                console.log(e)
            })
        },
        deleteCategory(category) {
            api.delete(`/api/vue/admin/category/${category}`)
                .then(data => {
                    this.getCategory()
                })
                .catch(function (e) {
                    console.log(e)
                })
        },
        storeCategory(title) {
            console.log(title)
            axios.post(`/api/vue/admin/category`, {title: title})
                .then(data => {
                    this.getCategory()
                })
                .catch(function (e) {
                    console.log(e)
                })
        }
    },
}
</script>
<style scoped>
</style>
