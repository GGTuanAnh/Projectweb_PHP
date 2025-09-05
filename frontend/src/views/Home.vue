<template>
  <section class="relative">
    <div class="absolute inset-0 -z-10">
      <div class="h-full w-full bg-[radial-gradient(circle_at_30%_20%,rgba(214,165,116,0.35),transparent_60%)] dark:bg-[radial-gradient(circle_at_30%_20%,rgba(139,94,52,0.35),transparent_60%)]"></div>
    </div>
    <div class="grid gap-12 md:grid-cols-2 items-center">
      <div>
        <h1 class="text-4xl md:text-5xl font-semibold leading-tight mb-6 tracking-tight">
          Hương vị cà phê <span class="text-brand">đậm chất</span><br />trong nền tảng số
        </h1>
        <p class="text-stone-600 dark:text-stone-400 mb-8 max-w-md text-lg">
          Khám phá thực đơn phong phú, quản lý sản phẩm linh hoạt. API tách biệt giúp dễ mở rộng &amp; tích hợp.
        </p>
        <div class="flex flex-wrap gap-4">
          <RouterLink to="/menu" class="btn-primary !px-6 !py-3 shadow-soft">Xem thực đơn</RouterLink>
          <RouterLink to="/login" class="px-6 py-3 rounded-md border border-stone-300 dark:border-stone-600 text-stone-700 dark:text-stone-300 text-sm font-medium hover:shadow-soft hover:bg-white/60 dark:hover:bg-stone-800/60 backdrop-blur">Đăng nhập</RouterLink>
        </div>
      </div>
      <div class="relative">
        <div class="aspect-square rounded-2xl bg-gradient-to-br from-brand/20 via-stone-100 to-brand-light/30 dark:from-brand-dark/40 dark:via-stone-900 dark:to-brand/30 flex items-center justify-center shadow-soft">
          <span class="text-brand-dark dark:text-brand-light text-xl font-medium">API v1 + SPA</span>
        </div>
        <div class="absolute -bottom-6 -left-6 w-32 h-32 rounded-xl bg-gradient-to-br from-brand-light/60 to-brand/40 blur-2xl opacity-70 animate-pulse"></div>
      </div>
    </div>

    <div class="mt-20 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <div class="card relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-brand/10 to-transparent opacity-0 group-hover:opacity-100 transition pointer-events-none"></div>
        <h3 class="font-semibold mb-2">Tách API / Frontend</h3>
        <p class="text-sm text-stone-600 dark:text-stone-400">Laravel làm backend chuẩn REST, Vue 3 xử lý giao diện động.</p>
      </div>
      <div class="card">
        <h3 class="font-semibold mb-2">Sanctum Auth</h3>
        <p class="text-sm text-stone-600 dark:text-stone-400">Token bảo mật đơn giản, dễ tích hợp SPA &amp; mobile.</p>
      </div>
      <div class="card">
        <h3 class="font-semibold mb-2">Tối ưu mở rộng</h3>
        <p class="text-sm text-stone-600 dark:text-stone-400">Sẵn sàng cho giỏ hàng, đơn hàng, phân quyền nâng cao.</p>
      </div>
    </div>
  </section>
</template>
<script setup>
</script>
