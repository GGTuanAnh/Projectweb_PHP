<template>
  <div class="layout">
    <header class="topbar">
      <h1 class="logo">CafeShop</h1>
      <nav>
        <RouterLink to="/">Trang chủ</RouterLink>
        <RouterLink to="/menu">Thực đơn</RouterLink>
        <RouterLink to="/login">Đăng nhập</RouterLink>
      </nav>
    </header>
    <main class="main">
      <RouterView />
    </main>
  </div>
</template>

<script setup>
</script>

<style>
body,html,#app {margin:0;padding:0;font-family:system-ui,sans-serif;background:#faf9f7;color:#222;}
.topbar {display:flex;align-items:center;justify-content:space-between;padding:12px 28px;background:#6f4e37;color:#fff;}
.topbar a {color:#fff;margin-right:14px;text-decoration:none;font-weight:600;}
.topbar a.router-link-active {text-decoration:underline;}
.logo {margin:0;font-size:20px;letter-spacing:.5px;}
.main {padding:28px;}
.container {max-width:1100px;margin:0 auto;}
</style>
