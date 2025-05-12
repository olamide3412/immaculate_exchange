// resources/js/stores/themeStore.js
import { defineStore } from 'pinia'

export const useThemeStore = defineStore('theme', {
  state: () => ({
    theme: 'system',
  }),
  actions: {
    setTheme(newTheme) {
      this.theme = newTheme
      localStorage.setItem('user-theme', newTheme)
      this.applyTheme()
    },
    applyTheme() {
      const root = document.documentElement
      const systemIsDark = window.matchMedia('(prefers-color-scheme: dark)').matches

      const themeToApply = this.theme === 'system' ? (systemIsDark ? 'dark' : 'light') : this.theme

      root.setAttribute('data-theme', themeToApply)
    },
    loadTheme() {
      const saved = localStorage.getItem('user-theme')
      if (saved) this.theme = saved
      this.applyTheme()
    },
  },
})
