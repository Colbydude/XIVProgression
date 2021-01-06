
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import CharacterPane from './components/CharacterPane.vue';
import InstanceList from './components/InstanceList.vue';
import SearchForm from './components/SearchForm.vue';
import store from './store';
import Vue from 'vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#app',
    components: {
        CharacterPane, InstanceList, SearchForm,
    },
    store
});
