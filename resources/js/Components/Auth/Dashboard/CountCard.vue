<script setup>
defineProps({
    title:{
        type:String,
        required: true,
    },
    count: String,
    icon: String
})
</script>
<template>
<div class="bg-white dark:bg-gray-500 shadow-lg rounded-lg p-4 flex flex-col md:flex-row items-center justify-between">
    <div class="  mb-4 md:mb-0">
        <h2 class="text-lg md:text-1xl font-bold text-gray-900 dark:text-gray-100">{{ title }}</h2>
        <p class="text-center md:text-left text-lg text-gray-600 dark:text-gray-300 ">{{ count }}</p>

    </div>
    <div class="w-12 h-12 text-secondary-500" v-html="icon"></div>
</div>

</template>
