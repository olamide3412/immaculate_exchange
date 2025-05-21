<script setup>
const model = defineModel({
    type: null,
    required: true,
})

defineProps({
    name: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    type:{
        type: String,
        default: 'text'
    },
    message: String,
    placeholder: String,
    required:{
        type: Boolean,
        default: false
    },
})
</script>
<template>
    <div class="mb-2">
        <label> {{label}} <span v-if="required" class=" text-red-500">*</span> </label>
        <input :type="type" v-model="model" :class="{'!ring-red-500' : message}"
                :placeholder="placeholder??label" :required="required" :name="name"/>
        <small class="error" v-if="message">{{ message }}</small>
    </div>
</template>


