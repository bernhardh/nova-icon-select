<template>
  <div>
    <span v-if="item.icon" class="w-6 mr-2">
      <i :class="item.icon"></i>
    </span>
    <span v-html="item.label"></span>
  </div>
</template>

<script>
export default {
  props: {
    option: {},
    field: {}
  },
  computed: {
    item() {
      return this.option || this.field.options.find(option => {
        return option.value == this.field.value
      }) || {}
    }
  }
}
</script>
