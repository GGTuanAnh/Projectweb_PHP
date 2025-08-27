<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Thực Đơn</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background-color: #6f4e37;
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
        }
        
        nav ul li {
            margin: 0 15px;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #ffd700;
        }
        
        .page-header {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1509042239860-f550ce710b93?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80') no-repeat center center/cover;
            padding: 80px 0;
            text-align: center;
            color: white;
        }
        
        .page-header h1 {
            font-size: 42px;
            margin-bottom: 15px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #c0392b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: bold;
        }
        
        .btn:hover {
            background-color: #e74c3c;
        }
        
        .section {
            padding: 60px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            font-size: 32px;
            color: #333;
        }
        
        .section-title span {
            color: #c0392b;
        }
        
        .filter-container {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        
        .filter-btn {
            background-color: #f1e5d9;
            color: #6f4e37;
            border: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .filter-btn:hover, .filter-btn.active {
            background-color: #6f4e37;
            color: white;
        }
        
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .menu-item {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .menu-item:hover {
            transform: translateY(-5px);
        }
        
        .menu-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .menu-content {
            padding: 20px;
        }
        
        .menu-title {
            font-size: 20px;
            margin-bottom: 10px;
        }
        
        .menu-price {
            color: #c0392b;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        .menu-desc {
            margin-bottom: 15px;
            color: #666;
        }
        
        footer {
            background-color: #333;
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        
        .footer-links {
            margin-bottom: 20px;
        }
        
        .footer-links a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        
        .footer-links a:hover {
            text-decoration: underline;
        }
        
        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li><a href="{{ route('menu') }}">Thực đơn</a></li>
                    <li><a href="{{ route('about') }}">Giới thiệu</a></li>
                    <li><a href="{{ route('products') }}">Sản phẩm</a></li>
                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="page-header">
        <div class="container">
            <h1>Thực đơn của chúng tôi</h1>
            <p>Khám phá hương vị đa dạng từ những tách cà phê đến các món tráng miệng</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="filter-container">
                <button class="filter-btn active" data-category="all">Tất cả</button>
                @foreach($categories as $category)
                <button class="filter-btn" data-category="{{ $category->slug }}">{{ $category->name }}</button>
                @endforeach
            </div>

            <div class="menu-grid">
                @foreach($menuItems as $item)
                <div class="menu-item" data-category="{{ $item->category->slug }}">
                    <img src="{{ $item->image }}" alt="{{ $item->name }}" class="menu-img">
                    <div class="menu-content">
                        <h3 class="menu-title">{{ $item->name }}</h3>
                        <p class="menu-price">{{ number_format($item->price) }} VND</p>
                        <p class="menu-desc">{{ $item->description }}</p>
                        <a href="{{ route('menu.item', $item->id) }}" class="btn">Chi tiết</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-links">
                <a href="{{ route('home') }}">Trang chủ</a>
                <a href="{{ route('menu') }}">Thực đơn</a>
                <a href="{{ route('about') }}">Giới thiệu</a>
                <a href="{{ route('products') }}">Sản phẩm</a>
                <a href="{{ route('contact') }}">Liên hệ</a>
            </div>
            <div class="social-links">
                <a href="#" target="_blank">F</a>
                <a href="#" target="_blank">I</a>
                <a href="#" target="_blank">T</a>
            </div>
            <p>&copy; 2025 {{ config('app.name') }}. Tất cả các quyền được bảo lưu.</p>
        </div>
    </footer>

    <script>
        // Simple filtering functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const menuItems = document.querySelectorAll('.menu-item');
            
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Reset active class
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    const category = this.getAttribute('data-category');
                    
                    menuItems.forEach(item => {
                        if (category === 'all' || item.getAttribute('data-category') === category) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
