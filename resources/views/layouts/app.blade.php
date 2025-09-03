<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Quán Cafe Ngon</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        
        .dropdown-menu {
            background-color: #6f4e37;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            padding: 0.5rem 0;
        }
        
        .dropdown-item {
            color: white;
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
        }
        
        .dropdown-item:hover, .dropdown-item:focus {
            background-color: #8b6b4c;
            color: #ffd700;
        }
        
        .nav-item.dropdown {
            position: relative;
        }
        
        .hero {
            background-image: url('/images/cafe-hero.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 150px 0;
            position: relative;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .hero-content {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        
        .btn {
            display: inline-block;
            background-color: #ffd700;
            color: #333;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s;
        }
        
        .btn:hover {
            background-color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            font-size: 2.5rem;
            position: relative;
        }
        
        .section-title span {
            color: #6f4e37;
        }
        
        .menu-container, .products-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .menu-item, .product-item {
            width: calc(33.33% - 20px);
            margin-bottom: 40px;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .menu-item:hover, .product-item:hover {
            transform: translateY(-10px);
        }
        
        .item-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .item-content {
            padding: 20px;
        }
        
        .item-title {
            margin-bottom: 10px;
            font-size: 1.5rem;
            color: #6f4e37;
        }
        
        .item-price {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
        
        .item-desc {
            color: #777;
            margin-bottom: 20px;
        }
        
        .stars {
            color: gold;
            margin-bottom: 15px;
        }
        
        footer {
            background-color: #333;
            color: white;
            padding: 50px 0;
            text-align: center;
        }
        
        .footer-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        .footer-section {
            width: calc(33.33% - 20px);
        }
        
        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s;
        }
        
        .social-links a:hover {
            color: #ffd700;
        }
        
        .copyright {
            margin-top: 50px;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
        }
        
        @media (max-width: 768px) {
            .menu-item, .product-item, .footer-section {
                width: 100%;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            nav ul {
                flex-direction: column;
                align-items: center;
            }
            
            nav ul li {
                margin: 10px 0;
            }
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
                    <li><a href="{{ route('products') }}">Sản phẩm</a></li>
                    <li><a href="{{ route('about') }}">Giới thiệu</a></li>
                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                    @guest
                        <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                        <li><a href="{{ route('register') }}">Đăng ký</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                @if(Auth::user()->isAdminOrStaff())
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Quản trị</a></li>
                                @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </header>
    
    @yield('content')
    
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-section">
                    <h3>Liên hệ</h3>
                    <p>Email: info@cafeshop.com</p>
                    <p>Điện thoại: 0123 456 789</p>
                    <p>Địa chỉ: 123 Đường Cafe, Quận 1, TP HCM</p>
                </div>
                <div class="footer-section">
                    <h3>Giờ mở cửa</h3>
                    <p>Thứ Hai - Thứ Sáu: 7h - 22h</p>
                    <p>Thứ Bảy - Chủ Nhật: 8h - 23h</p>
                </div>
                <div class="footer-section">
                    <h3>Theo dõi chúng tôi</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; {{ date('Y') }} CafeShop. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    
    @yield('scripts')
</body>
</html>
