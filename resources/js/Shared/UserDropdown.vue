<template>
    <button v-if="type === 'navbar'" class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav flex-row order-md-last me-3" v-if="type === 'navbar'">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
               aria-label="Open user menu" aria-expanded="false">
                <span class="avatar avatar-sm avatar-rounded">
                    <IconUserCircle :size="24" stroke-width="2"/>
                </span>
                <div class="d-none d-xl-block ps-2">
                    <div>{{$page.props.shared.userName}}</div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <Link :href="route('logout')" method="delete" class="dropdown-item" as="button">
                    Выйти
                </Link>
            </div>
        </div>
    </div>

    <a href="#" v-if="type === 'sidebar'" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
        <span class="avatar avatar-sm avatar-rounded">
            <IconUserCircle :size="24" stroke-width="2"/>
        </span>
        <div class="d-none d-xl-block ps-2">
            <div>{{$page.props.shared.userName}}</div>
        </div>
    </a>

    <div v-if="type === 'sidebar'" class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <Link :href="route('logout')" method="delete" class="dropdown-item" as="button">
            Выйти
        </Link>
    </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import {IconCreditCard, IconUserCircle} from "@tabler/icons-vue";

export default {
    props: {
        type: String
    },
    components: {IconCreditCard, Head, Link, IconUserCircle}
}
</script>
