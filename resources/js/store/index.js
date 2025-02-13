import Vue from 'vue';
import Vuex from 'vuex';
import invoice from './invoice/invoice-module'; // Adjust the path if necessary

Vue.use(Vuex);
Vue.config.devtools = true;

const store = new Vuex.Store({
    modules: {
        invoice // Ensure 'modules' is used, not 'module'
    }
});

export default store;
