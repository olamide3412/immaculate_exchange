<script setup>
import { Link } from '@inertiajs/vue3';
import HeroImage from '../../../images/logo.png';
import ImmaculateWorker from '../../../images/immaculate-worker.png'
import LogoFull from '../../../images/logo-full.png'
import { usePage } from '@inertiajs/vue3';
import { generateWhatappLink } from '../../Utils/whatsappLinkGen';
import { computed } from 'vue';


const support = usePage().props.support;

const tradeNowLink = computed(() => {
    return support.telegram_bot;
    //return generateWhatappLink(support.phone_whatsapp, 'Hi, I want to trade, what are your current rates?');
})
</script>

<template>
    <!-- ✅ Mobile View -->
    <section class="block md:hidden px-4 py-6">
        <!-- Image First -->
        <div
            data-aos="zoom-out"
            data-aos-delay="500"
            data-aos-duration="1000"
            class="mb-6">
            <img :src="ImmaculateWorker" alt="Hero" class="w-full custom-bounce">
        </div>
        <!-- Text Below -->
        <div
            data-aos="fade-up"
            data-aos-duration="1000"
            data-aos-delay="0"
            class="space-y-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 text-center">
                ARE YOU READY TO TRADE AT THE MOST SWEETEST RATE POSSIBLE?
            </h1>
            <p class="text-base text-gray-600 dark:text-gray-300 text-center">
                Look no further! At Immaculate Exchange, we give the best rate ever.
            </p>
            <div class="flex flex-col space-y-3 px-5 text-center">
                <a
                    :href="tradeNowLink"
                    target="_blank"
                    class="bg-primary text-white px-6 py-3  rounded-full shadow hover:bg-primary-dark transition">
                    Trade Now
                 </a>
                <Link
                    :href="route('rate')" class="border border-primary text-primary px-6 py-3 rounded-full hover:bg-primary hover:text-white transition dark:bg-gray-300">
                    Our Rate
                </Link>
            </div>
        </div>
    </section>

     <!-- ✅ Desktop View -->
  <section class="hidden md:flex min-h-screen items-center justify-between px-16 py-0">
    <!-- Text Left -->
    <div
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="0"
        class="w-1/2 space-y-6 other-element">
      <h1 class="text-5xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
        ARE YOU READY TO TRADE AT THE MOST SWEETEST RATE POSSIBLE?
      </h1>
      <p class="text-lg text-gray-600 dark:text-gray-300">
        Look no further! At Immaculate Exchange, we give the best rate ever.
      </p>
      <div class="flex space-x-4">
         <a
            data-aos="fade-up"
            data-aos-delay="500"
            data-aos-duration="500"
            :href="tradeNowLink"
            target="_blank"
            class="bg-primary text-white px-6 py-3 rounded-lg shadow hover:bg-primary-dark transition">
            Trade Now
         </a>
        <Link
            data-aos="fade-up"
            data-aos-delay="500"
            data-aos-duration="500"
            :href="route('rate')" class="border border-primary text-primary px-6 py-3 rounded-lg hover:bg-primary hover:text-white transition dark:bg-gray-300">
           Our Rate
        </Link>
      </div>
    </div>
     <!-- Image Right -->
    <div
        data-aos="zoom-out"
        data-aos-delay="500"
        data-aos-duration="1000"
        data-aos-anchor=".other-element"
        class="w-1/2 flex justify-center">
      <img :src="ImmaculateWorker" alt="Hero" class="w-full max-w-md custom-bounce">
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
