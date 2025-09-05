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
        
    .category-block {margin-bottom:50px;}
    .category-title {font-size:28px;margin:10px 0 25px;color:#6f4e37;position:relative;}
    .category-title:after {content:"";position:absolute;left:0;bottom:-8px;width:80px;height:4px;background:#c0392b;border-radius:2px;}
    .items-flex {display:flex;flex-wrap:wrap;gap:22px;}
    .menu-item {flex:1 1 calc(25% - 22px);min-width:230px;max-width:260px;background:#fff;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.06);display:flex;flex-direction:column;overflow:hidden;transition:.25s}
    .menu-item:hover {transform:translateY(-6px);box-shadow:0 10px 22px rgba(0,0,0,0.12);}
    .img-wrap {height:140px;background:#eee;display:flex;align-items:center;justify-content:center;color:#888;font-size:13px;letter-spacing:.5px;font-weight:600;}
    .menu-img {width:100%;height:100%;object-fit:cover;display:block;}
    .menu-content {padding:15px 16px 18px;display:flex;flex-direction:column;gap:8px;flex:1;}
    .menu-title {font-size:16px;line-height:1.3;font-weight:600;color:#333;margin:0;min-height:38px;}
    .menu-price {color:#c0392b;font-weight:700;font-size:15px;}
    .menu-desc {color:#666;font-size:13px;line-height:1.4;height:54px;overflow:hidden;}
    .btn-small {align-self:flex-start;margin-top:auto;font-size:12px;padding:8px 14px;}
    @media (max-width:900px){.menu-item{flex:1 1 calc(33.33% - 22px);} }
    @media (max-width:680px){.menu-item{flex:1 1 calc(50% - 22px);} .category-title{font-size:22px;} }
    @media (max-width:460px){.menu-item{flex:1 1 100%;} }
        
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

    @php
        // Chấp nhận controller cũ truyền $menuItems hoặc mới truyền $products
        $allItems = ($menuItems ?? null) ?: ($products ?? collect());
        // Group theo category name để hiển thị thành khối
        $grouped = $allItems instanceof \Illuminate\Support\Collection ? $allItems->groupBy(fn($i)=>$i->category->name ?? 'Khác') : collect($allItems)->groupBy(fn($i)=>$i->category->name ?? 'Khác');
        // Sắp xếp nhóm theo thứ tự ưu tiên menu mới
        $order = [
            'Đồ uống cà phê'=>1,
            'Trà & Trà sữa'=>2,
            'Đồ uống khác'=>3,
            'Bánh & Đồ ngọt'=>4,
            'Đồ ăn nhẹ & ăn sáng'=>5,
            'Sản phẩm mang về'=>6,
        ];
        $grouped = $grouped->sortBy(fn($items,$k)=>$order[$k] ?? 99);
    @endphp
    <section class="section">
        <div class="container">
            <!-- Thanh lọc & tìm kiếm -->
            <div class="filter-toolbar" style="position:sticky;top:0;z-index:40;background:#f5f5f5;padding:12px 10px 18px;margin:-30px 0 25px;border-bottom:1px solid #e1d7cf;">
                <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:10px;">
                    <button class="cat-filter-btn active" data-cat="all">Tất cả</button>
                    <button class="cat-filter-btn" data-cat="do-uong-ca-phe">Đồ uống cà phê</button>
                    <button class="cat-filter-btn" data-cat="tra-tra-sua">Trà & Trà sữa</button>
                    <button class="cat-filter-btn" data-cat="do-uong-khac">Đồ uống khác</button>
                    <button class="cat-filter-btn" data-cat="banh-do-ngot">Bánh & Đồ ngọt</button>
                    <button class="cat-filter-btn" data-cat="do-an-nhe-an-sang">Đồ ăn nhẹ & ăn sáng</button>
                    <button class="cat-filter-btn" data-cat="san-pham-mang-ve">Sản phẩm mang về</button>
                </div>
                <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
                    <input id="menu-search" type="text" placeholder="Tìm kiếm món..." style="flex:1;min-width:240px;padding:10px 14px;border:1px solid #c9b8ab;border-radius:6px;outline:none;font-size:14px;">
                    <span id="result-count" style="font-size:13px;color:#6f4e37;font-weight:600;">&nbsp;</span>
                </div>
                <style>
                    .cat-filter-btn{background:#efe4da;border:1px solid #d7c5b8;padding:8px 14px;font-size:13px;border-radius:20px;cursor:pointer;font-weight:600;color:#6f4e37;transition:.2s}
                    .cat-filter-btn:hover{background:#6f4e37;color:#fff}
                    .cat-filter-btn.active{background:#c0392b;border-color:#c0392b;color:#fff;}
                </style>
            </div>
            @foreach($grouped as $catName => $items)
                @php $groupSlug = Str::slug($catName); @endphp
                <div class="category-block" id="cat-{{ $groupSlug }}" data-group="{{ $groupSlug }}">
                    <h2 class="category-title" data-title="{{ $catName }}">{{ $catName }}</h2>
                    <div class="items-flex">
                        @foreach($items as $item)
                            <div class="menu-item" data-category="{{ $item->category->slug ?? $groupSlug }}" data-name="{{ Str::lower($item->name) }}" data-desc="{{ Str::lower($item->description) }}">
                                <div class="img-wrap">
                                    @php $img = trim($item->image ?? ''); @endphp
                                    @if($img && file_exists(public_path($img)))
                                        <img class="menu-img" src="/{{ ltrim($img,'/') }}" alt="{{ $item->name }}">
                                    @else
                                        <span>ẢNH SẼ CẬP NHẬT</span>
                                    @endif
                                </div>
                                <div class="menu-content">
                                    <h3 class="menu-title">{{ $item->name }}</h3>
                                    <div class="menu-price">{{ number_format($item->price) }} VND</div>
                                    <p class="menu-desc">{{ $item->description }}</p>
                                    @if(Route::has('menu.item'))
                                        <a href="{{ route('menu.item', $item->id) }}" class="btn btn-small">Chi tiết</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded',()=>{
            const buttons = document.querySelectorAll('.cat-filter-btn');
            const searchInput = document.getElementById('menu-search');
            const resultCount = document.getElementById('result-count');
            const items = Array.from(document.querySelectorAll('.menu-item'));
            const categoryBlocks = Array.from(document.querySelectorAll('.category-block'));

            let activeCat = 'all';

            function normalize(v){return v.normalize('NFD').replace(/\p{Diacritic}/gu,'').toLowerCase();}

            function apply(){
                const qRaw = searchInput.value.trim();
                const q = normalize(qRaw);
                let visible = 0;
                items.forEach(it=>{
                    const cat = it.dataset.category;
                    const text = normalize((it.dataset.name||'')+' '+(it.dataset.desc||''));
                    const matchCat = (activeCat==='all') || (cat===activeCat);
                    const matchSearch = !q || text.includes(q);
                    if(matchCat && matchSearch){
                        it.style.display='flex';
                        visible++;
                    } else {
                        it.style.display='none';
                    }
                });
                // Ẩn nhóm rỗng
                categoryBlocks.forEach(block=>{
                    const anyVisible = block.querySelector('.menu-item[style*="display: flex"]') || block.querySelector('.menu-item:not([style])');
                    if(block.querySelectorAll('.menu-item').length>0){
                        const hasVisible = Array.from(block.querySelectorAll('.menu-item')).some(el=>el.style.display!=="none");
                        block.style.display = hasVisible? 'block':'none';
                    }
                });
                resultCount.textContent = q || activeCat!=='all' ? `${visible} món` : '';
            }

            buttons.forEach(btn=>btn.addEventListener('click',()=>{
                buttons.forEach(b=>b.classList.remove('active'));
                btn.classList.add('active');
                activeCat = btn.dataset.cat;
                apply();
                // Scroll smooth tới đầu danh sách
                window.scrollTo({top: document.querySelector('.filter-toolbar').offsetTop - 10, behavior:'smooth'});
            }));
            searchInput.addEventListener('input',()=>apply());
        });
    </script>

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
