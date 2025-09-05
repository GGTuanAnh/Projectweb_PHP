<template>
  <div class="container auth">
    <h2>Đăng nhập</h2>
    <form @submit.prevent="login">
      <label>Email
        <input v-model="email" type="email" required />
      </label>
      <label>Mật khẩu
        <input v-model="password" type="password" required />
      </label>
      <button :disabled="loading">{{ loading ? 'Đang xử lý...' : 'Đăng nhập' }}</button>
      <p v-if="error" class="error">{{ error }}</p>
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
