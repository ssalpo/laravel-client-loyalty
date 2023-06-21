<template>
    <label class="form-label" :class="{required: labelRequired}" :for="uid" v-if="label">{{ label }}</label>
    <textarea
        type="text"
        :id="uid"
        v-bind="$attrs"
        @input="$emit('update:modelValue', $event.target.value)"
        :value="modelValue"
        class="form-control" :class="{'is-invalid': invalidText}"
    ></textarea>

    <div class="invalid-feedback" v-if="invalidText && !withoutInvalidText">{{ invalidText }}</div>
</template>

<script>
import Uuid from "../../Mixins/Uuid";

export default {
    mixins: [Uuid],
    props: {
        label: String,
        labelRequired: Boolean,
        modelValue: [Number, String],
        invalidText: String,
        withoutInvalidText: Boolean,
    }
}
</script>
