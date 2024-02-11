<template>
    <div>
        <dropzone ref="myDropzone" @vdropzone-file-added="handleFileAdded"></dropzone>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    methods: {
        // Обработка добавленного файла
        handleFileAdded(file) {
            this.$refs.myDropzone.removeAllFiles(); // Удаляем все текущие файлы из Dropzone
            this.$refs.myDropzone.addFile(file); // Добавляем новый файл в Dropzone
        },
        // Получение изображения через Axios
        fetchImage() {
            axios.get('your-api-endpoint')
                .then(response => {
                    const imageUrl = response.data;

                    // Создаем объект файла, который будет добавлен в Dropzone
                    const file = {
                        name: imageUrl.substring(imageUrl.lastIndexOf('/') + 1), // Получаем имя файла из URL
                        url: imageUrl, // URL изображения
                    };

                    this.handleFileAdded(file); // Добавляем изображение в Dropzone
                })
                .catch(error => {
                    console.error('Error fetching image:', error);
                });
        },
    },
    mounted() {
        // Получаем изображение при монтировании компонента
        this.fetchImage();
    },
};
</script>
