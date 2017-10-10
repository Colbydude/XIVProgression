
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import store from './store';


window.Vue = require('vue');
Vue.prototype.$time = moment;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('achievement-card', require('./components/achievement-card'));
Vue.component('achievements-list', require('./components/achievements-list'));
Vue.component('character-pane', require('./components/character-pane'));
Vue.component('job-list-item', require('./components/job-list-item'));
Vue.component('search-form', require('./components/search-form'));

const app = new Vue({
    el: '#app',
    store
});
