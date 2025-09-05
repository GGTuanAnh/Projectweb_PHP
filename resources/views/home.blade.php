<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Quán Cafe Ngon</title>
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
        
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80') no-repeat center center/cover;
            height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 0 20px;
        }
        
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 20px;
            max-width: 700px;
            margin-bottom: 30px;
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
        
        .menu-container, .products-container, .reviews-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .menu-item, .product-item, .review-item {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .menu-item:hover, .product-item:hover {
            transform: translateY(-5px);
        }
        
        .item-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .item-content {
            padding: 20px;
        }
        
        .item-title {
            font-size: 20px;
            margin-bottom: 10px;
        }
        
        .item-price {
            color: #c0392b;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        .item-desc {
            margin-bottom: 15px;
            color: #666;
        }
        
        .review-item {
            padding: 20px;
            text-align: center;
        }
        
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 15px;
            border: 3px solid #c0392b;
        }
        
        .stars {
            color: #ffd700;
            margin-bottom: 10px;
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

    <section class="hero">
        <h1>{{ config('app.name') }}</h1>
        <p>Tận hưởng những tách cà phê thơm ngon từ hạt cà phê chất lượng nhất</p>
        <a href="{{ route('menu') }}" class="btn">Xem thực đơn</a>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title">Thực đơn <span>của chúng tôi</span></h2>
            <div class="menu-container">
                @foreach($featuredItems as $item)
                <div class="menu-item">
                    <img src="{{ $item->image }}" alt="{{ $item->name }}" class="item-img">
                    <div class="item-content">
                        <h3 class="item-title">{{ $item->name }}</h3>
                        <p class="item-price">{{ number_format($item->price) }} VND</p>
                        <p class="item-desc">{{ $item->description }}</p>
                        <a href="{{ route('menu.item', $item->id) }}" class="btn">Chi tiết</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" style="background-color: #f1e5d9;">
        <div class="container">
            <h2 class="section-title">Sản phẩm <span>nổi bật</span></h2>
            <div class="products-container">
                @foreach($featuredProducts as $product)
                <div class="product-item">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="item-img">
                    <div class="item-content">
                        <h3 class="item-title">{{ $product->name }}</h3>
                        <p class="item-price">{{ number_format($product->price) }} VND</p>
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($product->rating))
                                    ★
                                @elseif($i - 0.5 <= $product->rating)
                                    ☆
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                        <a href="{{ route('products.show', $product->id) }}" class="btn">Xem chi tiết</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title">Khách hàng <span>nói gì về chúng tôi</span></h2>
            <div class="reviews-container">
                @foreach($reviews as $review)
                <div class="review-item">
                    <img src="{{ $review->avatar }}" alt="{{ $review->name }}" class="avatar">
                    <h3 class="item-title">{{ $review->name }}</h3>
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <p class="item-desc">{{ $review->comment }}</p>
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
</body>
</html>
