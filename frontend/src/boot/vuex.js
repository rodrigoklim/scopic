import Vue from 'vue'
import vuex from 'vuex'

Vue.use(vuex)
Vue.prototype.$vuex = new vuex.Store({
    state: {
      isLogged: false,
      permissions: {},
      details:{},
      user: {
        auto_bids:{}
      }
    },
    mutations: {
      login (state, data) {
        state.isLogged = true
        state.permissions = data.permissions
        state.user = data.user
      },
      seeDetails(state,data){
        const v = state.user.auto_bids
        state.details = data
        v.forEach(element => {
          if(element.product_id === data.id && data.bids[0]){
            element.price = data.bids[0].bid
          }
        });

      },
      autobids(state,data){
        console.log('ok')
        state.user.auto_bids = data
      }
    }
  })