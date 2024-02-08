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

                            <div v-if="this.titleError" class="text-danger m-2"> {{ this.titleError }}</div>

                        </div>
                        <div class="form-group">
                            <vue-editor v-model="message" :editor-toolbar="customToolbar"/>

                            <div v-if="this.contentError" class="text-danger m-2"> {{ this.contentError }}</div>

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

                        <div v-if="this.preview_imageError" class="text-danger m-2"> {{ this.preview_imageError }}</div>

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

                        <div v-if="this.main_imageError" class="text-danger m-2"> {{ this.main_imageError }}</div>

                        <div class="form-group w-50">
                            <label>Выберите категорию</label>
                            <select v-model="selectCategory" name="category_id" class="form-control">
                                <option v-for="(category,id) in categories " :key="id" :value="category.id"
                                >{{ category.title }}
                                </option>
                            </select>

                        </div>

                        <div v-if="this.category_idError" class="text-danger m-2"> {{ this.category_idError }}</div>

                        <label>Тэги</label>
                        <div class="form-group ">
                            <select ref="selectElement"  class="w-50" multiple v-model="selectTags">
                                <slot></slot>
                            </select>
                        </div>


                        <div v-if="this.tag_idsError" class="text-danger m-2"> {{ this.tag_idsError }}</div>

                        <div class="form-group">
                            <button href="#" @click.prevent="store()" class="btn btn-primary" :disabled="!isDisabled">
                                Добавить
                            </button>
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
import {VueEditor} from "vue3-editor";
import router from "../../../../router/router";
import axios from "axios";

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
            message: null,
            tags: null,
            selectTags: [14, 16],
            selectTagsOld: [
                { id: 14, title: 'Option 1' },
                { id: 16, title: 'Option 2' },
                { id: 3, title: 'Option 3' }
            ],
            selectCategory: null,
            categories: null,
            customToolbar: [
                ["bold", "italic", "underline"],
                [{list: "ordered"}, {list: "bullet"}],
                ["code-block"]
            ],
            selectedValue: null,
            titleError: null,
            contentError: null,
            preview_imageError: null,
            main_imageError: null,
            category_idError: null,
            tag_idsError: null,
            loadedOptions: [],
            selectedValues: [],
        }
    },
    components: {
        VueEditor,
    },
    methods: {
        getPost() {
           return  axios.get(`/api/vue/admin/post/${this.$route.params.id}`).then(data => {

                this.newTitle = data.data.title
                this.message = data.data.content
                this.selectCategory = data.data.category_id
               this.selectTags = data.data.tags.map(tag => tag.id); // Преобразуем массив объектов в массив идентификаторов
               console.log('getPost() выполнен успешно. Вызываем initializeSelect2()');
               this.initializeSelect2(); // Вызываем метод инициализации Select2 после загрузки данных
                return data.data.tags

            })
        },

        store() {

            const data = new FormData()
            const main = this.dropzone_main.getAcceptedFiles()
            const prev = this.dropzone_prev.getAcceptedFiles()
            const tags = this.selectTags
            data.append('preview_image', prev[0])
            data.append('main_image', main[0])
            data.append('title', this.newTitle)
            data.append('content', this.message)
            data.append('category_id', this.selectCategory)
            tags.forEach(tag => {
                data.append('tag_ids[]', parseInt(tag))
            })

            axios.post('/api/vue/admin/post/store', data).then(data => {
                    router.push({name: "post.index"})
                }
            ).catch(data => {
                this.titleError = data.response.data.errors.title[0]
                this.contentError = data.response.data.errors.content[0]
                this.preview_imageError = data.response.data.errors.preview_image[0]
                this.main_imageError = data.response.data.errors.main_image[0]
                this.category_idError = data.response.data.errors.category_id[0]
                this.tag_idsError = data.response.data.errors.tag_ids[0]
            })
        },
        getCategory() {
            axios.get('/api/vue/admin/category').then(data => {

                    data.data.forEach((element) => {
                        element.created_at = new Date(element.created_at).toLocaleString();
                    });
                    this.categories = data.data

                }
            ).catch(function (e) {
                console.log(e)
            })
        },
        getTag() {
            return axios.get('/api/vue/admin/tag')
                .then(data => {
                    data.data.forEach((element) => {
                        element.created_at = new Date(element.created_at).toLocaleString();
                        element.deleted_at = 0;
                    });
                    return data;
                })
                .catch(error => {
                    console.error('Failed to load tags:', error);
                    return [];
                });
        },

        select() {
            Promise.all([this.getPost(), this.getTag()])
                .then(([postData, tagData]) => {
                    // Здесь вы можете использовать данные из postData и tagData для инициализации Select2
                    // Например, this.loadedOptions = postData.data или this.loadedOptions = tagData.data
                    console.log(postData)
                    this.loadedOptions = tagData.data;
                    this.selectedValues = postData.map(tag => tag.id);
                    this.initializeSelect2();
                })
                .catch(error => {
                    console.error('Failed to load options:', error);
                });
        },

        initializeSelect2() {
            console.log(this.selectTags)
            $(this.$refs.selectElement).select2({
                data: this.selectTagsOld.map(option => ({ id: option.id, text: option.title })),
                val: this.selectTags // Устанавливаем начальное значение для Select2
            }).trigger('change'); // Принудительно вызываем событие change, чтобы Select2 обновил свое состояние
        }

    },


    computed: {
        isDisabled() {
            //return true
            return this.dropzone_main && this.dropzone_prev && this.newTitle && this.message && this.selectTags && this.selectCategory
        }
    },
    mounted() {


        this.select()
        this.getCategory()
       /* this.getTag()

        this.getPost()*/

        this.dropzone_main = new Dropzone(this.$refs.dropzone_main, {
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
        this.dropzone_prev = new Dropzone(this.$refs.dropzone_prev, {
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


    },

    watch: {
        loadedOptions(newOptions) {
            $(this.$refs.selectElement).empty().select2({
                data: newOptions.map(option => ({ id: option.id, text: option.title }))
            });
        },
        selectedValues(newSelectedValues) {
            this.$emit('update:modelValue', newSelectedValues); // Эмитируем событие обновления для v-model
        }
    },
    beforeDestroy() {
        $(this.$refs.selectElement).off().select2('destroy');
    }

}
</script>
<style>
.dz-success-mark,
.dz-error-mark {
    display: none;
}
</style>
