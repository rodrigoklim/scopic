import Vue from 'vue'
import vuex from 'vuex'
import apiClient from "src/services/api";

Vue.use(vuex)
Vue.prototype.$vuex = new vuex.Store({
    state: {
      isLogged: false,
      permissions: {},
      details:{},
      user: {
        auto_bids:{}
      },
      products:{}
    },
    mutations: {
      login (state, data) {
        state.isLogged = true
        state.permissions = data.permissions
        state.user = data.user
      },
      seeDetails(state,data){
        console.log(state)
        const v = state.user.auto_bids
        state.details = data
          
        v.forEach(element => {
          if(element.product_id === data.id && data.bids[0]){
            element.price = data.bids[0].bid
          }
        })
      },
      autobids(state,data){
        state.user.auto_bids = data
      },
      freshList(state, data){
        state.products = data
      },
    },
    actions:{
      freshList(context){
        const url = "api/products";
        apiClient.get(url).then((response) => {
          context.commit("freshList", response.data);
        })
      }
    }
  })