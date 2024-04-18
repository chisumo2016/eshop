<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Header from "@/Pages/User/Layouts/Header.vue";
import Hero from "@/Pages/User/Layouts/Hero.vue";
import Footer from "@/Pages/User/Layouts/Footer.vue";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})


</script>

<template>
<!---Header -->
<Header/>
<!---End -->
<!---Hero removed put into index-->

<!---End -->
<!---Main -->
<slot/>
<!---End -->

<!---Footer -->
<Footer/>
<!---End -->

</template>
<style scoped>

</style>
