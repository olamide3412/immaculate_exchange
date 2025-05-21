<script setup>
import { computed } from 'vue'


const props = defineProps({
  user: {
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
});


const serial = computed(() => {
  return (props.currentPage - 1) * props.perPage + props.index + 1
})

const isEnable = computed(() => props.user.status === 'enable');


</script>

<template>
    <div>

        <div class="bg-white dark:bg-gray-900 border rounded-lg p-4 mb-4 shadow-sm">
            <Link :href="route('users.show', user.id)" class=" block">

                <div class="flex justify-between items-center">
                    <h3 class="font-bold text-lg">
                    {{ serial }} -> {{ user.name }}
                    <span
                        class="rounded-xl p-1 text-xs"
                        :class="isEnable ? 'bg-green-200 dark:bg-green-500' : 'bg-red-200 dark:bg-red-500'"
                    >
                        <font-awesome-icon :icon="isEnable ? ['fas', 'certificate'] : ['fas', 'xmark'] "/>
                        {{ isEnable ? 'Enable' : 'Disabled' }}
                    </span>
                    </h3>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-200 mt-2"><strong>Role:</strong> {{ user.role }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-200"><strong>Phone:</strong> {{ user.phone_number ?? 'NIL' }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-200"><strong>User Name: </strong>{{ user.user_name  ?? 'NIL' }}</p>
            </Link>
            <div class="mt-4 flex justify-end">


                <Link :href="route('users.show', user.id)" class="rounded-element">
                    <font-awesome-icon :icon="['fas', 'eye']"/>  Show
                </Link>

            </div>
        </div>


  </div>

</template>
