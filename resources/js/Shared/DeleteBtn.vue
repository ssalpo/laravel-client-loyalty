<template>
    <button type="button" class="btn" :class="[btnSize, btnStyle]" :disabled="loading" @click="submit">
        <slot>
            <IconTrashX v-if="iconOnly" :size="iconSize" stroke-width="2" />
            <span v-else>Уд.</span>
        </slot>
    </button>
</template>

<script>
import {IconBusinessplan, IconTrashX} from "@tabler/icons-vue";

export default {
    name: "DeleteBtn",
    components: {IconBusinessplan, IconTrashX},
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
            default: 'btn-outline-danger'
        },
        data: {
            type: Object,
            default: {}
        },
        showConfirm: {
            type: Boolean,
            default: true
        },
        confirmText: {
            type: String,
            default: 'Вы уверены что хотите удалить?'
        },
        iconOnly: {
            type: Boolean,
            default: true
        },
        iconSize: {
            type: Number,
            default: 18
        }
    },
    data: () => ({
        loading: false
    }),
    methods: {
        submit() {
            let vm = this;

            if (this.showConfirm && !confirm(this.confirmText)) {
                return;
            }

            this.loading = true;

            this.$inertia.delete(this.url, {
                data: this.data,
                preserveScroll: true,
                preserveState: true,
                onSuccess() {
                    vm.loading = false
                }
            })
        }
    }
}
</script>
