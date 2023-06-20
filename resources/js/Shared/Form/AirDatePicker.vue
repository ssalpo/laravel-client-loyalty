<template>
    <label class="form-label" :class="{required: labelRequired}" :for="`datepicker-${uid}`" v-if="label">{{
            label
        }}</label>

    <input :id="`datepicker-${uid}`" v-bind="$attrs" :ref="uid" class="form-control" v-show="!inline" type="text"/>

    <div class="invalid-feedback-simple" v-if="invalidText && !withoutInvalidText">{{ invalidText }}</div>
</template>

<script>
import Uuid from "../../Mixins/Uuid"
import AirDatepicker from 'air-datepicker'
import 'air-datepicker/air-datepicker.css'
import {parse} from 'date-fns'
import { createPopper } from '@popperjs/core'

export default {
    name: "AirDatePicker",
    mixins: [Uuid],
    props: {
        label: String,
        labelRequired: Boolean,
        invalidText: String,
        withoutInvalidText: Boolean,
        modelValue: {
            type: [String, Number, Array, Object, Boolean],
        },
        monthPicker: Boolean,
        dateFormat: {
            type: String,
            default: 'dd.MM.yyyy'
        },
        options: {
            type: Object,
            default: {}
        },
        selectCurrentDate: Boolean,
        autoClose: {
            type: Boolean,
            default: true
        },
        asModal: {
            type: Boolean,
            default: false
        },
        range: Boolean,
        timepicker: Boolean,
        timepickerFormat: {
            type: String,
            default: 'hh:mm'
        },
        inline: Boolean,
        selectedDates: [Date, Array],
        disabledDates: Array,

        multipleDates: [Boolean, Number],
        multipleDatesSeparator: {
            type: String,
            default: ' - '
        },
        parseDisabled: Boolean,
        parseFormat: {
            type: String,
            default: 'dd.MM.yyyy' // date-fnt date format
        },

        minDate: String,
        maxDate: String,
    },
    data() {
        return {
            instance: null
        }
    },
    mounted() {
        this.instance = new AirDatepicker(this.$refs[this.uid], this.defaultOptions())

        if (this.modelValue) {
            this.instance.selectDate(this.parseValue(this.modelValue))
        }

        this.selectCurrentDefaultDate()

        this.setMinDate(this.minDate)
        this.setMaxDate(this.maxDate)
    },
    methods: {
        parseValue(v) {
            if(this.parseDisabled) return v;

            return Array.isArray(v)
                ? v.map(e => parse(e, this.parseFormat, new Date))
                : parse(v, this.parseFormat, new Date)
        },
        setMinDate(v) {
            if(!v) {
                this.instance.update({minDate: ''})
                return
            }

            this.instance.update({minDate: this.parseValue(v)})
        },
        setMaxDate(v) {
            if(!v) {
                this.instance.update({maxDate: ''})
                return
            }

            this.instance.update({maxDate: this.parseValue(v)})
        },
        selectCurrentDefaultDate() {
            if (!this.selectCurrentDate) return

            this.instance.selectDate(new Date)
        },
        onSelect({date, formattedDate, datepicker}) {
            this.$emit('update:modelValue', formattedDate)
        },
        onRenderCell({date, cellType}) {
            if (cellType === 'day' && this.disabledDates) {
                if (this.disabledDates.filter(item => item.getTime() === date.getTime()).length > 0) {
                    return {disabled: true}
                }
            }
        },
        defaultOptions() {
            let vm = this

            let options = {
                ...this.options,
                onSelect: this.onSelect,
                onRenderCell: this.onRenderCell,
                dateFormat: this.dateFormat,
                autoClose: this.autoClose,

                range: this.range,
                multipleDatesSeparator: this.multipleDatesSeparator,

                timepicker: this.timepicker,
                timepickerFormat: this.timepickerFormat,

                inline: this.inline,

                selectedDates: this.selectedDates,

                multipleDates: this.multipleDates,

                position({$datepicker, $target, $pointer, done}) {
                    let popper = createPopper($target, $datepicker, {
                        placement: 'bottom',
                        strategy: 'fixed',
                        modifiers: [
                            {
                                name: 'computeStyle',
                                enabled: true,
                                phase: 'beforeWrite',
                                fn({state}) {
                                    if(vm.asModal) {
                                        state.styles.popper = {
                                            ...state.styles.popper,
                                            position: 'fixed',
                                            left: `${(window.innerWidth - state.rects.popper.width) / 2}px`,
                                            top: '50%',
                                            transform: 'translateY(-50%)',
                                        }
                                    }

                                    return state
                                },
                            },
                            {
                                name: 'flip',
                                options: {
                                    padding: {
                                        top: 0
                                    }
                                }
                            },
                            {
                                name: 'offset',
                                options: {
                                    offset: [0, 20]
                                }
                            },
                            {
                                name: 'arrow',
                                options: {
                                    element: $pointer
                                }
                            }
                        ]
                    })

                    return function completeHide() {
                        popper.destroy();
                        done();
                    }
                }
            }

            // Config for month picker
            if (this.monthPicker) {
                options = {
                    ...options,
                    view: 'months',
                    minView: 'months'
                }
            }

            if (this.asModal) {
                options = {
                    ...options,
                    isMobile: true,
                    autoClose: true
                }
            }

            return options
        }
    },
    watch: {
        minDate(v) {
            this.setMinDate(v)
        },
        maxDate(v) {
            this.setMaxDate(v)
        }
    },
    unmounted() {
        if (!this.instance) return;

        this.instance.destroy();
    }
}
</script>

<style>
.air-datepicker-global-container {
    z-index: 99999999 !important;
}
</style>
