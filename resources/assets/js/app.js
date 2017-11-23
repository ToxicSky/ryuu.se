
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./prototypes');

window.Vue = require('vue');
window.queryString = require('query-string');
window.VueRouteLaravel = require('vue-route-laravel');
window.moment = require('moment');

var config = {
    baseroute: '/api/route/',
    axios: axios,
    queryString: queryString,
    csrf_token: document.head.querySelector("[name=csrf-token]").content
};

Vue.use(VueRouteLaravel, config);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

let comments = Vue.component('comments', require('./components/Comments.vue'));
Vue.component('posts', require('./components/Posts.vue'), {
  components: {
    'comments': comments
  }
});

Vue.component('post', require('./components/Post.vue'), {
  components: {
    'comments': comments
  }
});

Vue.component('sidebar', require('./components/Sidebar.vue'));

const app = new Vue({
    el: '#app'
});
