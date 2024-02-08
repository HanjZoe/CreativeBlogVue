<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Добавления поста</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item"><a href="#">Посты</a></li>
                            <li class="breadcrumb-item active">Создание нового поста</li>
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
                    <div class="col-12">

                        <div class="form-group w-25">
                            <my-input :placeholder="titlePlaceholder" v-model="newTitle"/>

                            <div class="text-danger"> message</div>

                        </div>
                        <div class="form-group">
                            <vue-editor v-model="message" :editor-toolbar="customToolbar"  />

                            <div class="text-danger"> message</div>

                        </div>

                        <div class="form-group w-50">
                            <label>Добавить превью</label>
                            <div>
                                <div>
                                    <div class="bg-dark text-center text-light w-50 md-3 p-5" ref="dropzone_prev">
                                        Добавить превью
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="text-danger"> message</div>

                        <div class="form-group w-50">
                            <label for="exampleInputFile">Добавить главное изображение</label>
                            <div>
                                <div>
                                    <div class="bg-dark text-center text-light w-50 md-3 p-5" ref="dropzone_main">
                                        Добавить главное изображение
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="text-danger"> message</div>

                        <div class="form-group w-50">
                            <label>Выберите категорию</label>
                            <select v-model="selectCategory" name="category_id" class="form-control">
                                <option v-for="(category,id) in categories " :key="id" :value="id"
                                >{{ category.title }}
                                </option>
                                <option value="">title</option>
                            </select>

                        </div>

                        <div class="text-danger"> message</div>

                        <div class="form-group w-50">
                            <label>Тэги</label>
                            <select v-model="selectTags" name="tag_ids[]" class="select2" multiple="multiple"
                                    data-placeholder="Выберите тэги" style="width: 100%;">
                                <option v-for="(tag,id) in tags " :key="id" :value="id"
                                >{{ tag.title }}
                                </option>

                            </select>

                            <select  name="tag_ids[]" class="select2" multiple="multiple"
                                     data-placeholder="Выберите тэги" style="width: 100%;">
                                <option>2</option>
                                <option>2</option>
                                <option>2</option>
                                <option>2</option>
                                <option>2</option>

                            </select>
                        </div>

                        <div class="text-danger"> message</div>

                        <div class="form-group">
                            <a href="#" @click.prevent="store()" type="button" class="btn btn-primary">Добавить</a>
                        </div>


                    </div>

                </div><!-- /.container-fluid -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
import Dropzone from 'dropzone'
import { VueEditor } from "vue3-editor";
export default {
    name: "PostCreate",
    data() {
        return {
            dropzone_main: null,
            dropzone_prev: null,
            titlePlaceholder: "Заголовок поста",
            contentPlaceholder: "Заголовок поста",
            newTitle: null,
            content: null,
            message:null,
            tags:null,
            selectTags: {
                Type: Array,
                default: () => [],
            },
            selectCategory: null,
            categories: null,
            customToolbar: [
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                [ "code-block"]
            ]
        }
    },
    components:{
        VueEditor,
    },
    methods: {
        store(){
            console.log("lol")
            const data = new FormData()
            /* const main = this.dropzone_main.getAcceptedFiles()
             const prev = this.dropzone_prev.getAcceptedFiles()*/
            //console.log(files)
            /* data.append('preview_image', prev[0])
             data.append('main_image', main[0])*/
            data.append('title', this.newTitle)
            data.append('message', this.message)
            data.append('category', this.selectCategory)
            data.append('tags[]', this.selectTags)
            console.log(data.title);
            //axios.post('/api/vue/admin/post/store',  data)
        },
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
    },
    computed: {},
    mounted() {
        this.getTag()
        this.getCategory()
        this.dropzone = new Dropzone(this.$refs.dropzone_main, {
            url: "asdas",
            autoProcessQueue: false,
            maxFiles: 1,
            init: function () {
                this.on("addedfile", function (file) {
                    // Удаляем предыдущий файл перед добавлением нового
                    if (this.files[1] != null) {
                        this.removeFile(this.files[0]);
                    }
                });
            }
        })
        this.dropzone = new Dropzone(this.$refs.dropzone_prev, {
            url: "asdas",
            autoProcessQueue: false,
            maxFiles: 1,
            init: function () {
                this.on("addedfile", function (file) {
                    // Удаляем предыдущий файл перед добавлением нового
                    if (this.files[1] != null) {
                        this.removeFile(this.files[0]);
                    }
                });
            }
        })
    }
}
</script>
<style>
.dz-success-mark,
.dz-error-mark{
    display: none;
}
</style>
