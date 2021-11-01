import Vue from 'vue'
import vuex from 'vuex'

Vue.use(vuex)
Vue.prototype.$vuex = new vuex.Store({
    state: {
      isLogged: false,
      permissions: {},
      name: ''
    },
    mutations: {
      login (state, data) {
        state.isLogged = true
        state.permissions = data.permissions
        state.name = data.user.name
      }
    }
  })