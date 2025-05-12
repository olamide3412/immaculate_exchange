<script setup>

</script>

<template>
    <section class=" py-20">
      <div class="container mx-auto px-4">
        <div data-aos="fade-up">
          <h2 class="text-4xl font-bold text-center mb-4">Welcome to Immaculate Exchange</h2>
        </div>
        <div data-aos="fade-up" data-aos-delay="100">
          <h3 class="text-2xl text-center mb-6">Most Trusted Digital Asset Dealer</h3>
        </div>
        <div data-aos="fade-up" data-aos-delay="200" class="text-center mb-12 max-w-2xl mx-auto">
          <p>We are the most reliable, fastest, and trusted cryptocurrency exchanger. We exchange Bitcoin, USDT, Ethereum, etc.</p>
        </div>

        <!-- Three Feature Boxes -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
          <div class="text-center bg-white shadow-lg rounded-xl p-6" data-aos="fade-up" data-aos-delay="300">
            <div class="mb-4 text-5xl text-primary">
              <font-awesome-icon :icon="['fas','clock']" />
            </div>
            <h3 class="text-xl font-semibold mb-2 text-primary">Fastest</h3>
            <p class=" text-white dark:text-black">We are dedicated to giving swift responses to your requests to enhance customer satisfaction.</p>
          </div>

          <div class="text-center bg-primary text-white shadow-lg rounded-xl p-6" data-aos="fade-up" data-aos-delay="400">
            <div class="mb-4 text-5xl ">
              <font-awesome-icon :icon="['fas','shield-alt']"  />
            </div>
            <h3 class="text-xl font-semibold mb-2">Trusted</h3>
            <p>We provide a trusted service that ensures safety and therefore facilitates continued relationships.</p>
          </div>

          <div class="text-center bg-white shadow-lg rounded-xl p-6" data-aos="fade-up" data-aos-delay="500">
            <div class="mb-4 text-5xl text-primary">
              <font-awesome-icon :icon="['fas','fa-thumbs-up']" />
            </div>
            <h3 class="text-xl font-semibold mb-2 text-primary">Reliable</h3>
            <p class="text-white dark:text-black">Your satisfaction is our priority. We ensure that every transaction is smooth and secure.</p>
          </div>
        </div>
      </div>
    </section>
  </template>



  <style scoped>
  .container {
    max-width: 1200px;
  }
  </style>
