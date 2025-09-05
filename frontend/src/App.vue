<template>
  <div :class="['app flex min-h-screen flex-col transition-colors duration-300', darkMode ? 'dark bg-stone-950 text-stone-100' : 'bg-transparent']">
    <header class="sticky top-0 z-40 backdrop-blur bg-white/70 dark:bg-stone-900/60 border-b border-stone-200/70 dark:border-stone-700/50">
      <nav class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">
        <RouterLink to="/" class="font-semibold tracking-wide text-lg flex items-center gap-2">
          <span class="text-2xl">☕</span> CafeShop
        </RouterLink>
        <ul class="hidden md:flex gap-6 text-sm font-medium">
          <li><RouterLink to="/menu" class="nav-link">Thực đơn</RouterLink></li>
          <li><RouterLink to="/login" class="nav-link">Đăng nhập</RouterLink></li>
        </ul>
        <div class="flex items-center gap-3">
          <button @click="toggleDark" class="w-9 h-9 rounded-full border border-stone-300 dark:border-stone-600 flex items-center justify-center text-stone-600 dark:text-stone-300 hover:shadow-soft hover:bg-stone-100 dark:hover:bg-stone-800 transition">
            <span v-if="!darkMode">🌙</span>
            <span v-else>☀️</span>
          </button>
        </div>
      </nav>
    </header>

    <main class="flex-1 w-full max-w-7xl mx-auto px-4 py-10">
      <RouterView />
    </main>

    <footer class="mt-16 relative overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-r from-brand-dark via-brand to-brand-light opacity-10 dark:opacity-20 animate-pulse"></div>
      <div class="relative max-w-7xl mx-auto px-4 py-8 text-xs flex flex-col md:flex-row gap-3 md:items-center justify-between text-stone-600 dark:text-stone-400">
        <span>&copy; {{ new Date().getFullYear() }} CafeShop. Crafted with Laravel & Vue.</span>
        <span class="opacity-80">API v1 • UI Tailwind</span>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, watchEffect } from 'vue';

const darkMode = ref(document.documentElement.classList.contains('dark'));
function toggleDark(){
  darkMode.value = !darkMode.value;
  const root = document.documentElement;
  if(darkMode.value){
    root.classList.add('dark');
    localStorage.setItem('theme','dark');
  } else {
    root.classList.remove('dark');
    localStorage.setItem('theme','light');
  }
}
</script>

<style scoped>
.nav-link { @apply relative px-1 py-2 transition text-stone-600 dark:text-stone-300 hover:text-brand dark:hover:text-brand-light; }
.nav-link::after { content:""; @apply absolute left-0 -bottom-0.5 h-[2px] w-0 bg-brand/80 transition-all; }
.nav-link:hover::after, .router-link-active.nav-link::after { @apply w-full; }
</style>

<style>
@tailwind base;
@tailwind components;
@tailwind utilities;

html {
  scroll-behavior: smooth;
}

body {
  @apply bg-gray-100 text-gray-900;
}

a {
  @apply transition-colors duration-200;
}

h1, h2, h3, h4, h5, h6 {
  @apply font-semibold;
}

ul {
  @apply list-disc pl-5;
}

.container {
  @apply max-w-6xl mx-auto px-4;
}
::-webkit-scrollbar { width:10px; }
::-webkit-scrollbar-track { background:transparent; }
::-webkit-scrollbar-thumb { background:#c9b8aa; border-radius:6px; }
.dark ::-webkit-scrollbar-thumb { background:#614a38; }
</style>
