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
                Aklify
            </h1>

            <div class="navbar-collapse collapse" id="sidebar-menu" style="">
                <ul class="navbar-nav pt-lg-3">
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

export default {
    components: {
        Link,
        UserDropdown
    },
    methods: {
        logout() {
            this.$inertia.delete(route('logout'))
        }
    }
}
</script>
