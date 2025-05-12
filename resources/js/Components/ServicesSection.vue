<script setup>
import { usePage } from '@inertiajs/vue3';
import { generateWhatappLink } from '../Utils/whatsappLinkGen';
import { computed } from 'vue';

const support = usePage().props.support;

const tradeNowLink = computed(() => {
    return generateWhatappLink(support.phone_whatsapp, 'Hi, I want to trade, what are your current rates?');
})
const whatsappLink = (message) => generateWhatappLink(support.phone_whatsapp, message);

const services = [
  {
    icon: {
        type: 'fab',
        name: 'bitcoin',
    },
    title: "Bitcoin",
    description: "The best platform to buy and sell bitcoin conveniently.",
    link: whatsappLink('I want to trade Bitcoin, what is your current rate?'),
  },
  {
    icon: {
        type: 'fab',
        name: 'ethereum',
    },
    title: "Ethereum",
    description: "Exchange Ethereum at competitive market rates.",
    link: whatsappLink('I want to trade Ethereum, what is your current rate?'),
  },
  {
    icon: {
        type: 'fas',
        name: 'usd',
    },
    title: "USDT",
    description: "Buy or sell USDT instantly with peace of mind.",
    link: whatsappLink('I want to trade USDT, what is your current rate?'),
  },
  {
    icon: {
        type: 'fas',
        name: 'coins',
    },
    title: "Other Cryptocurrency",
    description: "Exchange any cryptocurrency to cash in a click.",
    link: whatsappLink('I want to trade other cryptocurrency, what is your current rate for .....?'),
  },
];
</script>

<template>
    <section class="py-16 bg-primary" data-aos="fade-up">
      <div class="max-w-4xl mx-auto text-center px-4 md:px-1">
        <h5 class="text-lg font-medium text-white" data-aos="fade-left">Our Services</h5>
        <h2 class="text-3xl font-bold text-gray-100 mt-2" data-aos="fade-right" data-aos-delay="100">
          What Service We Offer
        </h2>
        <p class="mt-4 text-gray-50" data-aos="fade-up" data-aos-delay="200">
          We deal in Bitcoin, USDT, Ethereum, and other cryptocurrencies exchange.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-10" data-aos="fade-up" data-aos-delay="300">
          <div
            v-for="(service, index) in services"
            :key="index"
            class="bg-gray-100 dark:bg-gray-900 p-6 rounded-lg shadow"
            data-aos="zoom-in"
            :data-aos-delay="300 + index * 100"
          >
            <div class="text-4xl text-primary mb-4">
              <font-awesome-icon :icon="[service.icon.type, service.icon.name]" />
            </div>
            <h3 class="text-xl font-semibold mb-2">{{ service.title }}</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ service.description }}</p>
            <a
              :href="service.link"
              target="_blank"
              class="inline-block bg-primary text-white px-4 py-2 rounded hover:bg-secondary-700 transition"
            >
              Trade Now
            </a>
          </div>
        </div>
      </div>
    </section>
  </template>


