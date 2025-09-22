<script setup>
// No logic needed here — just presentation
</script>
<template>
    <section class="py-12 md:py-20 bg-white">
      <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-10">
        <!-- Left Column: Image -->
        <div
          class="md:w-1/2"
          data-aos="fade-right"
          data-aos-duration="800"
          data-aos-delay="200"
        >
          <img
            src="https://whykay.net/wp-content/uploads/2024/07/Crypto.png"
            alt="Crypto Trading"
            width="1024"
            height="879"
            class="w-full h-auto rounded-lg shadow-md"
            :srcset="`
              https://whykay.net/wp-content/uploads/2024/07/Crypto.png 1024w,
              https://whykay.net/wp-content/uploads/2024/07/Crypto-300x258.png 300w,
              https://whykay.net/wp-content/uploads/2024/07/Crypto-768x659.png 768w
            `"
            sizes="(max-width: 1024px) 100vw, 1024px"
          />
        </div>

        <!-- Right Column: Content -->
        <div
          class="md:w-1/2"
          data-aos="fade-left"
          data-aos-duration="800"
          data-aos-delay="200"
        >
          <h5 class="text-primary font-semibold text-sm uppercase mb-2">
            Welcome toImmaculate Exchange
          </h5>

          <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6 leading-tight">
            Most Trusted Digital Asset Dealer to Trade your Crypto
          </h2>

          <div class="space-y-4 text-gray-600 mb-8">
            <p>
              At Immaculate Exchange, we are committed to offering the fastest, most trusted, and most reliable cryptocurrency transactions.
            </p>
            <p>
              We are the most reliable, fastest, and trusted cryptocurrency exchanger. We exchange Bitcoin, USDT, Ethereum, and other cryptocurrencies.
            </p>
            <p class="font-bold">No delay !!!</p>
          </div>

          <!-- CTA Button -->
          <a
            href="https://wa.me/2347018607772?text=I%20want%20to%20trade%2C%20what%20are%20your%20current%20rates%3F"
            target="_blank"
            class="inline-block bg-primary hover:bg-primary-dark text-white py-3 px-6 rounded transition-transform duration-300 transform hover:scale-105"
          >
            Start Trading Now
          </a>
        </div>
      </div>
    </section>
  </template>

