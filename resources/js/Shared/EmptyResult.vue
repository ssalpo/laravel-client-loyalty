<template>
    <div class="empty">
        <div class="empty-img"><img src="../../img/undraw_quitting_time_dm8t.svg" height="128" alt="">
        </div>
        <p class="empty-title" v-if="title">
            {{title}}
        </p>
        <p class="empty-subtitle text-muted" v-if="description">
            {{description}}
        </p>
    </div>
</template>

<script>
export default {
    name: "EmptyResult",
    props: {
        title: {
            type: String,
            default: 'Список пуст.'
        },
        description: {
            type: String,
            default: 'Нет подходящих данных для вывода.'
        }
    }
}
</script>
