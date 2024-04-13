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

        <!--Slot-->
        <slot/>
        <!--end Slot-->
    </div>
</template>

<style scoped>

</style>
