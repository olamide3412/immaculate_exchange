<script setup>
import { ref } from 'vue'

const props = defineProps({
  question: String,
  answer: String
})

const isOpen = ref(false)
</script>

<template>
    <div class="border border-gray-200 rounded-lg overflow-hidden">
      <button
        @click="isOpen = !isOpen"
        class="w-full flex justify-between items-center px-5 py-4 text-left font-medium text-gray-800 bg-gray-50 focus:outline-none"
        :aria-expanded="isOpen"
      >
        {{ question }}
        <span class="transition-transform duration-300" :class="{ 'rotate-180': isOpen }">
          ▼
        </span>
      </button>
      <div v-show="isOpen" class="px-5 py-4 bg-white text-gray-700">
        <p>{{ answer }}</p>
      </div>
    </div>
  </template>

