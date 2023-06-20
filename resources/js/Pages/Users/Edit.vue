<template>
    <PageWrapper
        :header-title="!user?.id ? `Новый пользователь` : `Редактирование ${user.name}`"
    >
        <form @submit.prevent="submit">
            <card>
                <div class="col col-sm-6 offset-sm-3">
                    <TextInput
                        label="Имя"
                        class="mb-3"
                        label-required
                        autocomplete="off"
                        placeholder="Введите имя пользователя"
                        v-model="form.name"
                        :invalid-text="form.errors.name"
                    />

                    <TextInput
                        label="Логин"
                        class="mb-3"
                        label-required
                        autocomplete="off"
                        placeholder="Введите логин пользователя"
                        v-model="form.username"
                        :invalid-text="form.errors.username"
                    />

                    <TextInput
                        type="password"
                        label="Пароль"
                        class="mb-3"
                        :label-required="!user?.id"
                        placeholder="Введите пароль"
                        autocomplete="off"
                        v-model="form.password"
                        :invalid-text="form.errors.password"
                    />
                </div>

                <template #cardFooter>
                    <div class="col col-sm-6 offset-sm-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary me-2">
                            {{user?.id ? 'Изменить' : 'Добавить'}}
                        </button>
                        <Link :disabled="form.processing" :href="route('users.index')" class="btn">Отменить</Link>
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

export default {
    components: {TextInput, Card, PageWrapper, Link},
    props: ['user'],
    data() {
        return {
            form: useForm({
                name: this.user?.name,
                username: this.user?.username,
                password: null,
            })
        }
    },
    methods: {
        submit() {
            if (!this.user?.id) {
                this.form.post(route('users.store'));
                return;
            }

            this.form.put(route('users.update', this.user.id))
        }
    }
}
</script>
