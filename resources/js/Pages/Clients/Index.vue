<template>
    <PageWrapper
        header-title="Клиенты"
        header-pre-title="В списке отображается все ваши добавленные клиенты"
    >

        <template #headerActions>
            <Link :href="route('clients.create')" class="btn btn-primary">
                <IconCirclePlus :size="18" class="me-2" stroke-width="1.7" />
                Добавить клиента
            </Link>
        </template>


        <card without-body>
            <EmptyResult v-if="!clients.data.length" />

            <div class="table-responsive" v-else>
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th width="40">ID</th>
                        <th>Название</th>
                        <th>Телефон</th>
                        <th>Дата рождения</th>
                        <th>Дата создания</th>
                        <th width="120"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="client in clients.data">
                        <td>{{ client.id }}</td>
                        <td>{{ client.name }}</td>
                        <td>{{ client.phone }}</td>
                        <td>{{ client.birthday_formatted }}</td>
                        <td class="text-muted">
                            {{ client.created_at_formatted }}
                        </td>
                        <td class="text-end">
                            <EditLinkBtn
                                :url="route('clients.edit', client.id)"
                                class="me-2"
                            />

                            <delete-btn
                                :url="route('clients.destroy', client.id)"
                            />
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <template #cardFooter v-if="clients.links.length > 3">
                <Pagination class="float-end" :links="clients.links"/>
            </template>
        </card>

    </PageWrapper>
</template>

<script>
import PageWrapper from "../../Shared/PageWrapper.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Card from "../../Shared/Card.vue";
import DeleteBtn from "../../Shared/DeleteBtn.vue";
import Pagination from "../../Shared/Pagination.vue";
import EditLinkBtn from "../../Shared/EditLinkBtn.vue";
import {IconCirclePlus} from "@tabler/icons-vue";
import EmptyResult from "../../Shared/EmptyResult.vue";

export default {
    components: {EmptyResult, IconCirclePlus, EditLinkBtn, Pagination, DeleteBtn, Card, PageWrapper, Link},
    props: ['clients']
}
</script>
