<template>
    <PageWrapper
        :header-title="!point?.id ? `Использование бонуса` : `Редактирование`"
    >
        <form @submit.prevent="submit">
            <card>
                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <SelectClients
                        ref="selectClients"
                        label-required
                        v-model="form.client_id"
                        :invalid-text="form.errors.client_id"
                        label="Клиент"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3 mb-3">
                    <NumericField
                        label="Сумма покупки"
                        label-required
                        placeholder="Введите сумму покупки"
                        v-model="form.sell_amount"
                        :invalid-text="form.errors.sell_amount"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3">
                    <NumericField
                        label="Кол-во бонусов для использования"
                        label-required
                        placeholder="Введите кол-во бонусов для использования"
                        v-model="form.amount"
                        :invalid-text="form.errors.amount"
                    />
                </div>

                <template #cardFooter>
                    <div class="col col-sm-6 offset-sm-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary me-2">
                            {{ point?.id ? 'Изменить' : 'Добавить' }}
                        </button>

                        <Link :disabled="form.processing" :href="route('dashboard.index')" class="btn">Отменить</Link>
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
import SelectClients from "../../Shared/Form/SelectClients.vue";
import {numberFormat} from "../../functions";

export default {
    components: {SelectClients, NumericField, TextInput, Card, PageWrapper, Link},
    props: ['point', 'defaultPercent'],
    data() {
        return {
            form: useForm({
                client_id: this.point?.client_id,
                sell_amount: this.point?.sell_amount,
                amount: this.point?.amount,
            })
        }
    },
    methods: {
        numberFormat,
        submit() {
            if (!this.point?.id) {
                this.form.post(route('point-transactions.store'));
                return;
            }

            this.form.put(route('point-transactions.update', this.point.id))
        }
    }
}
</script>
