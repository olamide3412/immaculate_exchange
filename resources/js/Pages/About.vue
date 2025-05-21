<script setup>
import Breadcrumb from '@/Components/Navigations/Breadcrumb.vue';
import WhyChooseUsSection from '@/Components/WhyChooseUsSection.vue';
import Footer from '@/Components/Footer.vue';
import AboutHero from '@/Components/About/AboutHero.vue'

</script>
<template>
    <Head :title=" ` | ${$page.component}` "/>
    <Breadcrumb title="About Us" name="About Us"/>
    <AboutHero/>
    <WhyChooseUsSection/>
    <Footer/>
</template>
