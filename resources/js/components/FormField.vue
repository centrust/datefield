<template>
    <DefaultField
        :field="field"
        :errors="errors"
        :show-help-text="showHelpText"
        :full-width-content="fullWidthContent"
    >
        <template #field>
            <div class="flex items-center">
                <flat-pickr
                    v-model="value"

                    class="form-control form-input form-input-bordered"
                    :dusk="field.attribute"
                    :name="field.name"
                    :disabled="currentlyIsReadonly"

                    :config="{
            enableTime: false,
            dateFormat: formating,
            altInput: true,
            altFormat: formating,
            defaultDate: value,
            time_24hr: true,
            allowInput:true
            }"
                />
            </div>
        </template>
    </DefaultField>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'
import FlatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import isNil from "lodash/isNil";
import {DateTime} from 'luxon'

export default {
    components: {FlatPickr},
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field', 'format'],

    data() {
        return {
            date: null,
            currentlyIsReadonly: false,
            value: null,
            formating: this.field.format || 'Y-m-d',
        }
    },
    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            if (!isNil(this.currentField.value)) {
                this.value = DateTime.fromISO(this.currentField.value || this.value, {
                    setZone: Nova.config('userTimezone') || Nova.config('timezone'),
                }).toISODate()
            }

            // this.date = this.value
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value
         */
        handleChange(event) {
            let value = event?.target?.value ?? event
            console.log('handleChange', value)
            this.value = DateTime.fromISO(value, {
                // setZone: Nova.config('userTimezone') || Nova.config('timezone'),
            }).toISODate()
            console.log('fromISO', value)
            if (this.field) {
                this.emitFieldValueChange(this.field.attribute, this.value)
            }
        },
    },

    mounted() {
        console.log('mounted', this.formating)
        this.setInitialValue()

    }
}
</script>
