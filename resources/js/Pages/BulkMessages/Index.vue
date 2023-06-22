<template>
    <PageWrapper
        header-title="Рассылка СМС"
    >
        <template #headerActions>
            <Link :href="route('bulk-messages.create')" class="btn btn-primary">
                <IconCirclePlus :size="18" class="me-2" stroke-width="1.7"/>
                Новая рассылка
            </Link>
        </template>

        <card without-body>
            <EmptyResult v-if="!bulkMessages.data.length"/>

            <div class="table-responsive" v-else>
                <table class="table table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th width="60"></th>
                        <th>Тема сообщения</th>
                        <th>Текст СМС</th>
                        <th>Статус</th>
                        <th class="text-center">Получили</th>
                        <th>Дата создания</th>
                        <th width="120"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="bulkMessage in bulkMessages.data">
                        <td>
                            <BulkMessageProcessButtons
                                v-if="!hasAnySendingProcess || bulkMessage.status === 2"
                                :bulk-message="bulkMessage"
                            />
                        </td>
                        <td>{{ bulkMessage.title }}</td>
                        <td class="text-truncate">{{ bulkMessage.content }}</td>
                        <td>
                            <span @click="showErrors(bulkMessage)" class="cursor-pointer badge" :class="[`${statusBadgeColors[bulkMessage.status]}`]">{{
                                    statusLabels[bulkMessage.status] || '-'
                                }}</span>
                        </td>
                        <td class="text-center">{{ bulkMessage.total_received }}</td>
                        <td class="text-muted">
                            {{ bulkMessage.created_at_formatted }}
                        </td>
                        <td class="text-end">
                            <EditLinkBtn
                                v-if="bulkMessage.status !== 2"
                                :url="route('bulk-messages.edit', bulkMessage.id)"
                                class="me-2"
                            />

                            <delete-btn
                                v-if="bulkMessage.status !== 2"
                                :url="route('bulk-messages.destroy', bulkMessage.id)"
                            />
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <template #cardFooter v-if="bulkMessages.links.length > 3">
                <Pagination class="float-end" :links="bulkMessages.links"/>
            </template>
        </card>

        <Modal
            ref="errorModal"
            header-title="Ошибка отправки"
        >
            <div class="text-danger">
                {{selectedBulkMessage?.send_error_message}}
            </div>
        </Modal>

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
import BulkMessageProcessButtons from "../../Shared/BulkMessageProcessButtons.vue";
import Modal from "../../Shared/Modal.vue";

export default {
    components: {
        Modal,
        BulkMessageProcessButtons,
        Pagination,
        EmptyResult,
        IconCirclePlus,
        EditLinkBtn,
        DeleteBtn,
        Card,
        PageWrapper,
        Link
    },
    props: ['bulkMessages', 'statusLabels', 'statusBadgeColors', 'hasAnySendingProcess'],
    data() {
        return {
            selectedBulkMessage: null
        }
    },
    methods: {
        showErrors(bulkMessage) {
            console.log(bulkMessage.status);

            if(bulkMessage.status !== 4) return;

            this.selectedBulkMessage = bulkMessage;
            this.$refs.errorModal.open();
        }
    }
}
</script>
