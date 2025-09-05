<h1 align="center">CafeShop Platform</h1>
<p align="center">Backend API (Laravel 12 + Sanctum) & Frontend SPA (Vue 3 + Vite)</p>

## 🇻🇳 Giới thiệu
CafeShop là ứng dụng quản lý & hiển thị thực đơn quán cà phê với:
- API chuẩn REST (version: v1)
- Xác thực token qua Laravel Sanctum
- Phân tách Frontend (Vue 3 SPA) & Backend
- Dữ liệu seed tiếng Việt: danh mục & sản phẩm đa dạng
- Tìm kiếm, lọc theo danh mục, phân trang

## 🗂 Cấu trúc chính
```
CafeShop/
	app/              -> Mã nguồn Laravel (Models, Controllers, Resources)
	routes/api.php    -> Định nghĩa API v1
	config/cors.php   -> Cấu hình CORS cho frontend
	frontend/         -> Vue 3 SPA (Vite)
	database/seeders/ -> CategorySeeder, ProductSeeder
```

## 🚀 Khởi chạy nhanh (Development)
Yêu cầu: PHP ^8.2, Composer, Node.js (>=18), SQLite hoặc MySQL (đang dùng SQLite mặc định).

### 1. Backend
```bash
composer install
cp .env.example .env    # nếu chưa có
php artisan key:generate
php artisan migrate --seed
php artisan serve       # http://127.0.0.1:8000
```

### 2. Frontend
```bash
cd frontend
npm install
npm run dev             # http://localhost:5173
```
Frontend proxy tự động chuyển yêu cầu `/api` tới `http://127.0.0.1:8000` (cấu hình trong `frontend/vite.config.js`).

## 🔐 Xác thực
Endpoint đăng nhập:
```
POST /api/v1/auth/login
Body: { "email": "test@example.com", "password": "password" }
```
Phản hồi thành công trả về token Bearer. Lưu token (localStorage) và gửi kèm:
```
Authorization: Bearer <token>
```
Đăng xuất: `POST /api/v1/auth/logout` (cần kèm token).

## 📡 API chính (v1)
| Phương thức | Endpoint | Mô tả |
|-------------|----------|-------|
| GET | /api/v1/categories | Danh sách danh mục |
| GET | /api/v1/products | Danh sách sản phẩm (filter: category, search, page) |
| GET | /api/v1/products/{id} | Chi tiết sản phẩm |
| POST | /api/v1/auth/login | Đăng nhập lấy token |
| POST | /api/v1/auth/logout | Hủy token |

Ví dụ lấy sản phẩm với lọc:
```
/api/v1/products?category=cafe-viet&search=sua&page=2
```

## 🧱 Chuẩn JSON (Resources)
Mẫu `ProductResource`:
```json
{
	"data": {
		"id": 12,
		"name": "Cà phê sữa đá",
		"slug": "ca-phe-sua-da",
		"price": 32000,
		"stock": 50,
		"category": { "id": 1, "name": "Cà phê", "slug": "cafe" }
	},
	"meta": { }
}
```

Phân trang (list):
```json
{
	"data": [ ... ],
	"meta": {
		"current_page": 1,
		"last_page": 8,
		"per_page": 15,
		"total": 120
	}
}
```

## 🧪 Lệnh hữu ích
```bash
php artisan route:list --path=api
php artisan migrate:fresh --seed
php artisan tinker
```

## 🎯 Roadmap (dự kiến)
- [ ] Giỏ hàng & đơn hàng (API)
- [ ] Phân quyền nâng cao (admin/staff/customer)
- [ ] Bộ lọc nâng cao (giá, đánh giá)
- [ ] Cache Redis cho danh mục/sản phẩm phổ biến
- [ ] Unit test API (Pest / PHPUnit)
- [ ] Triển khai Docker compose

## 🌐 Triển khai production (gợi ý)
1. Build frontend: `cd frontend && npm run build` (tạo `dist/`)
2. Serve frontend tĩnh (Nginx) và proxy `/api` đến PHP-FPM
3. Thiết lập biến môi trường APP_ENV=production, APP_KEY, cache config:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🤝 Đóng góp
Tạo branch mới: `feat/<ten-tinh-nang>` rồi mở Pull Request.

## 📄 License
MIT.

---
English brief below.

## 🇬🇧 Overview (Brief)
CafeShop: Laravel 12 REST API + Vue 3 SPA (menu, search, category filters, auth via Sanctum). Seeded Vietnamese coffee shop dataset. Frontend consumes `/api/v1/*` endpoints via Vite proxy.

Key commands:
```bash
composer install && php artisan migrate --seed && php artisan serve
cd frontend && npm install && npm run dev
```

Enjoy building! ☕
