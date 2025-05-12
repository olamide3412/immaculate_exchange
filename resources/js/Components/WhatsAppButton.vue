<script setup>

import { usePage } from '@inertiajs/vue3';
import { generateWhatappLink } from '../Utils/whatsappLinkGen';
import { computed } from 'vue';

const support = usePage().props.support;

const tradeNowLink = computed(() => {
    return generateWhatappLink(support.phone_whatsapp, 'Hi, I want to trade, what are your current rates?');
})
</script>

<template>
    <a
      :href="tradeNowLink"
      target="_blank"
      rel="noopener noreferrer"
      class="fixed right-6 bottom-6 z-50 flex items-center justify-center space-x-2 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105 group"
      data-aos="fade-up"
      data-aos-delay="300"
      aria-label="Chat on WhatsApp"
    >
      <!-- WhatsApp Icon -->
      <font-awesome-icon :icon="['fab', 'whatsapp']" class="text-2xl" />
      <!-- Text (Show on hover) -->
      <span class="opacity-0 w-0 overflow-hidden group-hover:opacity-100 group-hover:w-auto transition-all duration-300 whitespace-nowrap">
        Chat with Us
      </span>
    </a>
  </template>
