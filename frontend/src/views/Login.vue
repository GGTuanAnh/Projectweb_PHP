<template>
  <div class="max-w-sm mx-auto bg-white/80 dark:bg-stone-900/70 backdrop-blur border border-stone-200 dark:border-stone-700 p-6 rounded-xl shadow-soft">
    <h1 class="text-xl font-semibold mb-5 flex items-center gap-2">🔐 <span>Đăng nhập</span></h1>
    <form @submit.prevent="login" class="space-y-5">
      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input v-model="email" type="email" required class="w-full border dark:border-stone-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand/40 bg-white dark:bg-stone-800" />
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Mật khẩu</label>
        <input v-model="password" type="password" required class="w-full border dark:border-stone-600 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand/40 bg-white dark:bg-stone-800" />
      </div>
      <button :disabled="loading" class="btn-primary w-full justify-center shadow-soft" type="submit">{{ loading ? 'Đang xử lý...' : 'Đăng nhập' }}</button>
      <p v-if="error" class="text-sm text-red-500">{{ error }}</p>
    </form>
  </div>
</template>
<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();
const email = ref('');
const password = ref('');
const loading = ref(false);
const error = ref('');

async function login() {
  loading.value = true; error.value='';
  try {
    const { data } = await axios.post('/api/v1/auth/login', { email: email.value, password: password.value });
    localStorage.setItem('token', data.data.token);
    axios.defaults.headers.common.Authorization = `Bearer ${data.data.token}`;
    router.push('/');
  } catch (e) {
    error.value = e.response?.data?.message || 'Đăng nhập thất bại';
  } finally { loading.value = false; }
}
</script>
<style scoped>
.auth { max-width:360px; }
form { display:flex; flex-direction:column; gap:.75rem; }
input { width:100%; padding:.5rem; }
.error { color:#c0392b; }
</style>
