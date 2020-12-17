require('./bootstrap');

window.$ = window.jQuery = require('jquery')
require('admin-lte')

$(document).ready(function () {
  $('.data-table').DataTable()
})

window.Vue = require('vue');

import FilmsList from './components/FilmsList'
import VModal from 'vue-js-modal'

Vue.component('films-list', FilmsList)
Vue.use(VModal)


let app = new Vue({
  el: '#app',
})