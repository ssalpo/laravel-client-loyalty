<template>
    <slot name="btn" v-if="withBtn" :open="open">
        <button :class="[btnClass]" v-bind="$attrs" @click="open">
            {{ btnText }}
        </button>
    </slot>

    <Teleport to="body">
        <div class="modal-backdrop fade" :class="{show: isOpen}" v-if="isOpen" @click="close"></div>

        <div class="modal modal-blur fade" :class="{show: isOpen, 'd-block': isOpen === true}">
            <div class="modal-dialog modal-dialog-scrollable" :class="{'modal-dialog-centered': centered}">
                <div class="modal-content">
                    <div class="modal-header" v-if="!headerDisable">
                        <h4 class="modal-title">
                            <slot v-if="$slots.header" name="header"/>

                            <span v-if="!$slots.header && headerTitle">
                                {{ headerTitle }}
                            </span>
                        </h4>
                        <button type="button" class="btn-close" @click="close"></button>
                    </div>

                    <div class="modal-body">
                        <slot/>
                    </div>

                    <div class="modal-footer text-right" v-if="$slots.footer">
                        <slot name="footer" :close="close" :submit="submit"/>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </Teleport>
</template>

<script>

export default {
    inheritAttrs: false,
    name: 'Modal',
    emits: ['open', 'close'],
    props: {
        headerDisable: {
            type: Boolean,
            default: false
        },
        headerTitle: String,
        centered: {
            type: Boolean,
            default: true
        },
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
    data() {
        return {
            isOpen: false
        }
    },
    methods: {
        open() {
            this.isOpen = true

            this.$emit('open')
        },
        close() {
            this.isOpen = false

            this.$emit('close')
        },
        submit() {
            this.$emit('submit')
        },
        toggleBodyClass(status) {
            const body = document.querySelector("body")

            if (status === true) {
                body.classList.add("modal-open")
                return
            }

            body.classList.remove("modal-open")
        }
    },
    mounted() {
        let vm = this

        document.querySelector('.modal').addEventListener('click', function(e) {
            if (e.target !== e.currentTarget) return
            vm.close()
        });
    },
    watch: {
        isOpen(status) {
            this.toggleBodyClass(status)
        },
        visibility: {
            immediate: true,
            handler(status) {
                if (status) this.open()
                else this.close()

                this.toggleBodyClass(status)
            }
        }
    }
}
</script>
