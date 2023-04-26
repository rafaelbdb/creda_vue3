import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import "bootstrap"
import "bootstrap/dist/css/bootstrap.min.css"
import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index.js'

library.add(fas)

createApp(App).component('font-awesome-icon', FontAwesomeIcon).use(router).mount('#app')