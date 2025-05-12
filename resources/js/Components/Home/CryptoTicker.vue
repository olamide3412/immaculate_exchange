<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const coins = ref([])
const animationDuration = ref(30)

const fetchCoins = async () => {
  try {
    const response = await axios.get(
      'https://api.coingecko.com/api/v3/coins/markets',
      {
        params: {
          vs_currency: 'usd',
          order: 'market_cap_desc',
          per_page: 10,
          page: 1,
          sparkline: false,
        },
      }
    )
    coins.value = response.data
  } catch (error) {
    console.error('Error fetching coin data:', error)
  }
}

onMounted(() => {
  fetchCoins()
})
</script>


<template>
    <div class="crypto-ticker">
      <div class="ticker-track" :style="{ animationDuration: animationDuration + 's' }">
        <div class="ticker-item" v-for="coin in coins" :key="coin.id">
          <img :src="coin.image" :alt="coin.name" width="24" height="24" />
          <span class="coin-name text-nowrap">{{ coin.name }} ({{ coin.symbol.toUpperCase() }})</span>
          <span class="coin-price">${{ coin.current_price.toLocaleString() }}</span>
          <span :class="['coin-change', coin.price_change_percentage_24h >= 0 ? 'up' : 'down']">
            {{ coin.price_change_percentage_24h.toFixed(2) }}%
          </span>
        </div>
      </div>
    </div>
  </template>


  <style scoped>
  .crypto-ticker {
    overflow: hidden;
    background-color: var(--bg-color);
    border-top: 1px solid var(--bg-color);
    border-bottom: 1px solid var(--bg-color);
    padding: 10px 0;
  }

  .ticker-track {
    display: flex;
    animation: scroll-left linear infinite;
  }

  .ticker-item {
    display: flex;
    align-items: center;
    margin-right: 40px;
  }

  .coin-name {
    margin: 0 8px;
    font-weight: bold;
  }

  .coin-price {
    margin-right: 8px;
  }

  .coin-change.up {
    color: green;
  }

  .coin-change.down {
    color: red;
  }

  @keyframes scroll-left {
    0% {
      transform: translateX(100%);
    }
    100% {
      transform: translateX(-100%);
    }
  }

  </style>
