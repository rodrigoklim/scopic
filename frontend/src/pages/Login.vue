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
            <q-card-section style="background-color: #d0cfcf">
              <div class="row text-h4 zen-regular items-center">
                <q-icon name="locker" class="q-ml-lg" style="color: #7a7d7d" />
                login
              </div>
            </q-card-section>
            <q-separator />
            <q-card-section>
              <div class="row">
                <q-input
                  label="User"
                  placeholder="youremail@email.com"
                  v-model="email"
                  required
                  style="width: 100%"
                />
              </div>
              <div class="row">
                <q-input
                  label="Password"
                  type="password"
                  required
                  v-model="password"
                  style="width: 100%"
                />
              </div>
              <div class="row">
                <div
                  class="text-negative zen-regular"
                  v-if="error"
                  style="font-size: 13px"
                >
                  {{ error }}
                </div>
              </div>
            </q-card-section>
            <q-card-actions align="center">
              <q-btn
                label="Login"
                icon-right="double_arrow"
                :loading="loading"
                push
                color="primary"
                style="width: 200px; color: white"
                @click="beforeLogin"
              />
            </q-card-actions>
          </q-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import apiClient from "src/services/api";

export default {
  name: "Login",
  data() {
    return {
      loading: false,
      password: "",
      email: "",
      error: "",
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      const url = "/sanctum/csrf-cookie";
      apiClient.get(url, {
        withCredentials: true,
        headers: {
          Accept: "application/json",
        },
      });
    },
    beforeLogin() {
      if (!this.email || !this.password) {
        this.error = "Please insert valid data.";
      } else {
        this.login();
      }
    },
    login() {
      this.loading = true;
      const url = "api/login";
      const params = {
        email: this.email,
        password: this.password,
      };

      apiClient
        .post(url, params, {
          withCredentials: true,
        })
        .then((response) => {
          this.loading = false;
          this.$vuex.commit("login", response.data);
          this.$router.push("/");
        })
        .catch((error) => {
          this.loading = false;
          this.error = error.response.data.message;
        });
    },
  },
};
</script>

<style></style>
