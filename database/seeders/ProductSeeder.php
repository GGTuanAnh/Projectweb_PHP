<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy ID của các categories đã tạo
        $hotCoffeeId = Category::where('name', 'Hot Coffee')->first()->id;
        $coldCoffeeId = Category::where('name', 'Cold Coffee')->first()->id;
        $pastriesId = Category::where('name', 'Pastries')->first()->id;
        $dessertsId = Category::where('name', 'Desserts')->first()->id;
        $teaId = Category::where('name', 'Tea')->first()->id;

        // Danh sách sản phẩm
        $products = [
            // Hot Coffee
            [
                'name' => 'Espresso',
                'description' => 'Một ly cà phê espresso đậm đà, đắng nhẹ, thơm nồng.',
                'price' => 25000,
                'image' => 'espresso.jpg',
                'category_id' => $hotCoffeeId,
                'stock' => 100,
                'featured' => true,
                'rating' => 4.5,
                'available' => true,
                'specifications' => 'Cà phê nguyên chất, không đường, phù hợp với người thích vị đắng.',
            ],
            [
                'name' => 'Cappuccino',
                'description' => 'Sự kết hợp hoàn hảo giữa espresso, sữa nóng và bọt sữa.',
                'price' => 35000,
                'image' => 'cappuccino.jpg',
                'category_id' => $hotCoffeeId,
                'stock' => 100,
                'featured' => true,
                'rating' => 4.7,
                'available' => true,
                'specifications' => 'Tỷ lệ: 1/3 espresso, 1/3 sữa nóng, 1/3 bọt sữa.',
            ],
            [
                'name' => 'Latte',
                'description' => 'Cà phê espresso kết hợp với lượng sữa nóng nhiều hơn và ít bọt sữa.',
                'price' => 32000,
                'image' => 'latte.jpg',
                'category_id' => $hotCoffeeId,
                'stock' => 100,
                'featured' => false,
                'rating' => 4.6,
                'available' => true,
                'specifications' => 'Tỷ lệ: 1/3 espresso, 2/3 sữa nóng, lớp bọt sữa mỏng.',
            ],
            [
                'name' => 'Americano',
                'description' => 'Cà phê espresso pha loãng với nước nóng, tạo vị nhẹ hơn.',
                'price' => 28000,
                'image' => 'americano.jpg',
                'category_id' => $hotCoffeeId,
                'stock' => 100,
                'featured' => false,
                'rating' => 4.3,
                'available' => true,
                'specifications' => 'Tỷ lệ: 1/3 espresso, 2/3 nước nóng.',
            ],
            
            // Cold Coffee
            [
                'name' => 'Iced Coffee',
                'description' => 'Cà phê đen đá truyền thống, đậm đà và mát lạnh.',
                'price' => 25000,
                'image' => 'iced-coffee.jpg',
                'category_id' => $coldCoffeeId,
                'stock' => 100,
                'featured' => true,
                'rating' => 4.4,
                'available' => true,
                'specifications' => 'Cà phê pha phin truyền thống, đá viên, có thể thêm đường.',
            ],
            [
                'name' => 'Cold Brew',
                'description' => 'Cà phê ngâm lạnh trong 24 giờ, vị nhẹ nhàng, không đắng.',
                'price' => 40000,
                'image' => 'cold-brew.jpg',
                'category_id' => $coldCoffeeId,
                'stock' => 80,
                'featured' => true,
                'rating' => 4.8,
                'available' => true,
                'specifications' => 'Ủ lạnh 24 giờ, không chua, không đắng, vị ngọt tự nhiên.',
            ],
            [
                'name' => 'Mocha Frappuccino',
                'description' => 'Đồ uống đá xay với cà phê, sữa, chocolate và kem tươi.',
                'price' => 45000,
                'image' => 'mocha-frappuccino.jpg',
                'category_id' => $coldCoffeeId,
                'stock' => 100,
                'featured' => false,
                'rating' => 4.6,
                'available' => true,
                'specifications' => 'Cà phê, sữa, chocolate, đường, đá xay nhuyễn, kem tươi phủ trên cùng.',
            ],
            
            // Pastries
            [
                'name' => 'Croissant',
                'description' => 'Bánh sừng bò truyền thống của Pháp, giòn bên ngoài, mềm bên trong.',
                'price' => 22000,
                'image' => 'croissant.jpg',
                'category_id' => $pastriesId,
                'stock' => 50,
                'featured' => true,
                'rating' => 4.7,
                'available' => true,
                'specifications' => 'Làm từ bơ Pháp, làm tươi mỗi ngày.',
            ],
            [
                'name' => 'Pain au Chocolat',
                'description' => 'Bánh sừng bò nhân chocolate, ngọt ngào và thơm béo.',
                'price' => 25000,
                'image' => 'pain-au-chocolat.jpg',
                'category_id' => $pastriesId,
                'stock' => 40,
                'featured' => false,
                'rating' => 4.6,
                'available' => true,
                'specifications' => 'Nhân chocolate Bỉ, làm tươi mỗi ngày.',
            ],
            
            // Desserts
            [
                'name' => 'Tiramisu',
                'description' => 'Bánh tiramisu truyền thống Ý với lớp bánh mềm thấm cà phê và kem mascarpone.',
                'price' => 38000,
                'image' => 'tiramisu.jpg',
                'category_id' => $dessertsId,
                'stock' => 30,
                'featured' => true,
                'rating' => 4.9,
                'available' => true,
                'specifications' => 'Bánh gato thấm cà phê espresso, kem mascarpone, rượu marsala, bột cacao.',
            ],
            [
                'name' => 'Cheesecake',
                'description' => 'Bánh phô mai mềm mịn, đế bánh giòn từ bánh quy bơ.',
                'price' => 35000,
                'image' => 'cheesecake.jpg',
                'category_id' => $dessertsId,
                'stock' => 25,
                'featured' => true,
                'rating' => 4.7,
                'available' => true,
                'specifications' => 'Cream cheese, đường, trứng, vani, đế bánh quy bơ.',
            ],
            
            // Tea
            [
                'name' => 'Green Tea',
                'description' => 'Trà xanh nhật bản, thanh mát và giàu chất chống oxy hóa.',
                'price' => 28000,
                'image' => 'green-tea.jpg',
                'category_id' => $teaId,
                'stock' => 100,
                'featured' => true,
                'rating' => 4.5,
                'available' => true,
                'specifications' => 'Lá trà xanh Nhật Bản, có thể uống nóng hoặc đá.',
            ],
            [
                'name' => 'Fruit Tea',
                'description' => 'Trà trái cây tổng hợp, ngọt thanh với hương vị tự nhiên.',
                'price' => 32000,
                'image' => 'fruit-tea.jpg',
                'category_id' => $teaId,
                'stock' => 80,
                'featured' => false,
                'rating' => 4.4,
                'available' => true,
                'specifications' => 'Trà đen, hoa quả tươi (dâu, cam, chanh), đường.',
            ],
        ];

        // Tạo dữ liệu cho bảng products
        foreach ($products as $product) {
            // Kiểm tra xem sản phẩm đã tồn tại chưa
            if (!Product::where('name', $product['name'])->exists()) {
                Product::create([
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'category_id' => $product['category_id'],
                    'stock' => $product['stock'],
                    'featured' => $product['featured'],
                    'rating' => $product['rating'],
                    'available' => $product['available'],
                    'specifications' => $product['specifications'],
                ]);
            }
        }
    }
}
