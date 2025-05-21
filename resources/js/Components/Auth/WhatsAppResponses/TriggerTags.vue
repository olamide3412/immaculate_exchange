<script setup>
import { ref } from 'vue'

const props = defineProps({
  triggers : {
    type: [Array, String],
  }
})

const tags = ref(
    typeof props.triggers === 'string' ?
    JSON.parse(props.triggers) :
    [...props.triggers]
)


</script>

<template>
  <div class=" rounded-md p-1 min-h-[30px]">
    <!-- Tag List -->
    <div class="flex flex-wrap gap-2 mb-1">
      <span
        v-for="(tag, index) in tags"
        :key="index"
        class="bg-slate-500 text-white px-2 py-1 rounded-full text-sm flex items-center"
      >
        {{ tag }}
      </span>
    </div>


  </div>
</template>
