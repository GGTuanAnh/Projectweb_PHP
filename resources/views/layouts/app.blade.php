<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Quán Cafe Ngon</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <header class="bg-primary-800 text-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-white hover:text-secondary-400">
                    {{ config('app.name') }}
                </a>
                
                <!-- Mobile menu button -->
                <div class="md:hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                    
                    <!-- Mobile menu -->
                    <div x-show="open" class="absolute top-16 right-0 left-0 bg-primary-800 z-50 shadow-md py-2" x-cloak>
                        <nav class="px-4 py-2 space-y-2">
                            <a href="{{ route('home') }}" class="block px-4 py-2 text-white hover:bg-primary-700 rounded">Trang chủ</a>
                            <a href="{{ route('menu') }}" class="block px-4 py-2 text-white hover:bg-primary-700 rounded">Thực đơn</a>
                            <a href="{{ route('products') }}" class="block px-4 py-2 text-white hover:bg-primary-700 rounded">Sản phẩm</a>
                            <a href="{{ route('about') }}" class="block px-4 py-2 text-white hover:bg-primary-700 rounded">Giới thiệu</a>
                            <a href="{{ route('contact') }}" class="block px-4 py-2 text-white hover:bg-primary-700 rounded">Liên hệ</a>
                            @guest
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-white hover:bg-primary-700 rounded">Đăng nhập</a>
                                <a href="{{ route('register') }}" class="block px-4 py-2 text-white hover:bg-primary-700 rounded">Đăng ký</a>
                            @else
                                <div x-data="{ open: false }" class="relative">
                                    <button @click="open = !open" class="block w-full text-left px-4 py-2 text-white hover:bg-primary-700 rounded">
                                        {{ Auth::user()->name }}
                                    </button>
                                    <div x-show="open" class="bg-primary-800 rounded-md shadow-lg py-1 mt-1" x-cloak>
                                        @if(Auth::user()->isAdminOrStaff())
                                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-white hover:bg-primary-700">Quản trị</a>
                                        @endif
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-white hover:bg-primary-700">
                                                Đăng xuất
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endguest
                        </nav>
                    </div>
                </div>
                
                <!-- Desktop menu -->
                <nav class="hidden md:flex space-x-6 items-center">
                    <a href="{{ route('home') }}" class="text-white hover:text-secondary-400 font-medium">Trang chủ</a>
                    <a href="{{ route('menu') }}" class="text-white hover:text-secondary-400 font-medium">Thực đơn</a>
                    <a href="{{ route('products') }}" class="text-white hover:text-secondary-400 font-medium">Sản phẩm</a>
                    <a href="{{ route('about') }}" class="text-white hover:text-secondary-400 font-medium">Giới thiệu</a>
                    <a href="{{ route('contact') }}" class="text-white hover:text-secondary-400 font-medium">Liên hệ</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-white hover:text-secondary-400 font-medium">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="btn-primary">Đăng ký</a>
                    @else
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center text-white hover:text-secondary-400 font-medium">
                                {{ Auth::user()->name }}
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50" x-cloak>
                                @if(Auth::user()->isAdminOrStaff())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Quản trị</a>
                                @endif
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Tài khoản</a>
                                <a href="{{ route('customer.orders') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Đơn hàng</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                    <a href="{{ route('cart') }}" class="flex items-center text-white hover:text-secondary-400">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span class="ml-1" x-text="$store.cart.count">0</span>
                    </a>
                </nav>
            </div>
        </div>
    </header>
    
    <main>
        @yield('content')
    </main>
    
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Liên hệ</h3>
                    <p class="mb-2">Email: info@cafeshop.com</p>
                    <p class="mb-2">Điện thoại: 0123 456 789</p>
                    <p>Địa chỉ: 123 Đường Cafe, Quận 1, TP HCM</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Giờ mở cửa</h3>
                    <p class="mb-2">Thứ Hai - Thứ Sáu: 7h - 22h</p>
                    <p>Thứ Bảy - Chủ Nhật: 8h - 23h</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Theo dõi chúng tôi</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-secondary-400 text-xl">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-white hover:text-secondary-400 text-xl">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-white hover:text-secondary-400 text-xl">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p>&copy; {{ date('Y') }} CafeShop. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('cart', {
                count: 0,
                items: [],
                
                init() {
                    // Fetch cart data from localStorage or API
                    const savedCart = JSON.parse(localStorage.getItem('cart') || '{"items":[]}');
                    this.items = savedCart.items || [];
                    this.count = this.items.length;
                },
                
                add(product) {
                    const existingItem = this.items.find(item => item.id === product.id);
                    
                    if (existingItem) {
                        existingItem.quantity += 1;
                    } else {
                        this.items.push({
                            ...product,
                            quantity: 1
                        });
                    }
                    
                    this.count = this.items.length;
                    this.saveToStorage();
                },
                
                remove(productId) {
                    this.items = this.items.filter(item => item.id !== productId);
                    this.count = this.items.length;
                    this.saveToStorage();
                },
                
                updateQuantity(productId, quantity) {
                    const item = this.items.find(item => item.id === productId);
                    if (item) {
                        item.quantity = quantity;
                        this.saveToStorage();
                    }
                },
                
                clearCart() {
                    this.items = [];
                    this.count = 0;
                    this.saveToStorage();
                },
                
                saveToStorage() {
                    localStorage.setItem('cart', JSON.stringify({
                        items: this.items
                    }));
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
