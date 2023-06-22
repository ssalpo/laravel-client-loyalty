<script>
import {defineComponent} from 'vue'
import {
    IconPlayerPlay,
    IconPlayerStop,
    IconReload,
} from "@tabler/icons-vue"
import {Link} from "@inertiajs/inertia-vue3";

export default defineComponent({
    name: "BulkMessageProcessButtons",
    props: ['bulkMessage'],
    components: {
        Link,
        IconPlayerPlay,
        IconPlayerStop,
        IconReload,
    }
})
</script>

<template>
    <Link :href="route('bulk-messages.mark-as-sending', bulkMessage.id)"
          method="post"
          preserve-state
          as="button"
          v-if="[1,3,5].includes(bulkMessage.status)"
          class="btn btn-sm btn-icon btn-outline-primary">
        <IconPlayerPlay :size="18" stroke-width="1.7"/>
    </Link>

    <Link :href="route('bulk-messages.repeat-sending', bulkMessage.id)"
          method="post"
          preserve-state
          as="button"
          v-if="bulkMessage.status === 4"
          class="btn btn-sm btn-icon btn-outline-danger">
        <IconReload :size="18" stroke-width="1.7"/>
    </Link>

    <Link
        :href="route('bulk-messages.mark-as-cancel', bulkMessage.id)"
        method="post"
        preserve-state
        as="button"
        v-if="bulkMessage.status === 2"
        class="btn btn-sm btn-icon btn-outline-danger">
        <IconPlayerStop :size="18" stroke-width="1.7"/>
    </Link>
</template>
