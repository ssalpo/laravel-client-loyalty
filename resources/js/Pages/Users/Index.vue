<template>
    <PageWrapper
        header-title="Пользователи"
    >

        <template #headerActions>
            <Link :href="route('users.create')" class="btn btn-primary">
                <IconCirclePlus :size="18" class="me-2" stroke-width="1.7" />
                Добавить пользователя
            </Link>
        </template>


        <card without-body>
            <EmptyResult v-if="!users.length" />

            <div class="table-responsive" v-else>
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th width="40">ID</th>
                        <th>Имя</th>
                        <th>Логин</th>
                        <th>Дата создания</th>
                        <th width="120"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.username }}</td>
                        <td class="text-muted">
                            {{ user.created_at_formatted }}
                        </td>
                        <td class="text-end">
                            <EditLinkBtn
                                :url="route('users.edit', user.id)"
                                class="me-2"
                            />

                            <delete-btn
                                :url="route('users.destroy', user.id)"
                            />
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
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

export default {
    components: {EmptyResult, IconCirclePlus, EditLinkBtn, DeleteBtn, Card, PageWrapper, Link},
    props: ['users']
}
</script>
