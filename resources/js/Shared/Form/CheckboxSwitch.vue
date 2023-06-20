<template>
    <label class="form-check form-switch">
        <input class="form-check-input" type="checkbox" :checked="modelValue" @change="$emit('update:modelValue', $event.target.checked)" />
        <span class="form-check-label" v-if="label">{{label}}</span>
    </label>
</template>

<script>
export default {
    props: {
        label: String,
        value: [String, Boolean, Number],
        modelValue: {
            type: [String, Boolean, Number],
            required: true
        }
    }
}
</script>
