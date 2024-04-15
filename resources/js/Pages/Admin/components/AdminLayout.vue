<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Navbar from "@/Pages/Admin/components/navbar.vue";
import Sidebar from "@/Pages/Admin/components/sidebar.vue";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>

<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <!-- navbar start -->
        <Navbar/>
        <!-- end -->

        <!-- Sidebar -->
            <Sidebar/>
        <!-- end-->
        <main class="p-4 md:ml-64 h-auto pt-20">
            <!--Slot-->
            <slot/>
            <!--end Slot-->
        </main>

    </div>
</template>

<style scoped>

</style>
