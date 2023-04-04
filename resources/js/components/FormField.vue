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
                    id="datepicker"
                    :config="configs"
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
import {DateTime} from 'luxon';

import {Arabic as ar} from '../../../dist/js/ar.js'

export default {
    components: {FlatPickr},
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field', 'options'],

    data() {
        return {
            date: null,
            currentlyIsReadonly: false,
            value: null,
            configs: this.field.options,
            ar: {},
            //  options: this.field.options ,
            currentTheme: localStorage.novaTheme === 'dark' || (!('novaTheme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light',
            theme: this.currentTheme || 'light',

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

            console.log('getMediaPreference', this.currentTheme)


            this.configs.theme = this.currentTheme

            // loadCss(this.currentTheme);
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
        this.setInitialValue()

        loadCss(this.currentTheme);
    }
}

function loadCss(themeRequired) {
    if (themeRequired === 'dark') {
        require("flatpickr/dist/themes/dark.css");

    } else {
        require("flatpickr/dist/themes/light.css");
    }
}

</script>
