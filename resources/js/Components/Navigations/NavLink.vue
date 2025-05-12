<script setup>

const props = defineProps({
    href: {
        type: String,
        default: '#'
    },
    active: {
        type: Boolean,
        default: false
    },
    onClick: Function
})

</script>

<template>
  <li>
    <Link
      :href="href"
      :class="[
        'py-1 px-4',
        active ? 'border-b-3 border-b-primary' : ''
      ]"
      @click="onClick"
    >
      <slot/>
    </Link>
  </li>
</template>
