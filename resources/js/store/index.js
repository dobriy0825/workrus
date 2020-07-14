import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import user from './modules/user';
import worker from './modules/worker';
import menu from "./modules/menu";


export const store = new Vuex.Store({
    modules: {
        menu,
        worker,
        user
    },
});
