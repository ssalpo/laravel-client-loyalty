<template>
    <CustomSelect
        ref="selectClients"
        v-bind="$attrs"
        searchable
        prefetch
        remote
        :remote-url="route('autocomplete.clients')"
        full
        placeholder="Выберите клиента"
    />
</template>

<script>
import CustomSelect from "./CustomSelect.vue";

export default {
    name: "SelectClients",
    components: {CustomSelect},
    methods: {
        refreshData() {
            this.$refs.selectClients.refreshData()
        }
    }
}
</script>
