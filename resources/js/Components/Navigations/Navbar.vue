<script setup>
import { ref } from 'vue'
import Logo from '../../../images/logo.png'
import NavLink from '@/Components/Navigations/NavLink.vue'
import DesktopNavLinks from '@/Components/Navigations/Auth/DesktopNavLinks.vue'
import ThemeToggle from '@/Components/ThemeToggle.vue';

const isOpen = ref(false)
const toggle = () => isOpen.value = !isOpen.value
</script>


<template>
    <nav class="fixed top-0 left-0 w-full z-50 shadow bg-light text-black dark:bg-dark dark:text-white">
      <div class="container  flex items-center justify-between p-2">
        <div>
            <Link href="/" class=" flex items-center space-x-1">
                <img :src="Logo" width="50" height="35" alt="logo" >
                <div>
                    <h1 class=" text-primary dark:text-secondary-200 font-bold text-lg ">
                        Immaculate
                        <span class=" block text-xs text-gray-600 dark:text-gray-400">Exchange</span>
                    </h1>

                </div>
            </Link>
        </div>
        <!-- Desktop Links -->
        <ul class="hidden md:flex space-x-4">
          <NavLink :href="route('home')" :active="$page.component === 'Home'">Home</NavLink>
          <NavLink :href="route('about')" :active="$page.component === 'About'">About Us</NavLink>
          <NavLink :href="route('rate')" :active="$page.component === 'Rate'">Rate</NavLink>
          <NavLink :href="route('faq')" :active="$page.component === 'FAQ'">FAQ</NavLink>
          <DesktopNavLinks v-if="$page.props.auth.user"/>
        </ul>

        <!-- Hamburger -->
        <button @click="toggle" class="md:hidden focus:outline-none">
          <svg v-if="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3"
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3"
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      <!-- Mobile Menu -->
      <transition name="slide">
        <div v-if="isOpen" class="md:hidden shadow-md p-4">
          <ul class="space-y-4 text-center">
            <li><Link href="/" @click="toggle">Home</Link></li>
            <li><Link href="/about" @click="toggle">About</Link></li>
            <li><Link href="/contact" @click="toggle">Contact</Link></li>
          </ul>
        </div>
      </transition>
    </nav>
  </template>



  <style scoped>
  .slide-enter-active,
  .slide-leave-active {
    transition: all 0.3s ease;
  }
  .slide-enter-from,
  .slide-leave-to {
    transform: translateY(-10px);
    opacity: 0;
  }
  </style>
