<script setup>
</script>
<template>
    <!-- Admin Dropdown Menu -->
    <li class="relative group" data-aos="fade-down" data-aos-delay="200">
        <button class=" px-0 py-0  transition-all">
            User Menu
        </button>
        <!-- Dropdown menu (hidden by default, shown on hover) -->
        <ul class="absolute left-0 mt-0 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200 z-50">
            <li>
                <a href="/dashboard" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="/dashboard" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Logs
                </a>
            </li>

            <li>
                <Link href="/logout" as="button" method="post"
                    class="block px-4 py-2 text-red-500 hover:bg-gray-100 w-full text-left">
                    Logout
                </Link>

            </li>
        </ul>
    </li>
</template>
