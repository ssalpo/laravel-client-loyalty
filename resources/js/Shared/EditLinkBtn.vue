<template>
    <Link :href="url" v-bind="$attrs" class="btn" :class="[btnSize, btnStyle]">
        <slot>
            <IconEdit v-if="iconOnly" :size="iconSize" stroke-width="2"/>
            <span v-else>Ред.</span>
        </slot>
    </Link>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import {IconEdit} from "@tabler/icons-vue";

export default {
    name: "EditLinkBtn",
    components: {IconEdit, Link},
    props: {
        url: {
            type: String,
            required: true
        },
        btnSize: {
            type: String,
            default: 'btn-sm'
        },
        btnStyle: {
            type: String,
            default: 'btn-outline-primary'
        },
        iconOnly: {
            type: Boolean,
            default: true
        },
        iconSize: {
            type: Number,
            default: 18
        }
    }
}
</script>
