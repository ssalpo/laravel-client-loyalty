<template>
    <PageWrapper
        header-title="Настройки"
    >
        <form @submit.prevent="submit">
            <card>
                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <NumericField
                        label="Процент начисления"
                        class="mb-3"
                        label-required
                        autocomplete="off"
                        placeholder="Введите процент начисления"
                        v-model="form.default_percent"
                        :invalid-text="form.errors.default_percent"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <TextInput
                        type="time"
                        label="Время отправки сообщения для поздравления на день рождение"
                        class="mb-3"
                        label-required
                        v-model="form.send_birthday_gift_time"
                        :invalid-text="form.errors.send_birthday_gift_time"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3">
                    <TextArea
                        label="Шаблон для отправки при поздравлении на день рождение"
                        class="mb-3"
                        label-required
                        autocomplete="off"
                        placeholder="Введите текст"
                        v-model="form.birthday_template"
                        :invalid-text="form.errors.birthday_template"
                    />
                </div>

                <template #cardFooter>
                    <div class="col col-sm-6 offset-sm-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary me-2">
                            Сохранить
                        </button>
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
import NumericField from "../../Shared/Form/NumericField.vue";
import TextArea from "../../Shared/Form/TextArea.vue";

export default {
    components: {TextArea, NumericField, TextInput, Card, PageWrapper, Link},
    props: ['setting'],
    data() {
        return {
            form: useForm({
                default_percent: this.setting?.default_percent,
                send_birthday_gift_time: this.setting?.send_birthday_gift_time,
                birthday_template: this.setting?.birthday_template,
            })
        }
    },
    methods: {
        submit() {
            this.form.put(route('settings.update'))
        }
    }
}
</script>
