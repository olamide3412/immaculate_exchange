<script setup>
import Navbar from '@/Components/Navigations/Navbar.vue'
import WhatsAppButton from '@/Components/WhatsAppButton.vue'
import ThemeToggle from '@/Components/ThemeToggle.vue';
</script>
<template>
    <div class=" bg-secondary-100 text-black dark:bg-gray-900 dark:text-white">
        <Navbar />
        <main class="pt-16" v-if="!$page.props.auth.user"> <!-- Padding to offset fixed navbar -->
            <slot />
            <WhatsAppButton />
        </main>
        <!--for class p-4 lg:ml-64 mt-16 -->
        <main v-else class=" p-4 mt-16">
            <slot />
        </main>
    </div>
</template>
