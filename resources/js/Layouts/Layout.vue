<script setup>
import Navbar from '@/Components/Navigations/Navbar.vue'
import WhatsAppButton from '@/Components/WhatsAppButton.vue'
import TelegramButton from '@/Components/TelegramButton.vue';
import ThemeToggle from '@/Components/ThemeToggle.vue';
import { onMounted, ref } from 'vue';
import { AOS } from 'aos';
import { usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;


</script>
<template>
    <div class=" bg-light text-black dark:bg-dark dark:text-white">
        <Navbar />
        <main class="pt-16" > <!-- Padding to offset fixed navbar -->
            <slot />
            <TelegramButton />
        </main>

    </div>
</template>
