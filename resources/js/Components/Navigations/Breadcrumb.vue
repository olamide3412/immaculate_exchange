<script setup>
defineProps({
  title: {
    type: String,
    default: 'Home',
  },
  name:{
    type: String,
    default: 'Home',
  }
});
</script>
<template>
    <section class="relative bg-gradient-to-r from-secondary-500 to-secondary-500 dark:from-dark dark:to-dark dark:bg-dark text-white py-20 px-4">
      <div class="absolute inset-0 bg-dark/50"></div>
      <div class="relative z-10 max-w-6xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ title }}</h1>
        <nav class="flex justify-center items-center space-x-2 text-sm md:text-base">
          <Link href="/" class="hover:underline">Home</Link>
          <svg class="w-3 h-3 text-gray-400" fill="currentColor" viewBox="0 0 320 512">
            <path
              d="M285.5 272.97L91.1 467.31c-9.37 9.37-24.57 9.37-33.94 0l-22.67-22.67c-9.36-9.36-9.38-24.52-.04-33.9L188.5 256 34.5 101.26c-9.34-9.38-9.32-24.54.04-33.9l22.67-22.67c9.37-9.37 24.57-9.37 33.94 0L285.5 239.03c9.37 9.37 9.37 24.57 0 33.94z"
            />
          </svg>
          <span class="text-gray-300">{{ name }}</span>
        </nav>
      </div>
    </section>
  </template>


