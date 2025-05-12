<script setup>
import { ref } from 'vue'

const activeTab = ref('naira')

const nairaRates = [
  { amount: 'Above $1000', rate: 'NGN 1713/$' },
  { amount: '$100+ to $999', rate: 'NGN 1709/$' },
  { amount: 'Less than $100', rate: 'NGN 1700/$' }
]
</script>
<template>
    <section class="bg-white py-16" data-aos="fade-up" data-aos-duration="800">
      <div class="container mx-auto px-4">
        <!-- Section Title -->
        <div class="text-center mb-12">
          <h3 class="text-3xl font-bold text-gray-800">Exchange rate for all Cryptocurrencies</h3>
          <div class="w-20 h-1 bg-primary mx-auto my-4"></div>
          <p class="text-gray-600 max-w-lg mx-auto">
            The table below shows our competitive exchange rates.
          </p>
        </div>

        <!-- Tabs -->
        <div class="flex justify-center mb-8">
          <button
            @click="activeTab = 'naira'"
            :class="[
              'px-6 py-2 font-medium text-sm rounded-t-lg transition-all',
              activeTab === 'naira' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
            ]"
          >
            Naira
          </button>
        </div>

        <!-- Tab Content -->
        <div class="bg-gray-50 shadow-md rounded-lg overflow-hidden">
          <div v-show="activeTab === 'naira'" class="p-6">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Amount</th>
                  <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Rate</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr v-for="(rate, index) in nairaRates" :key="index">
                  <td class="px-6 py-4 text-sm text-gray-800">{{ rate.amount }}</td>
                  <td class="px-6 py-4 text-sm text-gray-800">{{ rate.rate }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </template>

