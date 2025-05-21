<script setup>
import HeroSection from '@/Components/Home/HeroSection.vue';
import CryptoTicker from '@/Components/Home/CryptoTicker.vue';
import IntroductionSection from '@/Components/Home/IntroductionSection.vue';
import CryptoSection  from '@/Components/Home/CryptoSection.vue';
import WhyChooseUsSection from '@/Components/WhyChooseUsSection.vue';
import ServicesSection from '@/Components/ServicesSection.vue';
import Footer from '@/Components/Footer.vue';
import ThemeToggle from '@/Components/ThemeToggle.vue';

</script>

<template>
    <Head :title=" ` | ${$page.component}` "/>
    <div >
        <ThemeToggle/>
        <HeroSection/>
        <CryptoTicker/>
        <IntroductionSection/>
        <CryptoSection />
        <WhyChooseUsSection/>
        <ServicesSection/>
        <Footer/>
    </div>
</template>
