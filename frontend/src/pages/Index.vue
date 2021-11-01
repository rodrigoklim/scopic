<template>
  <q-page class="flex flex-center">
    <div class="row q-my-lg">
      <div class="text-h3">
        Today's Auctions
      </div>
    </div>
    <div class="row justify-center flex">
      <div class="q-ma-md" v-for="item,index in products" :key="index">
        <q-card class="my-card fit" style="width: 350px !important">
          <q-img src="https://cdn.quasar.dev/img/chicken-salad.jpg" />

          <q-card-section>
            <q-btn
              color="positive"
              :icon="matAttachMoney"
              :label="item.auction_price"
              class="absolute"
              style="top: 0; right: 12px; transform: translateY(-50%);"
            />
            <div class="row no-wrap items-center">
              <div class="col text-h6 ellipsis">
                {{item.product}}
              </div>
              <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
                <q-icon :name="matGavel" class="q-mr-sm" />
                {{item.bids}}
              </div>
            </div>

            <q-rating v-model="item.stars" :max="5" size="32px" />
          </q-card-section>

          <q-card-section class="q-pt-none">
            <div class="text-subtitle1">
              {{item.style}}
            </div>
            <div class="text-caption text-grey">
              {{item.description}}
            </div>
          </q-card-section>

          <q-separator />

          <q-card-actions>
              <div class="col-2">
                <q-btn flat round :icon="matEvent" />
              </div>
              <div class="col-10 text-caption">
                <div class="row">
                  Start:  {{item.start | moment('calendar')}}
                </div>
                <div class="row">
                  End: {{item.end | moment('calendar')}}
                </div>
              </div>
          </q-card-actions>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import { matGavel, matEvent, matAttachMoney } from '@quasar/extras/material-icons'

export default {
  name: 'PageIndex',
  data(){
    return {
      products:[
        {
          product: 'Old Chair',
          style: 'Renaissance',
          description: 'Old chair from the king',
          auction_price: 19.45,
          stars: 3,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Old Sofa',
          style: 'XV Century',
          description: 'Old Sofa from the king',
          auction_price: 219.45,
          stars: 1,
          bids: 1,
          start: '2021-11-01 08:00:00',
          end: '2021-11-9 23:59:59'
        },
        {
          product: 'Beautiful Ring',
          style: 'Antique',
          description: 'Beautiful Ring from the Queen',
          auction_price: 6505.45,
          stars: 5,
          bids: 0,
          start: '2021-11-04 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Beautiful Necklace',
          description: 'Beautiful Necklace from the queen',
          auction_price: 1956.45,
          style: 'Ancient Roma',
          stars: 4,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        },
       {
          product: 'Old Chair',
          style: 'Renaissance',
          description: 'Old chair from the king',
          auction_price: 19.45,
          stars: 3,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Old Sofa',
          style: 'XV Century',
          description: 'Old Sofa from the king',
          auction_price: 219.45,
          stars: 1,
          bids: 1,
          start: '2021-11-01 08:00:00',
          end: '2021-11-9 23:59:59'
        },
        {
          product: 'Beautiful Ring',
          style: 'Antique',
          description: 'Beautiful Ring from the Queen',
          auction_price: 6505.45,
          stars: 5,
          bids: 0,
          start: '2021-11-04 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Beautiful Necklace',
          description: 'Beautiful Necklace from the queen',
          auction_price: 1956.45,
          style: 'Ancient Roma',
          stars: 4,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Old Chair',
          style: 'Renaissance',
          description: 'Old chair from the king',
          auction_price: 19.45,
          stars: 3,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Old Sofa',
          style: 'XV Century',
          description: 'Old Sofa from the king',
          auction_price: 219.45,
          stars: 1,
          bids: 1,
          start: '2021-11-01 08:00:00',
          end: '2021-11-9 23:59:59'
        },
        {
          product: 'Beautiful Ring',
          style: 'Antique',
          description: 'Beautiful Ring from the Queen',
          auction_price: 6505.45,
          stars: 5,
          bids: 0,
          start: '2021-11-04 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Beautiful Necklace',
          description: 'Beautiful Necklace from the queen',
          auction_price: 1956.45,
          style: 'Ancient Roma',
          stars: 4,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Old Chair',
          style: 'Renaissance',
          description: 'Old chair from the king',
          auction_price: 19.45,
          stars: 3,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Old Sofa',
          style: 'XV Century',
          description: 'Old Sofa from the king',
          auction_price: 219.45,
          stars: 1,
          bids: 1,
          start: '2021-11-01 08:00:00',
          end: '2021-11-9 23:59:59'
        },
        {
          product: 'Beautiful Ring',
          style: 'Antique',
          description: 'Beautiful Ring from the Queen',
          auction_price: 6505.45,
          stars: 5,
          bids: 0,
          start: '2021-11-04 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Beautiful Necklace',
          description: 'Beautiful Necklace from the queen',
          auction_price: 1956.45,
          style: 'Ancient Roma',
          stars: 4,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Old Chair',
          style: 'Renaissance',
          description: 'Old chair from the king',
          auction_price: 19.45,
          stars: 3,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Old Sofa',
          style: 'XV Century',
          description: 'Old Sofa from the king',
          auction_price: 219.45,
          stars: 1,
          bids: 1,
          start: '2021-11-01 08:00:00',
          end: '2021-11-9 23:59:59'
        },
        {
          product: 'Beautiful Ring',
          style: 'Antique',
          description: 'Beautiful Ring from the Queen',
          auction_price: 6505.45,
          stars: 5,
          bids: 0,
          start: '2021-11-04 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Beautiful Necklace',
          description: 'Beautiful Necklace from the queen',
          auction_price: 1956.45,
          style: 'Ancient Roma',
          stars: 4,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Old Chair',
          style: 'Renaissance',
          description: 'Old chair from the king',
          auction_price: 19.45,
          stars: 3,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Old Sofa',
          style: 'XV Century',
          description: 'Old Sofa from the king',
          auction_price: 219.45,
          stars: 1,
          bids: 1,
          start: '2021-11-01 08:00:00',
          end: '2021-11-9 23:59:59'
        },
        {
          product: 'Beautiful Ring',
          style: 'Antique',
          description: 'Beautiful Ring from the Queen',
          auction_price: 6505.45,
          stars: 5,
          bids: 0,
          start: '2021-11-04 08:00:00',
          end: '2021-11-10 23:59:59'
        },
        {
          product: 'Beautiful Necklace',
          description: 'Beautiful Necklace from the queen',
          auction_price: 1956.45,
          style: 'Ancient Roma',
          stars: 4,
          bids: 0,
          start: '2021-11-02 08:00:00',
          end: '2021-11-10 23:59:59'
        }

      ]
    }
  },
  created(){
    this.matGavel = matGavel
    this.matEvent = matEvent
    this.matAttachMoney = matAttachMoney
  }
}
</script>
