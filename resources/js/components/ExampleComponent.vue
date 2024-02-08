<template>
    <select ref="selectElement" multiple v-model="selectedValues">
        <slot></slot>
    </select>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Select2Wrapper',
    data() {
        return {
            loadedOptions: [],
            selectedValues: [] // Добавляем переменную для хранения выбранных значений
        };
    },
    mounted() {
        this.loadOptions();
    },
    methods: {
        loadOptions() {
            // Дожидаемся завершения обоих запросов перед инициализацией Select2
            Promise.all([this.getPost(), this.getTag()])
                .then(([postData, tagData]) => {
                    // Здесь вы можете использовать данные из postData и tagData для инициализации Select2
                    // Например, this.loadedOptions = postData.data или this.loadedOptions = tagData.data
                    this.loadedOptions = tagData.data;
                    this.selectedValues = postData.data.tags.map(tag => tag.id);
                    this.initializeSelect2();
                })
                .catch(error => {
                    console.error('Failed to load options:', error);
                });
        },
        getPost() {
            return axios.get(`/api/vue/admin/post/${this.$route.params.id}`);
        },
        getTag() {
            return axios.get('/api/vue/admin/tag')
                .then(response => {
                    response.data.forEach((element) => {
                        element.created_at = new Date(element.created_at).toLocaleString();
                        element.deleted_at = 0;
                    });
                    return response;
                })
                .catch(error => {
                    console.error('Failed to load tags:', error);
                    return [];
                });
        },
        initializeSelect2() {
            $(this.$refs.selectElement).select2({
                data: this.loadedOptions.map(option => ({ id: option.id, text: option.title })),
                val: this.selectedValues // Устанавливаем начальное значение для Select2
            }).on('change', () => {
                this.selectedValues = $(this.$refs.selectElement).val(); // Обновляем выбранные значения при изменении в Select2
            });
        }
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
};
</script>
