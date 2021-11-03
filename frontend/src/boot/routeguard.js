import apiClient from "src/services/api"

export default ({ router, store, Vue }) => {
  router.beforeEach((to, from, next) => {
    let store = Vue.prototype.$vuex
    if (store.state.isLogged !== true && to.fullPath !== '/login') {
      isLogged()
    } else {
      next()
    }

    function isLogged() {
      const url = 'api/isLogged'
      apiClient.get(url).then(response => {
        if(response.data !== false){
          store.commit('login', response.data)
           next({ path: '/' })
        } else {
          next({ path: '/login' })
        }
      })
    }
  })
}