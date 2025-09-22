<script setup>
import CryptoTrader from '../../images/Crypto-trader.png';

</script>
<template>
    <section class="py-12">
      <div class="container mx-auto flex flex-col md:flex-row items-center px-4">

        <!-- Text Column -->
        <div class="w-full md:w-1/2 mb-10 md:mb-0" data-aos="fade-right">
          <h5 class="text-sm uppercase text-gray-500 dark:text-gray-300 mb-2">Why Choose Us</h5>
          <h2 class="text-3xl md:text-4xl font-bold mb-4">
            We’ve Traded over $1m Worth of Crypto
          </h2>
          <p class="text-gray-700 dark:text-gray-200">
            With over $1 million in cryptocurrency trades successfully executed,
           Immaculate Exchange stands as a trusted trader in digital asset transactions.
          </p>
        </div>

        <!-- Image Column -->
        <div class="w-full md:w-1/2" data-aos="fade-left">
          <img
            :src="CryptoTrader"
            alt="Crypto Trader"
            class="w-full h-auto rounded-lg shadow-md"
          />
        </div>
      </div>
    </section>
  </template>


