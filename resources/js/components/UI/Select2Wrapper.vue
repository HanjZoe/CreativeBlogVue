<template>
    <select ref="selectElement">
        <slot></slot>
    </select>
</template>

<script>
export default {
    name: 'Select2Wrapper',
    props: {
        options: {
            type: Array,
            default: () => []
        }
    },
    mounted() {
        $(this.$refs.selectElement).select2({
            data: this.options
        }).on('change', () => {
            this.$emit('input', $(this.$refs.selectElement).val());
        });
    },
    watch: {
        options(newOptions) {
            $(this.$refs.selectElement).empty().select2({
                data: newOptions
            });
        }
    },
    beforeDestroy() {
        $(this.$refs.selectElement).off().select2('destroy');
    }
};
</script>
