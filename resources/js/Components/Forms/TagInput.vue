<script setup>
import { ref } from 'vue'

const props = defineProps({
  modelValue: {
    type: Array,
    default: () => []
  },
  placeholder: {
    type: String,
    default: 'Add trigger'
  },
  message: String,
})

const emit = defineEmits(['update:modelValue'])

const newTag = ref('')
const tags = ref([...props.modelValue])

function addTag(e) {
  const value = newTag.value.trim()
  if (!value) return

  // Allow both "Enter" and "Comma" to work
  if (e.key === 'Enter' || e.type === 'blur') {
    if (!tags.value.includes(value)) {
      tags.value = [...tags.value, value]
      newTag.value = ''
      emit('update:modelValue', tags.value)
    }

    e.preventDefault()
    e.stopPropagation()
  }
}

function removeTag(index) {
  tags.value = tags.value.filter((_, i) => i !== index)
  emit('update:modelValue', tags.value)
}
</script>

<template>
  <div class="border border-gray-300 rounded-md p-2 min-h-[40px]">
    <!-- Tag List -->
    <div class="flex flex-wrap gap-2 mb-2">
      <span
        v-for="(tag, index) in tags"
        :key="index"
        class="bg-primary text-white px-2 py-1 rounded-full text-sm flex items-center"
      >
        {{ tag }}
        <button
          type="button"
          @click="removeTag(index)"
          class="ml-1 font-bold focus:outline-none"
        >
          &times;
        </button>
      </span>
    </div>

    <!-- Tag Input -->
    <input
      type="text"
      v-model="newTag"
      @keydown.enter="addTag"
      @blur="addTag"
      :placeholder="placeholder"
      class="lowercase"
    />
    <small class="error" v-if="message">{{ message }}</small>
  </div>
</template>
