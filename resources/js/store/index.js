import Vue from "vue";
import Vuex from 'Vuex';
import userPosts from './modules/posts';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    userPosts
  }
})