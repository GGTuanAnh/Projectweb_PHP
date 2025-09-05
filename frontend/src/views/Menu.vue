<template>
  <div>
    <h1 class="text-2xl font-semibold mb-6 flex items-center gap-2">Thực đơn <span class="text-xs font-normal px-2 py-0.5 rounded-full bg-brand/10 text-brand">Live</span></h1>

    <div class="flex flex-col md:flex-row gap-3 md:items-center md:gap-4 mb-6">
      <div class="flex gap-3 flex-1">
        <select v-model="selectedCategory" @change="fetchProducts(1)" class="border rounded-md px-3 py-2 w-48 bg-white dark:bg-stone-800 dark:border-stone-600">
          <option value="">Tất cả danh mục</option>
          <option v-for="c in categories" :key="c.id" :value="c.slug">{{ c.name }}</option>
        </select>
        <div class="flex-1 relative">
          <input v-model="search" @keyup.enter="fetchProducts(1)" type="text" placeholder="Tìm kiếm..." class="w-full border rounded-md px-3 py-2 pr-10 dark:bg-stone-800 dark:border-stone-600" />
          <button @click="fetchProducts(1)" class="absolute right-1 top-1/2 -translate-y-1/2 text-sm bg-brand text-white rounded px-3 py-1 shadow-soft">Lọc</button>
        </div>
      </div>
      <div class="text-sm text-stone-600 dark:text-stone-400" v-if="meta">Tổng: <strong>{{ meta.total }}</strong> sản phẩm</div>
    </div>

    <div v-if="loading" class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
      <div v-for="n in 8" :key="n" class="card animate-pulse">
        <div class="aspect-video rounded-md bg-gradient-to-r from-stone-200 via-stone-100 to-stone-200 bg-[length:200%_100%] animate-shimmer dark:from-stone-700 dark:via-stone-600 dark:to-stone-700"></div>
        <div class="h-4 mt-3 w-3/4 rounded bg-stone-200 dark:bg-stone-700"></div>
        <div class="h-3 mt-2 w-1/2 rounded bg-stone-200 dark:bg-stone-700"></div>
      </div>
    </div>

    <transition-group v-else name="fade" tag="div" class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
      <div v-for="p in products" :key="p.id" class="card group relative overflow-hidden">
        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition bg-gradient-to-br from-brand/10 to-transparent pointer-events-none"></div>
        <div class="aspect-video rounded-md bg-gradient-to-br from-stone-200 to-stone-300 dark:from-stone-700 dark:to-stone-600 mb-3 flex items-center justify-center text-stone-500 dark:text-stone-300 text-xs tracking-wide uppercase">{{ p.category?.name }}</div>
        <h3 class="font-medium mb-1 line-clamp-2 group-hover:text-brand transition">{{ p.name }}</h3>
        <div class="flex items-center justify-between mt-auto pt-2">
          <span class="text-brand font-semibold text-sm">{{ p.price.toLocaleString('vi-VN') }} đ</span>
          <RouterLink :to="`/products/${p.id}`" class="text-xs text-brand-dark hover:underline">Chi tiết</RouterLink>
        </div>
      </div>
    </transition-group>

    <div class="flex items-center gap-3 justify-center mt-10" v-if="meta">
      <button :disabled="meta.current_page === 1" @click="fetchProducts(meta.current_page - 1)" class="px-3 py-1 rounded border dark:border-stone-600 disabled:opacity-40">«</button>
      <span class="text-sm text-stone-600 dark:text-stone-400">Trang {{ meta.current_page }} / {{ meta.last_page }}</span>
      <button :disabled="meta.current_page === meta.last_page" @click="fetchProducts(meta.current_page + 1)" class="px-3 py-1 rounded border dark:border-stone-600 disabled:opacity-40">»</button>
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
      params: { page, category: selectedCategory.value || undefined, search: search.value || undefined }
    });
    products.value = data.data;
    meta.value = data.meta;
  } finally { loading.value = false; }
}

onMounted(async () => { await fetchCategories(); await fetchProducts(); });
</script>

<style scoped>
.fade-enter-active, .fade-leave-active { transition: all .25s ease; }
.fade-enter-from, .fade-leave-to { opacity:0; transform: translateY(4px); }
</style>
