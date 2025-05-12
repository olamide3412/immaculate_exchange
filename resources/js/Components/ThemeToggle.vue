<script setup>
import { ref, onMounted } from 'vue'
import { useThemeStore } from '@/Stores/themeStore'

const themeStore = useThemeStore()
const theme = ref('system')

onMounted(() => {
  theme.value = themeStore.theme
})

const setTheme = (newTheme) => {
  theme.value = newTheme
  themeStore.setTheme(newTheme)
}
</script>

<template>
    <div class="flex items-center space-x-0 justify-end" data-aos="fade-right">
      <button
        @click="setTheme('system')"
        class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"
        aria-label="Use system theme">
        <svg v-if="theme === 'system'" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="5"></circle>
          <line x1="12" y1="1" x2="12" y2="3"></line>
          <line x1="12" y1="21" x2="12" y2="23"></line>
          <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
          <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
          <line x1="1" y1="12" x2="3" y2="12"></line>
          <line x1="21" y1="12" x2="23" y2="12"></line>
          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
          <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
        </svg>
        <span v-else>🌐</span>
      </button>

      <button
        @click="setTheme('light')"
        class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"
        aria-label="Switch to light mode"
      >
        <svg v-if="theme === 'light'" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="5"></circle>
          <path d="M12 1v2"></path>
          <path d="M12 21v2"></path>
          <path d="M4.22 4.22l1.42 1.42"></path>
          <path d="M18.36 18.36l1.42 1.42"></path>
          <path d="M1 12h2"></path>
          <path d="M21 12h2"></path>
          <path d="M4.22 19.78l1.42-1.42"></path>
          <path d="M18.36 5.64l1.42-1.42"></path>
        </svg>
        <span v-else>☀️</span>
      </button>

      <button
        @click="setTheme('dark')"
        class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"
        aria-label="Switch to dark mode"
      >
        <svg v-if="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
        </svg>
        <span v-else>🌙</span>
      </button>
    </div>
  </template>

