<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  paginator: {
    type: Object,
    required: true,
  },
});

// Laravel-style truncation for pagination
const paginationLinks = computed(() => {
  const pages = [];
  const total = props.paginator.last_page;
  const current = props.paginator.current_page;

  if (total <= 7) {
    for (let i = 1; i <= total; i++) pages.push(i);
  } else {
    if (current <= 4) {
      pages.push(1, 2, 3, 4, 5, '...', total);
    } else if (current >= total - 3) {
      pages.push(1, '...', total - 4, total - 3, total - 2, total - 1, total);
    } else {
      pages.push(1, '...', current - 1, current, current + 1, '...', total);
    }
  }

  return pages;
});

const getUrlForPage = (page) => {
  if (page === '...') return null;

  const baseUrl = props.paginator.path;
  const query = new URLSearchParams(props.paginator.query || {});
  query.set('page', page);
  return `${baseUrl}?${query.toString()}`;
};
</script>

<template>
  <div class="flex justify-center items-center gap-2 mt-6">
    <Link
      v-if="paginator.current_page > 1"
      :href="getUrlForPage(paginator.current_page - 1)"
      class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-900"
    >
       &lt;&lt;
    </Link>

    <div v-for="(page, i) in paginationLinks" :key="i" class=" hidden md:inline">
      <span
        v-if="page === '...'"
        class="px-3 py-1 rounded bg-gray-100 dark:bg-gray-800 text-gray-400 cursor-default"
      >...</span>

      <Link
        v-else
        :href="getUrlForPage(page)"
        :class="[
          'px-3 py-1 rounded',
          page === paginator.current_page ? 'bg-secondary-500 text-white ' : 'bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-900',
        ]"
      >
        {{ page }}
      </Link>
    </div>

    <Link
      v-if="paginator.current_page < paginator.last_page"
      :href="getUrlForPage(paginator.current_page + 1)"
      class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300  dark:bg-gray-800 dark:hover:bg-gray-900"
    >
        &gt;&gt;
    </Link>
  </div>
</template>
