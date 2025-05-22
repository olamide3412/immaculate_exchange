<script setup>
import { ref, onMounted } from 'vue'
import HeroImage from '../../images/logo.png' // Replace with your image

const imageVisible = ref(false)
const textVisible = ref(false)
const heroRef = ref(null)

onMounted(() => {
  // Animate text immediately on load
  textVisible.value = true

  // Delay image animation by 1 second
  setTimeout(() => {
    imageVisible.value = true
  }, 1000)

  // Scroll-based trigger using IntersectionObserver
  const observer = new IntersectionObserver(([entry]) => {
    if (entry.isIntersecting) {
      textVisible.value = true
      imageVisible.value = true
    }
  }, {
    threshold: 0.1,
  })

  if (heroRef.value) {
    observer.observe(heroRef.value)
  }
})
</script>

<template>
    <section ref="heroRef" class="min-h-screen flex flex-col-reverse md:flex-row items-center justify-between px-4 md:px-16 py-10 bg-white">

      <!-- Text Content -->
      <div :class="['transition-all duration-1000 ease-out', textVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10']" class="md:w-1/2 space-y-6">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
          ARE YOU READY TO TRADE AT THE MOST SWEETEST RATE POSSIBLE?
        </h1>
        <p class="text-lg text-gray-600">
          Look no further! At Whykay Digitals, we give the best rate ever.
        </p>
        <div class="flex space-x-4">
          <Link href="/trade" class="bg-primary text-white px-6 py-3 rounded-lg shadow hover:bg-primary-dark transition">Trade Now</Link>
          <Link href="/about" class="border border-primary text-primary px-6 py-3 rounded-lg hover:bg-primary hover:text-white transition">About Us</Link>
        </div>
      </div>

      <!-- Animated Image -->
      <div :class="['transition-all duration-1000 delay-1000 ease-out', imageVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10']" class="md:w-1/2 flex justify-center mb-10 md:mb-0">
        <img :src="HeroImage" alt="Hero" class="max-w-sm w-full">
      </div>

    </section>

    <section class=" min-h-screen flex flex-col-reverse md:flex-row items-center justify-between px-4 md:px-16 py-5">

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
        <img :src="ImmaculateWorker" alt="Hero" class="max-w-sm w-full custom-bounce">
      </div>

    </section>
</template>


  <style scoped>
  /* Optional: Smooth animation with custom transitions */
  </style>
