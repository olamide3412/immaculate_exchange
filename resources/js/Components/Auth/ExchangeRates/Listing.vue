<script setup>
import { computed, ref } from 'vue'

const props = defineProps({
  exchangeRate: {
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



const serial = computed(() => {
  return (props.currentPage - 1) * props.perPage + props.index + 1
})



</script>

<template>

        <div class=" border rounded-lg p-4 mb-4 shadow-sm dark:bg-gray-900">
            <div>

                <div class="flex justify-between items-center">
                    <h3 class="font-bold text-lg">
                        {{ serial }}-> {{ exchangeRate.name }}
                    </h3>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-200 mt-2"><strong>Amount:</strong> {{ exchangeRate.amount }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    <strong>Rate:</strong>
                    {{ exchangeRate.rate }}
                </p>
            </div>
            <div class="mt-4 flex justify-end">
                <Link :href="route('exchangeRate.show', exchangeRate.id)" class="rounded-element">
                    <font-awesome-icon :icon="['fas', 'eye']"/>  Show
                </Link>
            </div>
        </div>
</template>
