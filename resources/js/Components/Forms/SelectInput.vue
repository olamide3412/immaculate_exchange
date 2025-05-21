<script setup>
const model = defineModel({
  type: null,
  required: true,
});

defineProps({
  name: {
    type: String,
    required: true,
  },
  options: {
    type: Array,
    required: true,
    // Expected format: [{ value: '1', label: 'Option 1' }, ...]
  },
  message: String,
  required: {
    type: Boolean,
    default: false,
  },

  disabled: {
    type: Boolean,
    default: false,
  },
});
</script>

<template>
  <div class="mb-2">
    <label>
      {{ name }}
      <span v-if="required" class="text-red-500">*</span>
    </label>
    <select
      v-model="model"
      :required="required"
      :disabled="disabled"
      class="block w-full rounded-md border-0 px-4 py-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-blue-500 bg-white sm:text-sm"
      :class="{ '!ring-red-500': message }"

    >
      <option value="">Select {{ name }}</option>
      <option
        v-for="(option, index) in options"
        :key="index"
        :value="option.value"
      >
        {{ option.label }}
      </option>
    </select>
    <small class="error" v-if="message">{{ message }}</small>
  </div>
</template>

