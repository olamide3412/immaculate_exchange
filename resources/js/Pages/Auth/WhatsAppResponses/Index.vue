<script setup>
import AddWhatsAppResponse from '@/Components/Auth/WhatsAppResponses/Add.vue';
import WhatsAppResponseListings from '@/Components/Auth/WhatsAppResponses/Listings.vue';
import { ref } from 'vue';

const props = defineProps({
    whatsAppResponses: Object
})

const activeTab = ref('listings');
const handleChaneActiveTab = (tabName = 'listings') => {
    activeTab.value = tabName;
}
</script>

<template>
      <Head :title=" ` | ${$page.component}` "/>
  <div class="container-xl lg:container m-auto   p-6">
    <!-- Tab Buttons -->
    <div class="flex space-x-2 mb-4">
      <button
        :class="[
          'w-fit py-2 px-4 text-sm font-medium rounded-full transition-colors',
          activeTab === 'listings'
            ? 'bg-secondary-400 text-white'
            : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
        ]"
        @click="activeTab = 'listings'"
      >
        Responses
      </button>
      <button
        :class="[
          'w-fit py-2 px-4 text-sm font-medium rounded-full transition-colors',
          activeTab === 'add'
            ? 'bg-secondary-500 text-white'
            : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
        ]"
        @click="activeTab = 'add'"
      >
        Add Response
      </button>
    </div>

    <!-- Tab Content -->
    <div class="p-4 rounded-lg shadow-inner">
      <WhatsAppResponseListings v-if="activeTab === 'listings'" :whatsAppResponses="whatsAppResponses"/>
      <AddWhatsAppResponse v-if="activeTab === 'add'"  @change-active-tab="handleChaneActiveTab"/>
    </div>
  </div>
</template>
