<script setup>
import { computed, ref } from 'vue'
import TriggerTags from '@/Components/Auth/WhatsAppResponses/TriggerTags.vue'
import { faL } from '@fortawesome/free-solid-svg-icons';

const props = defineProps({
  whatsAppResponse: {
    type: Object,
    required: true
  },
  index: {
    type: Number,
    required: true
  },
  currentPage: {
    type: Number,
    required: true
  },
  perPage: {
    type: Number,
    required: true
  }
})

const showFullResponse = ref(false);
const isResponseMuch = ref(false);

const serial = computed(() => {
  return (props.currentPage - 1) * props.perPage + props.index + 1
})

const toggleFullResponse = () => {
  showFullResponse.value = !showFullResponse.value;
}

const truncatedResponse = computed(() => {
    let response = props.whatsAppResponse.response;
    if (response && response.length >= 125) {
        isResponseMuch.value = true;
    }

    if (isResponseMuch.value && !showFullResponse.value){
        response = response.substring(0, 125) + '...';
    }
    return response;
});


</script>

<template>

        <div class=" border rounded-lg p-4 mb-4 shadow-sm dark:bg-gray-900">
            <div>

                <div class="flex justify-between items-center">
                    <h3 class="font-bold text-lg">
                        {{ serial }}-> {{ whatsAppResponse.name }}
                    </h3>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-200 mt-2"><strong>Triggers:</strong></p>
                <TriggerTags :triggers="whatsAppResponse.triggers" />
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    <strong>Response:</strong>
                    {{ truncatedResponse }}
                    <button
                        v-if="isResponseMuch"
                        @click="toggleFullResponse"
                        class="text-secondary-500 hover:text-secondary-600 dark:text-secondary-200 dark:hover:text-secondary-300 mb-5 underline">
                            {{ showFullResponse ? 'Show Less' : 'Show More' }}
                    </button>
                </p>
            </div>
            <div class="mt-4 flex justify-end">
                <Link :href="route('whatsAppResponse.show', whatsAppResponse.id)" class="rounded-element">
                    <font-awesome-icon :icon="['fas', 'eye']"/>  Show
                </Link>
            </div>
        </div>
</template>
