<template>
    <PageWrapper
        :header-title="!point?.id ? `Начисление бонуса` : `Редактирование бонуса`"
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

                    <NewClientModal @success="setClient" />
                </div>

                <div class="col col-sm-6 offset-sm-3">
                    <NumericField
                        label="Сумма покупки"
                        label-required
                        placeholder="Введите сумму покупки"
                        v-model="form.sell_amount"
                        :invalid-text="form.errors.sell_amount"
                    />
                </div>

                <div class="col col-sm-6 offset-sm-3 mt-3" v-if="form.sell_amount > 0 && defaultPercent > 0">
                    Бонусы для начисления: <strong class="badge">{{numberFormat(form.sell_amount * (defaultPercent / 100))}}</strong>
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
import NewClientModal from "../../Shared/Modals/NewClientModal.vue";

export default {
    components: {NewClientModal, SelectClients, NumericField, TextInput, Card, PageWrapper, Link},
    props: ['point', 'defaultPercent'],
    data() {
        return {
            form: useForm({
                sell_amount: this.point?.sell_amount,
                client_id: this.point?.client_id,
            })
        }
    },
    methods: {
        numberFormat,
        submit() {
            if (!this.point?.id) {
                this.form.post(route('points.store'));
                return;
            }

            this.form.put(route('points.update', this.point.id))
        },
        setClient(client) {
            this.$refs.selectClients.refreshData();

            this.form.client_id = parseInt(client.id)
        }
    }
}
</script>
