<template>

    <div class="col-sm-6 d-flex align-items-center">
        <h1 class="m-0 mr-2">Категория {{ tag.text }}</h1>
        <a href="#" @click.prevent="deleteClikc(tag.id)" class="border-0 bg-transparent"><i class="far fa-trash-alt text-danger"></i></a>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th class="text-center">id</th>
                <th class="text-center">Название</th>
                <th class="text-center">Дата создания</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">{{ tag.id }}</td>
                <td class="text-center">{{ tag.text }}</td>
                <td class="text-center">{{ tag.created_at }}</td>

            </tr>
            </tbody>
        </table>

    </div>
</template>
<script>

export default {
    name: "ShowTag",
    props: {
        tag: {
            Type: Array,
            default: () => [],
        }


    },
    emits: ['remove', 'show'],
    methods:{
        deleteClikc(id){
            this.$emit('remove', id)
            this.$emit('show')
        }
    }

}
</script>

<style scoped>

</style>
