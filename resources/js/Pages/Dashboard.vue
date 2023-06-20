<template>
    <PageWrapper
        header-title="Дашборд"
    >
        <card
            class="mt-3"
            card-title="Дашборд"
        >

        </card>
    </PageWrapper>
</template>
<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import PageWrapper from "../Shared/PageWrapper.vue";
import Card from "../Shared/Card.vue";

export default {
    components: {Card, PageWrapper, Head, Link}
}
</script>
