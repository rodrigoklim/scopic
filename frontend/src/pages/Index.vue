<template>
  <q-page>
    <div class="row q-my-lg justify-center">
      <div class="col-10">
        <div
          class="q-mx-md text-h2 handlee text-white"
          style="color: #f1f0ea; text-shadow: 1px 2px grey"
        >
          Happening Now!
        </div>
      </div>
    </div>
    <div class="row justify-center flex">
      <div class="q-ma-md" v-for="(item, index) in products" :key="index">
        <q-card
          class="my-card fit"
          @click="details(item)"
          style="width: 350px !important; cursor: pointer"
        >
          <q-img :src="item.image_path1" />

          <q-card-section>
            <q-btn
              color="positive"
              :icon="matAttachMoney"
              :label="item.bids[0] ? item.bids[0].bid : item.auction_price"
              class="absolute"
              style="top: 0; right: 12px; transform: translateY(-50%)"
            />
            <div class="row no-wrap items-center">
              <div class="col text-h6 zen-bold">
                {{ item.product }}
              </div>
              <div
                class="
                  col-auto
                  text-grey text-caption
                  q-pt-md
                  row
                  no-wrap
                  items-center
                "
              >
                <q-icon :name="matGavel" class="q-mr-sm" />
                {{ item.bids.length }}
              </div>
            </div>
          </q-card-section>

          <q-card-section class="q-pt-none">
            <div class="text-subtitle1 zen-regular">
              {{ item.style }}
            </div>
            <div class="text-caption text-grey ellipsis-3-lines">
              {{ item.description }}
            </div>
          </q-card-section>

          <q-separator />

          <q-card-actions>
            <div class="col-2">
              <q-btn flat round :icon="matEvent" />
            </div>
            <div class="col-10 text-caption">
              <div class="row">
                Start: {{ item.start | moment("calendar") }}
              </div>
              <div class="row">End: {{ item.end | moment("calendar") }}</div>
            </div>
          </q-card-actions>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import {
  matGavel,
  matEvent,
  matAttachMoney,
} from "@quasar/extras/material-icons";
import apiClient from "src/services/api";

export default {
  name: "PageIndex",
  data() {
    return {};
  },
  created() {
    this.matGavel = matGavel;
    this.matEvent = matEvent;
    this.matAttachMoney = matAttachMoney;
  },
  methods: {
    details(item) {
      this.$router.push("/product-details");
      this.$vuex.commit("seeDetails", item);
    },
  },
  computed: {
    products() {
      return this.$vuex.state.products ? this.$vuex.state.products : {};
    },
  },
};
</script>
