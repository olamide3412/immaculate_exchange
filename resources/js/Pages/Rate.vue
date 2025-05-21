<script setup>
import Breadcrumb from '@/Components/Navigations/Breadcrumb.vue';
import Footer from '@/Components/Footer.vue';
import ExchangeRate from '@/Components/Rate/ExchangeRate.vue';
import NoticeSection from '@/Components/Rate/NoticeSection.vue'

</script>
<template>
    <Head :title=" ` | ${$page.component}` "/>
    <Breadcrumb title="Exchange Rate" name="Rate"/>
    <ExchangeRate/>
    <NoticeSection/>
    <Footer/>
</template>
