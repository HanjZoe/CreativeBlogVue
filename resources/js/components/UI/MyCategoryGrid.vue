<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 mb-3">

                <my-popup v-model:show="this.CreateElementVisible">
                    <create-category
                        @store="storeCategory"
                        @show="hidenCreate"
                    />
                </my-popup>

                <a href="#" @click.prevent="showCreate" type="button" class="btn btn-block btn-primary">Добавить</a>

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
                            <tbody v-for="category in categories">
                            <tr :class="showEdit(category.id) ? 'd-none' : ''">
                                <td class="text-center">{{ category.id }}</td>
                                <td class="text-center">{{ category.title }}</td>
                                <td class="text-center">{{ category.created_at }}</td>
                                <td class="text-center">

                                    <my-popup v-model:show="this.EditElementVisible">
                                        <show-category :category="categorySelect" @show="hidenDialog"
                                                       @remove="deleteCategory"/>
                                    </my-popup>
                                    <a class="text-center" href="#" @click.prevent="ShowDialog(category)"><i
                                        class="fas fa-eye"></i></a>
                                </td>
                                <td>
                                    <a href="#" @click.prevent="changeEditCategoryId(category.id)" class="text-success"><i
                                        class="fas fa-pen"></i></a>
                                </td>
                                <td>
                                    <a href="#" @click.prevent="deleteCategory(category.id)"><i
                                        class="far fa-trash-alt text-danger"></i></a>
                                </td>
                            </tr>

                            <tr :class="showEdit(category.id) ? '' : 'd-none'">
                                <td class="text-center">{{ category.id }}</td>
                                <td class="text-center">
                                    <my-input :placeholder="category.title" v-model="newTitle"/>
                                </td>
                                <td class="text-center">{{ category.created_at }}</td>
                                <td class="text-center">
                                    <a href="#" @click.prevent="editCategory(category.id, true, newTitle)"
                                       class="text-success"><i class="fas fa-pen"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="#" @click.prevent="editCategory(category.id, false, newTitle)"><i
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
</template>

<script>

export default {
    name: "MyCategoryGrid",
    props: {
        categories: {
            type: Object,
            default: () => [],
        },
    },
    data() {
        return {
            newTitle: null,
            show: false,
            targetCategory: null,
            categorySelect: null,
            CreateElementVisible: false,
            EditElementVisible: false,
        }
    },
    methods: {
        showCreate() {
            this.CreateElementVisible = true
        },
        changeEditCategoryId(id) {
            this.targetCategory = id
        },
        showEdit(id) {
            return this.targetCategory === id
        },
        ShowDialog(category) {
            this.EditElementVisible = true
            this.categorySelect = category

        },
        hidenDialog() {
            this.EditElementVisible = false
        },
        hidenCreate() {
            this.CreateElementVisible = false
        },
        deleteCategory(id) {

            this.$emit('remove', id)

        },
        editCategory(id, edit, newTitle) {
            if (newTitle != null) {
                if (edit) {
                    this.$emit('update', id, newTitle)
                }
            }
            this.targetCategory = null
            this.newTitle = null
        },
        storeCategory(Title) {
            this.$emit('store', Title)
        }

    },
    mounted() {
        console.log(this.categories)
    }


}
</script>

<style scoped>

</style>
