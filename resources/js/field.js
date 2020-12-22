Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-icon-select', require('./components/IndexField'))
  Vue.component('detail-nova-icon-select', require('./components/DetailField'))
  Vue.component('form-nova-icon-select', require('./components/FormField'))
  Vue.component('option-nova-icon-select', require('./components/ShowOption'))
})
