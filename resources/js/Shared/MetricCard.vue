<template>
    <div class="card card-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-auto" v-if="$slots.icon">
                    <div class="text-white avatar" :class="[iconBg]">
                        <slot name="icon"/>
                    </div>
                </div>
                <div class="col">
                    <div class="font-weight-medium">
                        {{ cardTitle }}
                    </div>
                    <div class="text-muted" v-if="cardDescription">
                        {{ cardDescription }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MetricCard",
    props: {
        iconBg: {
            type: String,
            default: 'bg-red'
        },
        cardTitle: {
            type: String,
            required: true
        },
        cardDescription: String
    }
}
</script>

<style scoped>

</style>
