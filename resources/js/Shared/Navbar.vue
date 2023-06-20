<template>
    <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
        <div class="container-xl">
            <UserDropdown v-if="$page.props.shared.isAuth" type="navbar" />

            <div class="collapse navbar-collapse" id="navbar-menu"></div>
        </div>
    </header>
</template>

<script>
import UserDropdown from "./UserDropdown.vue";

export default {
    components: {UserDropdown}
}
</script>
