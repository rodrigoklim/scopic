<template>
  <div class="ProductDetails">
    <div class="row q-mt-xl justify-center" style="height: 86vh">
      <div class="col-11">
        <div class="row justify-center" style="height: 100%">
          <div class="col-8">
            <q-card
              flat
              class="q-py-lg q-px-md"
              style="background-color: #f1f1f1"
            >
              <div class="row">
                <div class="col-7">
                  <div class="row q-mb-md">
                    <q-img :src="image" width="100%"></q-img>
                  </div>
                  <div class="row">
                    <q-img
                      class="q-mr-md"
                      :src="product.image_path1"
                      @mouseenter="image = product.image_path1"
                      width="75px"
                    ></q-img>
                    <q-img
                      class="q-mr-md"
                      :src="product.image_path2"
                      @mouseenter="image = product.image_path2"
                      width="75px"
                    ></q-img>
                    <q-img
                      :src="product.image_path3"
                      @mouseenter="image = product.image_path3"
                      width="75px"
                    ></q-img>
                  </div>
                </div>
                <div class="col-5">
                  <div class="row q-ml-md q-mt-md">
                    <div class="text-h3 zen-medium">
                      {{ product.product }}
                    </div>
                  </div>
                  <div class="row q-ml-md q-mt-md">
                    <div class="text-h6 zen-regular">
                      {{ product.style }}
                    </div>
                  </div>
                  <div class="row q-ml-md q-mt-lg zen-medium">
                    {{ product.description }}
                  </div>
                </div>
              </div>
            </q-card>
          </div>
          <div class="col-4">
            <div class="row">
              <q-card
                flat
                class="q-py-lg q-mx-md"
                style="background-color: #f1f1f1; width: 100%"
              >
                <q-card-section>
                  <div class="row items-center">
                    <div class="text-h4 q-ma-none zen-medium text-primary">
                      $
                      {{ lastPrice }}
                    </div>
                    <q-space />
                    <q-icon
                      v-if="bids[0] && bids[0].user_id === $vuex.state.user.id"
                      size="lg"
                      class="text-warning"
                      name="emoji_events"
                    />
                  </div>
                  <div class="row">
                    <div
                      class="text-caption zen-regular"
                      v-if="bids[0] && bids[0].user_id === $vuex.state.user.id"
                    >
                      The winner bid is yours.
                    </div>
                  </div>
                </q-card-section>
                <q-card-section>
                  <q-list bordered separator v-for="index in 3" :key="index">
                    <q-item clickable v-ripple v-if="bids[index]">
                      <q-item-section>
                        <q-item-label caption>
                          {{ bids[index].created_at | moment("from", "now") }}
                        </q-item-label>
                      </q-item-section>
                      <q-item-section side>
                        <q-item-label> $ {{ bids[index].bid }} </q-item-label>
                      </q-item-section>
                    </q-item>
                  </q-list>
                </q-card-section>
                <q-card-section>
                  <div class="row">
                    <q-checkbox
                      v-model="autobid"
                      @input="autobidCheckBox"
                      true-value="on"
                      false-value="off"
                      label="Set Autobid for this item."
                    />
                  </div>
                  <div class="row">
                    <div
                      class="text-negative zen-regular"
                      v-if="error"
                      style="font-size: 12px"
                    >
                      {{ error }}
                    </div>
                  </div>
                </q-card-section>
                <q-card-section>
                  <div class="row items-center">
                    <q-icon
                      class="q-ml-xs"
                      style="color: #6f6f6f"
                      size="md"
                      name="hourglass_bottom"
                    />
                    <span class="zen-medium q-mx-md">
                      ending {{ product.end | moment("from", "now") }}
                    </span>
                  </div>
                </q-card-section>
                <q-card-section class="text-center">
                  <q-btn
                    label="Bid Now!"
                    icon="gavel"
                    color="primary"
                    size="md"
                    :disable="disableBid"
                    :loading="loading"
                    style="max-width: 200px; width: 100%"
                    @click="submit('bid', true)"
                  />
                </q-card-section>
              </q-card>
            </div>
            <div class="row justify-center">
              <q-btn
                class="q-mt-lg"
                size="md"
                color="secondary"
                text-color="primary"
                to="/"
                label="Return to List"
                style="max-width: 200px; width: 100%"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import apiClient from "src/services/api";
import {
  matEmojiEvents,
  matHourglassBottom,
  matGavel,
} from "@quasar/extras/material-icons";
export default {
  name: "ProductDetails",
  data() {
    return {
      product: this.$vuex.state.details,
      image: this.$vuex.state.details.image_path1,
      autobid: "off",
      loading: false,
      loadingAutoBid: false,
      error: "",
      autoBidId: "",
    };
  },
  created() {
    const self = this;
    const autobids = this.$vuex.state.user.auto_bids;
    autobids.forEach((element) => {
      if (element.product_id === self.product.id) {
        self.autobid = "on";
        self.autoBidId = element.id;
      }
    });
  },
  methods: {
    autobidCheckBox() {
      this.$swal({
        title: "Are you sure?",
        text:
          "Do you really want to turn this item's Autobid " +
          this.autobid +
          "?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#8C6239",
        cancelButtonColor: "#CF4D6F",
        confirmButtonText: "Yes, turn it " + this.autobid + "!",
      }).then((result) => {
        if (result.isConfirmed && this.autobid === "on") {
          this.submit("autobid", this.autobid);
        } else {
          this.deleteAutoBid(this.autoBidId);
        }
      });
    },
    deleteAutoBid(id) {
      apiClient.delete("/api/autobid/" + id).then((response) => {
        this.$vuex.commit("autobids", response.data);
      });
    },
    submit(action, param) {
      let url = "";
      if (action === "autobid") {
        url = "api/autobid";
        this.loadingAutoBid = true;
      } else {
        url = "api/bid";
        this.loading = true;
      }

      const data = {
        product: this.product,
        user: this.$vuex.state.user.id,
        bid: this.lastPrice,
      };

      apiClient
        .post(url, data)
        .then((response) => {
          this.loading = false;
          if (action === "autobid") {
            if (response.data["error"]) {
              this.error = response.data["error"];
            } else {
              this.$vuex.commit("autobids", response.data);
            }
          } else {
            console.log(response.data);
            this.$vuex.commit("seeDetails", response.data);
          }
        })
        .catch((error) => {
          this.loading = false;
          if (error.response) {
            this.notify(
              "warning",
              "Something went wrong, please try again latter",
              "red-7"
            );
          }
        });
    },
    notify(icon, message, color) {
      this.$q.notify({
        message: message,
        icon: icon,
        color: color,
      });
    },
  },
  computed: {
    bids() {
      return this.$vuex.state.details.bids
        ? this.$vuex.state.details.bids
        : null;
    },
    lastPrice() {
      return this.bids[0] ? this.bids[0].bid : this.product.auction_price;
    },
    disableBid() {
      return this.bids[0] && this.bids[0].user_id === this.$vuex.state.user.id
        ? true
        : false;
    },
  },
};
</script>

<style></style>
