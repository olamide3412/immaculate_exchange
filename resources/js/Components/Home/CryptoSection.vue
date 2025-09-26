<script setup>
import Crypto from '../../../images/Crypto.png';
import { usePage } from '@inertiajs/vue3';
import { generateWhatappLink } from '../../Utils/whatsappLinkGen';
import { computed } from 'vue';

const support = usePage().props.support;

const tradeNowLink = computed(() => {
    return support.telegram_bot;
    //return generateWhatappLink(support.phone_whatsapp, 'I want to trade, what are your current rates?');
})
</script>
<template>
    <section class=" py-12">
      <div class="container mx-auto flex flex-col md:flex-row items-center px-4">

        <!-- Image -->
        <div class="w-full md:w-1/2 mb-8 md:mb-0" data-aos="fade-right">
          <img
            :src="Crypto"
            alt="Crypto"
            class="w-full h-auto rounded-lg shadow-md"
          />
        </div>

        <!-- Text Content -->
        <div class="w-full md:w-1/2 md:pl-12" data-aos="fade-left">
          <h5 class="text-gray-500 dark:text-gray-300 text-sm uppercase mb-2">Best Cryptocurrency & Gift Card Agency</h5>
          <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Smart and Secure Platform to Trade your Crypto & Gift Card
          </h2>
          <p class="text-gray-700 dark:text-gray-200 mb-4">
            At Immaculate Exchange, we are committed to offering the fastest, most trusted, and most reliable cryptocurrency transactions.
          </p>
          <p class="text-gray-700 dark:text-gray-200 mb-4">
            We deal in Bitcoin, USDT, Ethereum, other cryptocurrencies and Gift card exchange.
          </p>
          <p class="text-red-600 font-semibold mb-6">No delay !!!</p>

          <a
            :href="tradeNowLink"
            class="inline-block bg-primary text-white font-semibold px-6 py-3 rounded-full shadow hover:bg-secondary-700 transition-all duration-300"
          >
            Start Trading Now
          </a>
        </div>
      </div>
    </section>
  </template>


