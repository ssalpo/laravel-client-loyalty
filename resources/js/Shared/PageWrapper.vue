<template>
    <Head v-if="useTitleAsMeta">
        <title>{{metaTitle || headerTitle}}</title>
    </Head>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none" v-if="headerTitleIsShow">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <slot name="headerRewrite" />

                    <div :class="{'col-sm-12 col-md-auto': !headerInline, 'col-auto': headerInline}" v-if="!$slots.headerRewrite">
                        <!-- Page pre-title -->
                        <h2 class="page-title" v-if="$slots.headerTitle || headerTitle">
                            <slot v-if="!headerTitle" name="headerTitle"/>

                            <span class="text-truncate" v-else>
                                <Link :href="backUrl" v-if="backUrl" class="text-primary">
                                    <IconArrowBack :size="14" stroke-width="2" />
                                </link>

                                {{ headerTitle }}
                            </span>
                        </h2>

                        <div class="page-pretitle" v-if="$slots.headerPreTitle || headerPreTitle">
                            <slot v-if="!headerPreTitle" name="headerPreTitle"/>

                            <span v-else>{{ headerPreTitle }}</span>
                        </div>
                    </div>

                    <!-- Page title actions -->
                    <div class="ms-auto" :class="{'col-sm-12 col-md-auto': !headerInline, 'col-auto': headerInline}" v-if="$slots.headerActions && !$slots.headerRewrite">
                        <div class="btn-list">
                            <slot name="headerActions"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <slot/>
            </div>
        </div>
    </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import {IconArrowBack} from "@tabler/icons-vue"
export default {
    props: {
        backUrl: String,
        headerPreTitle: String,
        headerTitle: String,
        headerInline: Boolean,
        metaTitle: String,
        useTitleAsMeta: {
            type: Boolean,
            default: true
        }
    },
    components: {Head, Link, IconArrowBack},
    computed: {
        headerTitleIsShow() {
            return this.$slots.headerPreTitle || this.$slots.headerTitle || this.headerTitle || this.headerPreTitle;
        }
    }
}
</script>
