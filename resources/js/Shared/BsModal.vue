<template>
    <slot name="btn" v-if="withBtn" :show="show">
        <button :class="[btnClass]" v-bind="$attrs" @click="show">
            {{ btnText }}
        </button>
    </slot>

    <Teleport to="body">
        <div :id="`modal${uid}`" class="modal modal-blur fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document"
             :class="{ [`modal-${getSize}`]: !!getSize, 'modal-dialog-centered': centered}">
            <div class="modal-content">
                <slot name="content">
                    <form @submit.prevent="$emit('submit', $event)">
                        <div class="modal-header" v-if="!headerDisable">
                            <slot name="header">
                                <div class="modal-title">
                                    <slot v-if="$slots.title" name="header"/>

                                    <span v-if="!$slots.title && title">
                                        {{ title }}
                                    </span>
                                </div>

                                <button v-if="close" type="button" class="btn-close" @click="hide"></button>
                            </slot>
                        </div>
                        <div class="modal-body">
                            <slot/>
                        </div>
                        <div v-if="$slots.footer" class="modal-footer">
                            <slot name="footer" :hide="hide"/>
                        </div>
                    </form>
                </slot>
            </div>
        </div>
    </div>
    </Teleport>
</template>

<script>
import Uuid from "../Mixins/Uuid";

export default {
    name: 'BsModal',
    emits: ['show', 'shown', 'hide', 'hidden', 'submit'],
    mixins: [Uuid],
    props: {
        title: String,
        backdrop: {
            type: [Boolean, String],
            default: true
        },

        close: {
            type: Boolean,
            default: true
        },

        focus: {
            type: Boolean,
            default: true
        },

        keyboard: {
            type: Boolean,
            default: true
        },

        size: {
            type: String,
            required: false
        },

        small: Boolean,
        large: Boolean,

        centered: Boolean,
        headerDisable: Boolean,

        withBtn: Boolean,
        btnClass: {
            type: String,
            default: 'btn btn-primary'
        },
        btnText: {
            type: String,
            default: 'Показать'
        },

        visibility: Boolean
    },

    computed: {
        getSize() {
            if (this.small) {
                return 'sm'
            }

            if (this.large) {
                return 'lg'
            }

            return this.size
        }
    },

    mounted() {
        this.initializeModal()
    },

    beforeUnmount() {
        this.hide()
    },

    methods: {
        show() {
            this.$modal.show()

            return this
        },
        hide() {
            this.$modal.hide()

            return this
        },
        toggle() {
            this.$modal.toggle()

            return this
        },
        initializeModal() {
            this.$modal = new bootstrap.Modal(`#modal${this.uid}`, {
                show: false,
                focus: this.focus,
                backdrop: this.backdrop,
                keyboard: this.keyboard
            })

            this.$modal._element.addEventListener('show.bs.modal', (e) => this.$emit('show', e));
            this.$modal._element.addEventListener('shown.bs.modal', (e) => this.$emit('shown', e));
            this.$modal._element.addEventListener('hide.bs.modal', (e) => this.$emit('hide', e));
            this.$modal._element.addEventListener('hidden.bs.modal', (e) => this.$emit('hidden', e));
        }
    }
}
</script>
