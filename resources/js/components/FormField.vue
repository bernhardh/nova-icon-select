<template>
  <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
      <!-- Search Input -->
      <search-input
          v-if="!isReadonly && isSearchable"
          @input="performSearch"
          @clear="clearSelection"
          @selected="selectOption"
          :error="hasError"
          :value="selectedOption"
          :data="filteredOptions"
          :clearable="field.nullable"
          trackBy="value"
          class="w-full"
      >
        <!-- The Selected Option Slot -->
        <div slot="default" v-if="selectedOption" class="flex items-center">
          <option-nova-icon-select :option="selectedOption"/>
        </div>

        <!-- Options List Slot -->
        <div
            slot="option"
            slot-scope="{ option, selected }"
            class="flex items-center text-sm font-semibold leading-5 text-90"
            :class="{ 'text-white': selected }"
        >
          <option-nova-icon-select :option="option"/>
        </div>
      </search-input>

      <!-- Select Input Field -->
      <select-control
          v-else
          :id="field.attribute"
          :dusk="field.attribute"
          @change="handleChange"
          :value="this.value"
          class="w-full form-control form-select"
          :class="errorClasses"
          :options="field.options"
          :disabled="isReadonly"
      >
        <option value="" selected :disabled="!field.nullable">
          {{ placeholder }}
        </option>
      </select-control>
    </template>
  </default-field>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova'

export default {
  mixins: [HandlesValidationErrors, FormField],

  data: () => ({
    selectedOption: null,
    search: '',
  }),

  created() {
    if (this.field.value && this.isSearchable) {
      this.selectedOption = _(this.field.options).find(
          v => v.value == this.field.value
      )
    }
  },

  methods: {
    /**
     * Provide a function that fills a passed FormData object with the
     * field's internal value attribute. Here we are forcing there to be a
     * value sent to the server instead of the default behavior of
     * `this.value || ''` to avoid loose-comparison issues if the keys
     * are truthy or falsey
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value)
    },

    /**
     * Set the search string to be used to filter the select field.
     */
    performSearch(event) {
      this.search = event
    },

    /**
     * Clear the current selection for the field.
     */
    clearSelection() {
      this.selectedOption = ''
      this.value = ''
    },

    /**
     * Select the given option.
     */
    selectOption(option) {
      this.selectedOption = option
      this.value = option.value
    },

    /**
     * Handle the selection change event.
     */
    handleChange(e) {
      this.value = e.target.value

      if (this.field) {
        Nova.$emit(this.field.attribute + '-change', this.value)
      }
    },

    /**
     * Search in an array of strings
     */
    searchStringInArray(str, strArray) {
      for (let j = 0; j < strArray.length; j++) {
        const mat = strArray[j].match(str)
        if (mat && mat.index == 0) {
          return true;
        }
      }
      return false;
    },
  },

  computed: {
    /**
     * Determine if the related resources is searchable
     */
    isSearchable() {
      return this.field.searchable
    },

    /**
     * Return the field options filtered by the search string.
     */
    filteredOptions() {
      const search = this.search.toLowerCase().trim()

      return search ? this.field.options.filter(option => {
        return (
            (option.search && Array.isArray(option.search) && this.searchStringInArray(search, option.search)) ||
            option.label.toLowerCase().indexOf(search) > -1
        )
      }) : this.field.options;
    },

    /**
     * Return the placeholder text for the field.
     */
    placeholder() {
      return this.field.placeholder || this.__('Choose an option')
    },
  },
}
</script>
