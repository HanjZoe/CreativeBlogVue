<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Тэги</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Тэги</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <my-tag-grid
                :tags = "this.tags"
                @remove = "deleteTag"
                @update = "updateTag"
                @store = "storeTag"/>
        </section>
        <!-- /.content -->
    </div>
</template>
<script>
export default {
    name: "Tag",
    data() {
        return {
            tags:{
                Type: Array,
                default: () => [],
            }
        }
    },
    mounted() {
        this.getTag()
    },
    methods: {
        getTag(){
            axios.get('/api/vue/admin/tag').then(data =>{

                    data.data.forEach((element) => {
                        element.created_at = new Date(element.created_at).toLocaleString();
                    });
                    this.tags = data.data
                console.log(this.tags)
                }
            ).catch(function (e){
                console.log(e)
            })
        },
        updateTag(id, newTitle){
            axios.patch(`/api/vue/admin/tag/${id}`,{title: newTitle})
                .then(data => {
                    this.getTag()
                }).catch(function (e){
                console.log(e)
            })
        },
        deleteTag(Tag){
            axios.delete(`/api/vue/admin/tag/${Tag}`)
                .then(data =>{
                    this.getTag()
                })
                .catch(function (e){
                    console.log(e)
                })
        },

        storeTag(title){
            console.log(title)
            axios.post(`/api/vue/admin/tag`,{title: title})
                .then(data=>{

                    this.getTag()
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
