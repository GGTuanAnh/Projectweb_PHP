<template>
  <div class="container">
    <h2>Thực đơn</h2>

    <div class="toolbar">
      <select v-model="selectedCategory" @change="fetchProducts(1)">
        <option value="">Tất cả danh mục</option>
        <option v-for="c in categories" :key="c.id" :value="c.slug">{{ c.name }}</option>
      </select>
      <input v-model="search" @keyup.enter="fetchProducts(1)" type="text" placeholder="Tìm kiếm..." />
      <button @click="fetchProducts(1)">Lọc</button>
    </div>

    <p v-if="loading">Đang tải...</p>

    <div v-if="!loading" class="grid">
      <div v-for="p in products" :key="p.id" class="card">
        <div class="thumb">{{ p.category?.name }}</div>
        <h3>{{ p.name }}</h3>
        <p class="price">{{ p.price.toLocaleString('vi-VN') }} đ</p>
        <RouterLink :to="`/products/${p.id}`">Chi tiết</RouterLink>
      </div>
    </div>

    <div class="pagination" v-if="meta">
      <button :disabled="meta.current_page === 1" @click="fetchProducts(meta.current_page - 1)">«</button>
      <span>Trang {{ meta.current_page }} / {{ meta.last_page }}</span>
      <button :disabled="meta.current_page === meta.last_page" @click="fetchProducts(meta.current_page + 1)">»</button>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const categories = ref([]);
const products = ref([]);
const meta = ref(null);
const loading = ref(false);
const selectedCategory = ref('');
const search = ref('');

async function fetchCategories() {
  const { data } = await axios.get('/api/v1/categories');
  categories.value = data.data;
}

async function fetchProducts(page = 1) {
  loading.value = true;
  try {
    const { data } = await axios.get('/api/v1/products', {
      params: {
        page,
        category: selectedCategory.value || undefined,
        search: search.value || undefined,
      }
    });
    products.value = data.data;
    meta.value = data.meta;
  } finally {
    loading.value = false;
  }
}

onMounted(async () => {
  await fetchCategories();
  await fetchProducts();
});
</script>
<style scoped>
.toolbar { display:flex; gap:.5rem; margin-bottom:1rem; }
.grid { display:grid; gap:1rem; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); }
.card { border:1px solid #ddd; padding:.75rem; border-radius:6px; background:#fff; }
.price { color:#c0392b; font-weight:600; }
.pagination { margin-top:1rem; display:flex; gap:.75rem; align-items:center; }
</style>
