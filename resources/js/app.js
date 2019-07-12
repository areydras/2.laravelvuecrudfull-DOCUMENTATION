require('./bootstrap');

window.Vue = require('vue');
window.Fire = new Vue;

// VUE ROUTER
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '*', component: require('./components/404.vue').default }, //jika tidak ada route yg ditemukan masuk ke halaman 404
]

const router = new VueRouter({
    mode: 'history',
    routes
})
// ======================================

// V-FORM
import { Form, HasError, AlertError } from 'vform'

window.Form = Form
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
// ======================================

// Sweet Alert
import Swal from 'sweetalert2'
window.Swal = Swal

let Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.Toast = Toast
// ======================================

// VUE-PAGINATION
Vue.component('pagination', require('laravel-vue-pagination'));
// ======================================

// VUE MOMENT
import moment from 'moment'
Vue.filter('myDate', (date) => { // Vue Filter adalah cara mengubah nilai data menggunaakan js kedalam file Vue dengan nama filter 'myDate'
                                 // Paramaeter date diambil dari nilai yg diberikan oleh file vue yg menggunakannya
    return moment(date).format("MMMM Do YYYY")
})
// ======================================

// Laravel Passport 
Vue.component('passport-clients',require('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients',require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-tokens',require('./components/passport/PersonalAccessTokens.vue').default);
// ======================================

// Gate - authorization
import Gate from "./Gate"
// Vue.prototype sama seperti fungsi window pada js, agar bisa diakses oleh seluruh file VUE, $gate merupakan nama variabel yg ingin digunakan
Vue.prototype.$gate = new Gate(window.user); //window.user ini sebuah variabel yg dibuat dari file master.blade.php yg isinya user login
// =======================================

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('page-404', require('./components/404.vue').default);

const app = new Vue({
    el: '#app',
    router,
    data() {
        return{
            search : '',
            user : window.user
        }
    },
    methods: {
        searchit: _.debounce(() => {   // membuat method searchit dengan debounce(() => {}, jeda waktu ) dalam itungan milisecond   `
            Fire.$emit('searching') // membuat function searching agar bisa digunakan dari berbagai file
        }, 500)
    }
});

