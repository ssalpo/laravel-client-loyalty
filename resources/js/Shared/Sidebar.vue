<template>
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <h1 class="navbar-brand navbar-brand-autodark d-none d-sm-inline-flex" style="font-size: 18px">
                <IconBuilding :size="28" class="me-2" stroke-width="2" />
                Loyalty
            </h1>

            <div class="navbar-collapse collapse" id="sidebar-menu" style="">
                <ul class="navbar-nav pt-lg-3">
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('dashboard.index')"
                            :class="{active: $page.component.startsWith('Dashboard')}"
                        >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <IconHome :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Дашборд
                            </span>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('points.index')"
                            :class="{active: $page.component.startsWith('Points')}"
                        >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <IconListCheck :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                История начислений
                            </span>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('point-transactions.index')"
                            :class="{active: $page.component.startsWith('PointTransactions')}"
                        >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <IconArrowsTransferDown :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                История транзакций
                            </span>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('bulk-messages.index')"
                            :class="{active: $page.component.startsWith('BulkMessages')}"
                        >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <IconMailShare :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Рассылка СМС
                            </span>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('clients.index')"
                            :class="{active: $page.component.startsWith('Clients')}"
                        >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <IconUsersGroup :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Клиенты
                            </span>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('users.index')"
                            :class="{active: $page.component.startsWith('Users')}"
                        >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <IconUser :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Пользователи
                            </span>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('settings.edit')"
                            :class="{active: $page.component.startsWith('Settings')}"
                        >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <IconAdjustmentsHorizontal :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Настройки
                            </span>
                        </Link>
                    </li>

                    <li class="nav-item d-inline-flex d-sm-none">
                        <a href="#" @click.prevent="logout" class="nav-link">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <IconLogin :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Выйти
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
</template>

<script>
import UserDropdown from "./UserDropdown.vue"
import {Link} from "@inertiajs/inertia-vue3"
import {
    IconHome,
    IconMailShare,
    IconListCheck,
    IconUsersGroup,
    IconBuilding,
    IconUser,
    IconLogin,
    IconArrowsTransferDown,
    IconAdjustmentsHorizontal,
} from "@tabler/icons-vue"

export default {
    components: {
        Link,
        UserDropdown,
        IconHome,
        IconMailShare,
        IconListCheck,
        IconLogin,
        IconUser,
        IconUsersGroup,
        IconBuilding,
        IconArrowsTransferDown,
        IconAdjustmentsHorizontal,
    },
    methods: {
        logout() {
            this.$inertia.delete(route('logout'))
        }
    }
}
</script>
