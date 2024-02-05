<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 mb-3">

        <my-popup v-model:show = "this.CreateElementVisible">
            <create-tag
                @store = "storeTag"
                @show = "hidenCreate"
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
                    <tbody v-for="tag in tags">
                    <tr :class="showEdit(tag.id) ? 'd-none' : ''">
                        <td class="text-center">{{ tag.id }}</td>
                        <td class="text-center">{{ tag.title }}</td>
                        <td class="text-center">{{ tag.created_at }}</td>
                        <td class="text-center">

                            <my-popup v-model:show="this.EditElementVisible">
                                <show-tag :tag="tagSelect"  @show="hidenDialog" @remove="deleteTag"/>
                            </my-popup>
                            <a class="text-center" href="#" @click.prevent="ShowDialog(tag)"><i
                                class="fas fa-eye"></i></a>
                        </td>
                        <td>
                            <a href="#" @click.prevent="changeEditTagId(tag.id)" class="text-success" ><i class="fas fa-pen"></i></a>
                        </td>
                        <td>
                            <a href="#" @click.prevent="deleteTag(tag.id)"><i class="far fa-trash-alt text-danger"></i></a>
                        </td>
                    </tr>

                    <tr  :class="showEdit(tag.id) ? '' : 'd-none'">
                        <td class="text-center">{{ tag.id }}</td>
                        <td class="text-center">
                            <my-input :placeholder="tag.title" v-model="newTitle"/>
                        </td>
                        <td class="text-center">{{ tag.created_at }}</td>
                        <td class="text-center">
                                <a href="#" @click.prevent="editTag(tag.id, true, newTitle)"  class="text-success"><i class="fas fa-pen"></i></a>
                        </td>
                        <td class="text-center">
                                <a href="#" @click.prevent="editTag(tag.id, false, newTitle)"><i class="fas fa-ban text-danger"></i></a>
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
    name: "MyTagGrid",
    props: {
        tags: {
            type: Object,
            default: () => [],
        },
    },
        data() {
            return {
                newTitle: null,
                show: false,
                targetTag: null,
                tagSelect: null,
                CreateElementVisible: false,
                EditElementVisible: false,
            }
        },
        methods: {
            showCreate() {
                this.CreateElementVisible = true
            },
            changeEditTagId(id) {
                this.targetTag = id
            },
            showEdit(id) {
                return this.targetTag === id
            },
            ShowDialog(tag) {
                this.EditElementVisible = true
                this.tagSelect = tag

            },
            hidenDialog(){
                this.EditElementVisible = false
            },
            hidenCreate(){
                this.CreateElementVisible = false
            },
            deleteTag(id) {

                 this.$emit('remove', id)

            },
            editTag(id, edit, newTitle) {
                if(newTitle != null) {
                    if (edit) {
                        this.$emit('update', id, newTitle)
                    }
                }
                this.targetTag = null
                this.newTitle = null
            },
            storeTag(Title){
                this.$emit('store', Title)
            }

        },


}
</script>

<style scoped>

</style>
