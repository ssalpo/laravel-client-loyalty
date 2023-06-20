<template>
    <PageWrapper
        header-title="История транзакций"
    >
        <card without-body>
            <EmptyResult v-if="!pointTransactions.data.length" />

            <div class="table-responsive" v-else>
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th>Клиент</th>
                        <th>Бонус</th>
                        <th>Сумма покупки</th>
                        <th>Дата создания</th>
                        <th width="120"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="pointTransaction in pointTransactions.data">
                        <td>{{ pointTransaction.client.name }}</td>
                        <td>{{ pointTransaction.amount }}</td>
                        <td>{{ pointTransaction.sell_amount }}</td>
                        <td class="text-muted">
                            {{ pointTransaction.created_at_formatted }}
                        </td>
                        <td class="text-end">
                            <EditLinkBtn
                                :url="route('point-transactions.edit', pointTransaction.id)"
                                class="me-2"
                            />

                            <delete-btn
                                :url="route('point-transactions.destroy', pointTransaction.id)"
                            />
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <template #cardFooter v-if="pointTransactions.links.length > 3">
                <Pagination class="float-end" :links="pointTransactions.links"/>
            </template>
        </card>

    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Card from "../../Shared/Card.vue";
import DeleteBtn from "../../Shared/DeleteBtn.vue";
import EditLinkBtn from "../../Shared/EditLinkBtn.vue";
import {IconCirclePlus} from "@tabler/icons-vue";
import EmptyResult from "../../Shared/EmptyResult.vue";
import Pagination from "../../Shared/Pagination.vue";

export default {
    components: {Pagination, EmptyResult, IconCirclePlus, EditLinkBtn, DeleteBtn, Card, PageWrapper, Link},
    props: ['pointTransactions']
}
</script>
