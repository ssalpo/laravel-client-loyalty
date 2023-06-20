<template>
    <div class="page">
        <!-- Sidebar -->
        <Sidebar />

        <!-- Navbar -->
        <Navbar />

        <slot />
    </div>

    <Toasts />
</template>
<script>
import Sidebar from "../Shared/Sidebar.vue";
import Navbar from "../Shared/Navbar.vue";
import Toasts from "../Shared/Toasts.vue";

export default {
    components: {Navbar, Sidebar, Toasts}
}
</script>
