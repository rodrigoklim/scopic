<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn round class="bg-white q-my-sm" size="md" flat to="/">
          <q-img src="~/assets/logo-auction.svg" width="30px" />
        </q-btn>
        <span class="handlee q-ml-md" style="font-size: 20px"
          >Mr. Klim Greets You!</span
        >
        <q-space />
        <q-tabs
          align="right"
          indicator-color="white"
          style="margin-top: 0.45em"
          no-caps
          class="zen-regular"
        >
          <q-icon
            name="warning"
            size="md"
            color="warning"
            v-if="parseFloat(wallet) <= parseFloat(alert)"
          />
          <q-btn
            flat
            :icon="matMenu"
            size="md"
            @click="drawerRight = !drawerRight"
          >
            <q-tooltip
              anchor="top middle"
              content-class=" bg-negative"
              :offset="[10, 30]"
            >
              AutoBid Menu
            </q-tooltip>
          </q-btn>
          <q-btn-dropdown
            auto-close
            stretch
            flat
            :label="user"
            no-caps
            style="width: 140px"
          >
            <q-list>
              <q-item clickable @click="logout">
                <q-item-section>
                  <q-icon name="exit_to_app" color="primary" size="sm" />
                </q-item-section>
                <q-item-section class="zen-regular text-primary">
                  Log-out
                </q-item-section>
              </q-item>
            </q-list>
          </q-btn-dropdown>
        </q-tabs>
      </q-toolbar>
    </q-header>
    <q-drawer
      side="right"
      v-model="drawerRight"
      show-if-above
      bordered
      :width="300"
      :breakpoint="500"
      class="bg-info"
    >
      <div class="row zen-medium q-mt-lg q-mx-md">
        <q-input
          label="Autobid"
          prefix="USD"
          mask="##.##"
          input-class="text-right"
          reverse-fill-mask
          disable
          v-model="wallet"
          style="width: 100%"
        ></q-input>
      </div>
      <div class="row q-mx-md q-mt-md">
        <div class="zen-medium" style="font-size: 20px">My Autobids</div>
      </div>
      <div class="row zen-medium q-mt-lg q-mx-md">
        <q-list
          bordered
          v-for="(autobid, index) in autobids"
          :key="index"
          style="width: 100%"
        >
          <q-item>
            <q-item-section avatar>
              <q-avatar rounded>
                <img :src="autobid.thumb" />
              </q-avatar>
            </q-item-section>

            <q-item-section class="zend-regular">
              <q-item-label>{{ autobid.product }}</q-item-label>
              <q-item-label caption>{{ autobid.price }}</q-item-label>
            </q-item-section>

            <q-item-section side top>
              <q-item-label style="cursor: pointer">
                <q-icon
                  size="xs"
                  color="primary"
                  @click="alertRemoveAutoBid(autobid, index)"
                  name="delete"
                >
                  <q-tooltip
                    anchor="top middle"
                    content-class=" bg-negative"
                    :offset="[10, 30]"
                  >
                    Remove AutoBid
                  </q-tooltip>
                </q-icon>
              </q-item-label>
            </q-item-section>
          </q-item>
        </q-list>
      </div>
    </q-drawer>
    <q-page-container class="bg-secondary">
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import apiClient from "src/services/api";
import { matMenu } from "@quasar/extras/material-icons";

export default {
  name: "MainLayout",
  data() {
    return {
      matMenu: matMenu,
      drawerRight: false,
      wallet: parseFloat(this.$vuex.state.user.wallet.amount).toFixed(2),
      alert: parseFloat(this.$vuex.state.user.wallet.alert).toFixed(2),
    };
  },
  mounted() {
    this.$nextTick(() => {
      this.drawerRight = false;
    });
  },
  methods: {
    logout() {
      const url = "api/logout";
      apiClient.post(url);
      this.$router.push("/login");
    },
    alertRemoveAutoBid(val, index) {
      this.$swal({
        title: "Are you sure?",
        text: "Do you really want to turn this item's Autobid off?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#8C6239",
        cancelButtonColor: "#CF4D6F",
        confirmButtonText: "Yes, turn it off!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.removeAutoBid(val, index);
        }
      });
    },
    removeAutoBid(val, index) {
      const url = "api/autobid/" + val.id;
      this.autobids.splice(index, 1);
      apiClient.delete(url).then((response) => {
        this.$vuex.commit("autobids", response.data);
      });
    },
  },
  computed: {
    autobids() {
      return this.$vuex.state.user.auto_bids;
    },
    user() {
      return this.$vuex.state.user.name;
    },
  },
  watch: {
    "$vuex.state.user.auto_bids": function (val) {
      console.log(val);
    },
  },
};
</script>
