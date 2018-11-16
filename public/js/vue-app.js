

import axios from 'axios';
import TaskDraggable from '../../resources/views/layouts/components/TaskDraggable.vue';
// import ShowModal from '../../resources/views/layouts/components/ShowModal.vue';

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': $('meta[name=csrfToken]').attr('content'),
    'X-Requested-With': 'XMLHttpRequest'
};



const app = new Vue({
      el: '#app',
      components: {
        TaskDraggable
        }

 });
