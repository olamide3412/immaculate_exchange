<script setup>
import Navbar from '@/Components/Navigations/Navbar.vue'
import WhatsAppButton from '@/Components/WhatsAppButton.vue'
import ThemeToggle from '@/Components/ThemeToggle.vue';
import { onMounted } from 'vue';
import { AOS } from 'aos';


</script>
<template>
    <div class=" bg-light text-black dark:bg-dark dark:text-white">
        <Navbar />
        <main class="pt-16" v-if="!$page.props.auth.user"> <!-- Padding to offset fixed navbar -->
            <slot />
            <WhatsAppButton />
        </main>
        <!--for class p-4 lg:ml-64 mt-16 -->
        <main v-if="$page.props.auth.user" class=" p-4 mt-16">
             <ThemeToggle/>
            <slot />
        </main>
    </div>
</template>
