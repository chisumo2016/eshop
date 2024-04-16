<script setup>

import AdminLayout from "@/Pages/Admin/components/AdminLayout.vue";
import ProductList from "@/Pages/Admin/Products/ProductList.vue";

defineProps({
    products: Array,
})
</script>

<template>
<AdminLayout>
    <ProductList :products="products" />
</AdminLayout>
</template>

<style scoped>

</style>
