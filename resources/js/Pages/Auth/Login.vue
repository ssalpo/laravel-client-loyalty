<template>
    <Head>
        <title>Авторизация</title>
    </Head>

    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <h1 class="navbar-brand navbar-brand-autodark" style="font-size: 18px">
                    <IconBuilding :size="28" class="me-2" stroke-width="2" />
                    Aklify
                </h1>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Авторизация</h2>
                    <form @submit.prevent="submit" autocomplete="off">
                        <div class="mb-3">
                            <TextInput
                                label="Логин"
                                placeholder="Введите логин"
                                v-model="form.username"
                                :invalid-text="form.errors.username"
                            />
                        </div>

                        <div class="mb-2">
                            <TextInput
                                label="Пароль"
                                type="password"
                                placeholder="Введите пароль"
                                v-model="form.password"
                                :invalid-text="form.errors.password"
                            />
                        </div>

                        <div class="form-footer">
                            <button type="submit" :disabled="form.processing" class="btn btn-primary w-100">Войти</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3'
import AuthLayout from "../../Layouts/AuthLayout.vue";
import TextInput from "../../Shared/Form/TextInput.vue";
import {IconBuilding} from "@tabler/icons-vue";

export default {
    layout: AuthLayout,
    components: {IconBuilding, TextInput, Link, Head},
    data() {
        return {
            form: useForm({
                username: null,
                password: null
            }),
        }
    },
    methods: {
        submit() {
            this.form.post('/login');
        }
    },
}
</script>
