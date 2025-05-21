<script setup>
import { computed, ref } from 'vue'

const props = defineProps({
  log: {
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
                       # -> {{ serial }}
                    </h3>
                </div>

                <p class="text-gray-600 dark:text-gray-200 mt-2"><strong>Log:</strong> {{ log.log }}</p>
                 <p class=" text-end">{{ $formatDate(log.created_at,'ddd, DD-MMM-YYYY HH:mm') }}</p>
            </div>

        </div>
</template>
