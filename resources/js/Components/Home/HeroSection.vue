<script setup>
import { Link } from '@inertiajs/vue3';
import HeroImage from '../../../images/logo.png';
import ImmaculateWorker from '../../../images/immaculate-worker.png'
import { usePage } from '@inertiajs/vue3';
import { generateWhatappLink } from '../../Utils/whatsappLinkGen';
import { computed } from 'vue';


const support = usePage().props.support;

const tradeNowLink = computed(() => {
    return generateWhatappLink(support.phone_whatsapp, 'Hi, I want to trade, what are your current rates?');
})
</script>

<template>
    <section class="min-h-screen flex flex-col-reverse md:flex-row items-center justify-between px-4 md:px-16 py-5">

      <!-- Text Content -->
      <div
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="0"
        class="md:w-1/2 space-y-6 "
      >
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
          ARE YOU READY TO TRADE AT THE MOST SWEETEST RATE POSSIBLE?
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-300">
          Look no further! At Immaculate Exchange, we give the best rate ever.
        </p>
        <div class="flex space-x-4">
            <Link
                data-aos="fade-in"
                data-aos-delay="500"
                data-aos-duration="500"
                :href="tradeNowLink"
                class="bg-primary text-white px-6 py-3 rounded-lg shadow hover:bg-primary-dark transition">
                Trade Now
            </Link>
            <Link
                data-aos="fade-in"
                data-aos-delay="500"
                data-aos-duration="500"
                :href="route('about')"
                class="border border-primary text-primary px-6 py-3 rounded-lg hover:bg-primary hover:text-white transition dark:bg-gray-300">
                About Us
            </Link>
        </div>
      </div>

      <!-- Animated Image -->
      <div
        data-aos="fade-in"
        data-aos-delay="1000"
        data-aos-duration="1000"
        data-aos-anchor=".other-element"
        class="md:w-1/2 flex justify-center mb-10 md:mb-0"
      >
        <img :src="ImmaculateWorker" alt="Hero" class="full md:max-w-md lg:max-w-lg custom-bounce object-contain">
      </div>

    </section>
  </template>


<style scoped>
@keyframes small-bounce {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-5px);
  }
}

.custom-bounce {
  animation: small-bounce 1s infinite;
}
</style>
