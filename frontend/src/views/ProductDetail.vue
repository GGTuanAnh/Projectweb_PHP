<template>
  <div v-if="product" class="max-w-5xl mx-auto">
    <RouterLink to="/menu" class="text-sm text-brand hover:underline">← Quay lại</RouterLink>
    <div class="mt-6 grid md:grid-cols-2 gap-10 items-start">
      <div class="relative">
        <div class="aspect-video rounded-2xl bg-gradient-to-br from-stone-200 to-stone-300 dark:from-stone-700 dark:to-stone-600 flex items-center justify-center text-stone-500 dark:text-stone-300 text-sm uppercase tracking-wide shadow-soft">
          {{ product.category?.name }}
        </div>
        <div class="absolute -bottom-4 -right-4 w-28 h-28 rounded-full bg-gradient-to-br from-brand-light/60 to-brand/40 blur-2xl opacity-70"></div>
      </div>
      <div>
        <h1 class="text-3xl font-semibold mb-4 leading-tight">{{ product.name }}</h1>
        <div class="text-brand text-2xl font-bold mb-5">{{ product.price.toLocaleString('vi-VN') }} đ</div>
        <p class="text-stone-600 dark:text-stone-400 mb-8">{{ product.description || 'Đang cập nhật mô tả cho sản phẩm này.' }}</p>
        <div class="flex flex-wrap gap-4">
          <button class="btn-primary shadow-soft">Thêm vào giỏ</button>
          <button class="px-4 py-2 rounded-md border border-stone-300 dark:border-stone-600 text-sm hover:shadow-soft hover:bg-white/60 dark:hover:bg-stone-800/60">Yêu thích</button>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="flex justify-center py-16"><span class="animate-pulse text-stone-500">Đang tải...</span></div>
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
