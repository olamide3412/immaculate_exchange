<script setup>
import CountCard from '@/Components/Dashboard/CountCard.vue';
import IconUtils from '@/Utils/icons';


defineProps({
    counts:{
        type:Object,
        required: true
    }
})


</script>
<template>
    <div class="container mx-auto p-4">
        <h4  class="'text-sm md:text-base lg:text-lg xl:text-xl font-bold py-1 text-primary dark:text-gray-200 cursor-pointer hover:text-lg lg:hover:text-2xl w-full mt-4 mb-2 uppercase'">
           DashBoard
        </h4>

        <div v-html="userIcon"></div>
        <!-- Users Section -->
        <div class="container mx-auto p-6">
            <h3 class="text-2xl font-bold mb-3">Users</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <CountCard title="Users" :count="counts.users" :icon="IconUtils.userIcon()" />
                <CountCard title="Administrator" :count="counts.admins" :icon="IconUtils.adminIcon()" />
                <CountCard title="Super Administrator" :count="counts.superAdmins" :icon="IconUtils.superAdminIcon()" />
                <CountCard title="Logs" :count="counts.logs" :icon="IconUtils.logIcon()" />
            </div>
        </div>
    </div>
</template>
