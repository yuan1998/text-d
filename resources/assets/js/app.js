
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// import Element from 'element-ui'
// import 'element-ui/lib/theme-chalk/index.css'

/*

import VueRouter from 'vue-router'
import store from './store/index.js'
import router from './routes/index.js'
import app from './components/App.vue'




Vue.component('App', app);


console.log(app);



*/
// Vue.use(Element)

// new Vue({
//     el: '#app',
//     data:{
//         'visible':false
//     }
// });
//
import _env from './config/env.js'

window._env = _env;

window.service = axios.create({
  baseURL: _env.apiUrl, // api的base_url
  timeout: 5000 // request timeout
})

service.interceptors.response.use(
  response => response,
  error => {
    console.log('err' + error)// for debug
    Message({
      message: error.message,
      type: 'error',
      duration: 5 * 1000
    })
    return Promise.reject(error)
})
