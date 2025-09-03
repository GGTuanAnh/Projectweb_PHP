@extends('layouts.app')

@section('content')
    <!-- Hero -->
    <section class="relative bg-primary-800 text-white">
        <div class="absolute inset-0 opacity-25 bg-[url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1600&q=60')] bg-cover bg-center"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-24 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-tight">Hương Vị Cafe Đậm Đà</h1>
            <p class="text-lg md:text-xl max-w-2xl mx-auto mb-10 text-secondary-200">Tận hưởng những tách cà phê thơm ngon từ hạt được chọn lọc & rang xay chuẩn mực mỗi ngày.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('menu') }}" class="btn btn-secondary">Xem Thực Đơn</a>
                <a href="{{ route('products') }}" class="btn btn-outline">Sản Phẩm</a>
            </div>
        </div>
    </section>

    <!-- Featured Menu Items -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Thực Đơn <span class="text-primary-800">Nổi Bật</span></h2>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($featuredItems as $item)
                    <div class="card group overflow-hidden">
                        <div class="h-52 w-full overflow-hidden">
                            <img src="{{ $item->image ?? '/images/product-placeholder.jpg' }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition" />
                        </div>
                        <div class="card-body">
                            <h3 class="text-lg font-semibold text-primary-800 mb-2">{{ $item->name }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ $item->description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-secondary-600">{{ number_format($item->price,0,',','.') }} VND</span>
                                <div class="flex gap-2">
                                    <a href="{{ route('menu.item', $item->id) }}" class="text-sm text-primary-700 hover:underline">Chi tiết</a>
                                    <button class="text-sm text-secondary-600 hover:text-secondary-700" @click="$store.cart.add({id: {{ $item->id }}, name: '{{ e($item->name) }}', price: {{ $item->price }}, image: '{{ $item->image ?? '/images/product-placeholder.jpg' }}'})">+ Thêm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Chưa có món nổi bật.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Sản Phẩm <span class="text-primary-800">Nổi Bật</span></h2>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @forelse($featuredProducts as $product)
                    <div class="product-card">
                        <img class="w-full h-52 object-cover" src="{{ $product->image ?? '/images/product-placeholder.jpg' }}" alt="{{ $product->name }}">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-primary-800 mb-2">{{ $product->name }}</h3>
                            <div class="flex items-center mb-2 text-secondary-400">
                                @php $rating = (int)floor($product->rating ?? 4); @endphp
                                @for($i=0;$i<5;$i++)
                                    <span class="{{ $i < $rating ? 'text-secondary-400' : 'text-gray-300' }}">★</span>
                                @endfor
                            </div>
                            <p class="text-primary-800 font-bold mb-4">{{ number_format($product->price,0,',','.') }} VND</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('products.show', $product->id) }}" class="text-sm text-primary-800 hover:underline">Chi tiết</a>
                                <button class="btn btn-primary text-sm" @click="$store.cart.add({id: {{ $product->id }}, name: '{{ e($product->name) }}', price: {{ $product->price }}, image: '{{ $product->image ?? '/images/product-placeholder.jpg' }}'})">Thêm</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Chưa có sản phẩm nổi bật.</p>
                @endforelse
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('products') }}" class="btn btn-primary">Xem tất cả</a>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Danh Mục <span class="text-primary-800">Cafe</span></h2>
            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @forelse($categories as $cat)
                    <div class="card hover:shadow-lg transition">
                        <div class="card-body">
                            <h3 class="text-lg font-semibold text-primary-800 mb-2">{{ $cat->name }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-3">{{ $cat->description ?? 'Danh mục sản phẩm' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Chưa có danh mục.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Reviews -->
    <section class="py-16 bg-primary-800 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Khách hàng đánh giá</h2>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($reviews as $rev)
                    <div class="bg-primary-700/60 backdrop-blur-sm p-6 rounded-lg shadow-lg border border-primary-600/30">
                        <div class="flex items-center mb-4">
                            <img class="w-12 h-12 rounded-full object-cover ring-2 ring-secondary-500" src="/{{ $rev->avatar }}" alt="{{ $rev->name }}">
                            <div class="ml-4">
                                <div class="font-semibold">{{ $rev->name }}</div>
                                <div class="text-secondary-300 text-sm">
                                    @for($i=0;$i<5;$i++)
                                        <span class="{{ $i < $rev->rating ? 'text-secondary-400' : 'text-primary-500' }}">★</span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="italic text-secondary-100">"{{ $rev->comment }}"</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-20 bg-gradient-to-br from-gray-100 to-white">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-primary-800 mb-4">Đăng ký nhận tin</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-6">Nhận thông tin ưu đãi và sản phẩm mới nhất từ chúng tôi.</p>
            <form class="max-w-xl mx-auto flex flex-col sm:flex-row gap-4">
                <input type="email" placeholder="Email của bạn" required class="form-input flex-1">
                <button type="button" class="btn btn-primary">Đăng ký</button>
            </form>
        </div>
    </section>
@endsection
