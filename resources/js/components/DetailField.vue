<template>
  <panel-item :field="field">
    <template slot="value">
      <option-nova-icon-select :field="field" />
    </template>
  </panel-item>
</template>

<script>
export default {
  props: ['resource', 'resourceName', 'resourceId', 'field']
}
</script>
