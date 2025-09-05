<template>
  <div class="container" v-if="product">
    <RouterLink to="/menu">← Quay lại</RouterLink>
    <h2>{{ product.name }}</h2>
    <p>Danh mục: {{ product.category?.name }}</p>
    <p>Giá: <strong>{{ product.price.toLocaleString('vi-VN') }} đ</strong></p>
    <p>Mô tả: {{ product.description || 'Đang cập nhật...' }}</p>
  </div>
  <p v-else>Đang tải...</p>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const product = ref(null);

onMounted(async () => {
  const { data } = await axios.get(`/api/v1/products/${route.params.id}`);
  product.value = data.data;
});
</script>
