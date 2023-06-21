<template>
    <PageWrapper
        :header-title="!bulkMessage?.id ? `Новая рассылка` : `Редактирование рассылки №${bulkMessage.id}`"
    >
        <form @submit.prevent="submit">
            <card>
                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        label="Тема рассылки"
                        label-required
                        placeholder="Введите тему рассылки"
                        v-model="form.title"
                        :invalid-text="form.errors.title"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3">
                    <TextArea
                        label="Текст"
                        label-required
                        placeholder="Введите текст для СМС сообщения"
                        v-model="form.content"
                        :invalid-text="form.errors.content"
                    />
                </div>

                <template #cardFooter>
                    <div class="col col-sm-6 offset-sm-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary me-2">
                            {{bulkMessage?.id ? 'Изменить' : 'Добавить'}}
                        </button>
                        <Link :disabled="form.processing" :href="route('bulk-messages.index')" class="btn">Отменить</Link>
                    </div>
                </template>
            </card>
        </form>
    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import Card from "../../Shared/Card.vue";
import TextInput from "../../Shared/Form/TextInput.vue";
import {useForm, Link} from "@inertiajs/inertia-vue3";
import TextArea from "../../Shared/Form/TextArea.vue";

export default {
    components: {TextArea, TextInput, Card, PageWrapper, Link},
    props: ['bulkMessage'],
    data() {
        return {
            form: useForm({
                title: this.bulkMessage?.title,
                content: this.bulkMessage?.content,
            })
        }
    },
    methods: {
        submit() {
            if (!this.bulkMessage?.id) {
                this.form.post(route('bulk-messages.store'));
                return;
            }

            this.form.put(route('bulk-messages.update', this.bulkMessage.id))
        }
    }
}
</script>
