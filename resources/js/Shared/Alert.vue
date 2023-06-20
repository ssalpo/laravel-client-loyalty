<template>
    <div class="alert alert-dismissible" :class="[type ? `alert-${type}` : '']" role="alert">
        <div class="d-flex">
            <div v-if="$slots.icon">
                <slot name="icon"/>
            </div>

            <div>
                {{ title }}
            </div>
        </div>
        <a class="btn-close" v-if="clearable" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
</template>

<script>
export default {
    props: {
        type: String,
        title: {
            type: String,
            required: true
        },
        clearable: {
            type: Boolean,
            default: false
        }
    }
}
</script>
