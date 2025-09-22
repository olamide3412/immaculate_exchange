<script setup>
import Logo from '../../images/logo.png'
</script>

<template>
    <section class=" pb-16">
      <!-- Background overlay -->
      <div class="bg-black opacity-10"></div>

      <div class="container mx-auto px-4 py-12">
        <!-- Inner Section -->
        <div class="flex flex-col md:flex-row gap-8">
          <!-- Left Column: Logo + Description + Social Icons -->
          <div class="md:w-1/3" data-aos="fade-up" data-aos-delay="100">
            <!-- Logo -->
            <img :src="Logo" alt="Logo" class="h-12 mb-4" />

            <!-- Description -->
            <p class="mb-6 text-sm">
              Immaculate Exchange is a cryptocurrency exchange company that enables customers to convert their Bitcoin, USDT, Ethereum, and other Cryptocurrencies to cash at a good and competitive rate.
            </p>

            <!-- Social Icons -->
            <div class="flex space-x-4 text-xl">
              <a href="#" target="_blank" aria-label="Facebook" class="text-white rounded-full py-3 px-4 bg-secondary-500 hover:bg-secondary-700 ">
                <font-awesome-icon :icon="['fab', 'facebook']" />
              </a>
              <a href="https://www.instagram.com/immaculateexchangeng?igsh=eW1vYjhzdHAwaHd6" target="_blank" aria-label="Instagram" class="text-white rounded-full py-3 px-4 bg-secondary-500 hover:bg-secondary-700 ">
                <font-awesome-icon :icon="['fab', 'instagram']" />
              </a>
              <a href="#" target="_blank" aria-label="Twitter" class="text-white rounded-full py-3 px-4 bg-secondary-500 hover:bg-secondary-700 ">
                <font-awesome-icon :icon="['fab', 'x-twitter']" />
              </a>
            </div>
          </div>

          <!-- Middle Column: Quick Links -->
          <div class="md:w-1/3" data-aos="fade-up" data-aos-delay="200">
            <h4 class="font-bold text-lg mb-4">Quick Links</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="#" class="flex items-center hover:underline"><font-awesome-icon :icon="['fas', 'angle-right']" class="text-primary mr-2" />About Us</a></li>
              <li><a href="#" class="flex items-center hover:underline"><font-awesome-icon :icon="['fas', 'angle-right']" class="text-primary mr-2" />Sell</a></li>
              <li><a href="#" class="flex items-center hover:underline"><font-awesome-icon :icon="['fas', 'angle-right']" class="text-primary mr-2" />Rate</a></li>
              <li><a href="#" class="flex items-center hover:underline"><font-awesome-icon :icon="['fas', 'angle-right']" class="text-primary mr-2" />FAQ</a></li>
            </ul>
          </div>

          <!-- Right Column: Contact Info -->
          <div class="md:w-1/3" data-aos="fade-up" data-aos-delay="300">
            <h4 class="font-bold text-lg mb-4">Contact</h4>
            <ul class="space-y-2 text-sm">
              <li class="flex items-start">
                <font-awesome-icon :icon="['fas', 'map-marker-alt']" class="mt-1 mr-2 text-primary text-lg" />
                <span>{{$page.props.support.location}}</span>
              </li>
              <li class="flex items-center">
                <font-awesome-icon :icon="['fas', 'phone']" class="mr-2 text-primary text-lg" />
                <span>{{ $page.props.support.phone_formatted }}</span>
              </li>
              <li class="flex items-center">
                <font-awesome-icon :icon="['fas', 'envelope']" class="mr-2 text-primary text-lg" />
                <a :href="'mailto:'+$page.props.support.email">{{ $page.props.support.email }}</a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Divider -->
        <hr class="my-8 border-t border-gray-300" />

        <!-- Footer -->
        <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-600 dark:text-gray-200" >
          <div>
            Bold Immaculate Ventures © {{ new Date().getFullYear() }}. All Rights Reserved | Designed by
            <a href="https://www.linkedin.com/in/ola3412/" class="text-blue-600 dark:text-blue-400 hover:underline" target="_blank">SKYNET DIGITAL HUB</a>
          </div>
          <div class="flex space-x-6 mt-4 md:mt-0">
            <a href="#" class="hover:underline">Privacy Policy</a>
            <a href="#" class="hover:underline">Term Of Service</a>
          </div>
        </div>
      </div>
    </section>
  </template>

