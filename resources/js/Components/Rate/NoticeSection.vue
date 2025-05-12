<script setup>

import { usePage } from '@inertiajs/vue3';
import { generateWhatappLink } from '../../Utils/whatsappLinkGen';
import { computed } from 'vue';

const support = usePage().props.support;

const tradeNowLink = computed(() => {
    return generateWhatappLink(support.phone_whatsapp, 'I want to trade, what are your current rates?');
})
</script>
<template>
    <!-- Section for Rate -->
    <section
      class="bg-gradient-to-r from-secondary-500 to-secondary-700 text-white py-16"
      data-aos="fade-up"
      data-aos-duration="800"
    >
      <div class="container mx-auto px-4 text-center">
        <!-- Notice -->
        <p class="text-lg md:text-xl mb-6">
          Kindly note that we do not accept any Crypto payment of amount below $50
        </p>

        <!-- Question Heading -->
        <h3 class="text-2xl md:text-3xl font-bold mb-4">Do you have any Question?</h3>

        <!-- Contact Info -->
        <p class="text-base md:text-lg space-y-2">
          <br>
          <span>Email: <a :href="'mailto:'+$page.props.support.email" class="underline hover:text-gray-200">{{ $page.props.support.email }}</a></span><br>
          <span>Phone: <a :href="'tel:'+$page.props.support.phone" class="underline hover:text-gray-200">{{ $page.props.support.phone_formatted }}</a></span>
        </p>
      </div>
    </section>
    <!-- Section for Trading Now -->
    <section
      class="bg-white py-20"
      data-aos="fade-up"
      data-aos-duration="800"
    >
      <div class="container mx-auto px-4 text-center">
        <!-- Title -->
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
          Buy & Sell Bitcoin and other Cryptocurrency at the Best Rate
        </h2>

        <!-- Description -->
        <p class="text-gray-600 max-w-xl mx-auto mb-6">
          Get the best rates, experience seamless transactions, competitive pricing, and make the most of your digital investments with Whykay Digitals.
        </p>

        <!-- CTA Button -->
        <div>
          <a
            :href="tradeNowLink"
            target="_blank"
            class="inline-block bg-primary hover:bg-primary-dark text-white py-2 px-6 rounded-3xl transition-transform duration-300 transform hover:scale-105"
          >
            Start Trading Now
          </a>
        </div>
      </div>
    </section>
  </template>


