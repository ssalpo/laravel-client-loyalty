<template>
    <PageWrapper
        header-title="Список начисленных бонусов"
    >
        <card without-body>
            <EmptyResult v-if="!points.data.length" />

            <div class="table-responsive" v-else>
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th>Клиент</th>
                        <th>Бонус</th>
                        <th>Сумма покупки</th>
                        <th>Процент</th>
                        <th>Дата создания</th>
                        <th width="120"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="point in points.data">
                        <td>{{ point.client.name }}</td>
                        <td>{{ point.amount }}</td>
                        <td>{{ point.sell_amount }}</td>
                        <td>{{ point.percent }}%</td>
                        <td class="text-muted">
                            {{ point.created_at_formatted }}
                        </td>
                        <td class="text-end">
                            <EditLinkBtn
                                :url="route('points.edit', point.id)"
                                class="me-2"
                            />

                            <delete-btn
                                :url="route('points.destroy', point.id)"
                            />
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <template #cardFooter v-if="points.links.length > 3">
                <Pagination class="float-end" :links="points.links"/>
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
    props: ['points']
}
</script>
