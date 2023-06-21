<template>
    <PageWrapper
        meta-title="Дашборд"
    >
        <div>
            <Link class="btn btn-lg btn-outline-primary mb-3" :href="route('points.create')">
                Начислить бонус
            </Link>

            <Link :href="route('point-transactions.create')" class="btn btn-lg btn-outline-danger mb-3 ms-4">
                Использовать бонус
            </Link>
        </div>

        <card
            class="mb-4"
            without-body
            card-title="Начислено бонусов за сегодня"
        >
            <EmptyResult v-if="!points.length" />

            <div class="table-responsive" v-else>
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th>Клиент</th>
                        <th>Бонус</th>
                        <th>Сумма покупки</th>
                        <th>Процент</th>
                        <th>Дата создания</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="point in points">
                        <td>{{ point.client.name }}</td>
                        <td>{{ numberFormat(point.amount) }}</td>
                        <td>{{ numberFormat(point.sell_amount) }}</td>
                        <td>{{ numberFormat(point.percent) }}%</td>
                        <td class="text-muted">
                            {{ point.created_at_formatted }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </card>

        <card
            without-body
            card-title="Использовано бонусов за сегодня"
        >
            <EmptyResult v-if="!pointTransactions.length" />

            <div class="table-responsive" v-else>
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th>Клиент</th>
                        <th>Бонус</th>
                        <th>Сумма покупки</th>
                        <th>Дата создания</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="pointTransaction in pointTransactions">
                        <td>{{ pointTransaction.client.name }}</td>
                        <td>{{ numberFormat(pointTransaction.amount) }}</td>
                        <td>{{ numberFormat(pointTransaction.sell_amount) }}</td>
                        <td class="text-muted">
                            {{ pointTransaction.created_at_formatted }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </card>
    </PageWrapper>
</template>
<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import PageWrapper from "../Shared/PageWrapper.vue";
import Card from "../Shared/Card.vue";
import DeleteBtn from "../Shared/DeleteBtn.vue";
import EditLinkBtn from "../Shared/EditLinkBtn.vue";
import EmptyResult from "../Shared/EmptyResult.vue";
import {numberFormat} from "../functions";

export default {
    methods: {numberFormat},
    components: {EmptyResult, EditLinkBtn, DeleteBtn, Card, PageWrapper, Head, Link},
    props: ['points', 'pointTransactions']
}
</script>
