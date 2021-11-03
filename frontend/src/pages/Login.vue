<template>
  <div class="Login">
    <div class="row items-center" style="height: 93vh">
      <div class="col">
        <div class="row justify-center items-center" style="height: 100vh">
            <div class="col">
              <div class="row justify-center">
                <q-img src="~/assets/logo-auction.svg" width="550px" />
              </div>
              <div class="row justify-center q-mt-md">
                <div class="text-h2 handlee text-primary">Mr. Klim's Auction</div>
              </div>
            </div>

        </div>
      </div>
      <div class="col bg-secondary">
        <div class="row q-ml-md items-center" style="height: 100vh">
          <q-card style="width: 400px">
            <q-card-section  style="background-color:#D0CFCF">
              <div class="row text-h4 zen-regular items-center">
                <q-icon name="locker" class="q-ml-lg" style="color:#7A7D7D"/>
                login
              </div>
            </q-card-section>
            <q-separator />
            <q-card-section>
              <div class="row">
              <q-input label="Usuário" placeholder="seuemail@email.com" v-model="email" required style="width: 100%"/>
              </div>
              <div class="row">
                <q-input label="Senha" type="password" required v-model="password" style="width: 100%"/>
              </div>
            </q-card-section>
            <q-card-actions align="center">
              <q-btn label="Entrar"
                icon-right="double_arrow"
                :loading="loading"
                push
                color="primary"
                style="width: 200px; color: white"
                @click="login"
                />
            </q-card-actions>
          </q-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import apiClient from 'src/services/api'

export default {
  name: 'Login',
  data () {
    return {
      loading: false,
      password: '',
      email: ''
    }
  },
  mounted(){
      this.loadData()
  },
  methods: {
    loadData(){
      const url = '/sanctum/csrf-cookie'
      apiClient.get(url, {
        withCredentials: true,
        headers: {
          Accept: 'application/json'
        }
      })
    },
    login () {
      this.loading = true
      const url = 'api/login'
      const params = {
        email: this.email,
        password: this.password
      }

      apiClient.post(url, params, {
        withCredentials: true
      }).then(response => {
        this.loading = false
        this.$vuex.commit('login', response.data)
        this.$router.push('/')
      }).catch(error => {
        this.loading = false
        console.log(error)
      })
    }

  }
}
</script>

<style>
</style>