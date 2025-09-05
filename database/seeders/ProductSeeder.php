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
        // Lấy id danh mục mới theo tên tiếng Việt
        $coffeeCat = Category::where('name', 'Đồ uống cà phê')->first();
        $teaCat = Category::where('name', 'Trà & Trà sữa')->first();
        $otherDrinkCat = Category::where('name', 'Đồ uống khác')->first();
        $dessertCat = Category::where('name', 'Bánh & Đồ ngọt')->first();
        $lightMealCat = Category::where('name', 'Đồ ăn nhẹ & ăn sáng')->first();
        $takeAwayCat = Category::where('name', 'Sản phẩm mang về')->first();

        // Nếu chưa migrate hoặc thiếu category thì dừng để tránh lỗi null
        if (!$coffeeCat) {
            $this->command?->warn('Chưa có categories mới. Hãy chạy CategorySeeder trước.');
            return;
        }

        // Xóa sản phẩm cũ (tùy chọn). Có thể dùng truncate nếu không cần giữ id.
        Product::query()->delete();

        $rand = fn($min, $max) => rand($min / 1000, $max / 1000) * 1000; // giá chẵn theo 1000

        $products = [
            // 1. ĐỒ UỐNG CÀ PHÊ
            ['name' => 'Cà phê phin đen nóng', 'cat' => $coffeeCat, 'price' => 20000, 'desc' => 'Cà phê rang xay pha phin truyền thống đậm hương.',],
            ['name' => 'Cà phê phin đen đá', 'cat' => $coffeeCat, 'price' => 22000, 'desc' => 'Cà phê phin đậm đà với đá mát lạnh.',],
            ['name' => 'Cà phê phin sữa nóng', 'cat' => $coffeeCat, 'price' => 23000, 'desc' => 'Cà phê phin hòa quyện sữa đặc béo.',],
            ['name' => 'Cà phê phin sữa đá', 'cat' => $coffeeCat, 'price' => 25000, 'desc' => 'Cà phê sữa đá Việt Nam kinh điển.',],
            ['name' => 'Espresso Single', 'cat' => $coffeeCat, 'price' => 25000, 'desc' => 'Shot espresso cô đặc, hương thơm mãnh liệt.',],
            ['name' => 'Espresso Double', 'cat' => $coffeeCat, 'price' => 35000, 'desc' => 'Double shot cho người thích mạnh.',],
            ['name' => 'Cappuccino', 'cat' => $coffeeCat, 'price' => 38000, 'desc' => 'Espresso + sữa nóng + foam cân đối.',],
            ['name' => 'Latte', 'cat' => $coffeeCat, 'price' => 39000, 'desc' => 'Espresso với nhiều sữa tạo vị dịu.',],
            ['name' => 'Mocha', 'cat' => $coffeeCat, 'price' => 42000, 'desc' => 'Kết hợp espresso, sô cô la và sữa.',],
            ['name' => 'Macchiato', 'cat' => $coffeeCat, 'price' => 36000, 'desc' => 'Espresso chấm nhẹ bọt sữa.',],
            ['name' => 'Americano', 'cat' => $coffeeCat, 'price' => 30000, 'desc' => 'Espresso pha loãng bằng nước nóng.',],
            ['name' => 'Cold Brew', 'cat' => $coffeeCat, 'price' => 45000, 'desc' => 'Ủ lạnh 18-24h vị thanh dịu ít chua.',],
            ['name' => 'Cà phê trứng', 'cat' => $coffeeCat, 'price' => 42000, 'desc' => 'Lớp kem trứng béo mịn đặc sản VN.',],
            ['name' => 'Cà phê cốt dừa', 'cat' => $coffeeCat, 'price' => 45000, 'desc' => 'Espresso hòa quyện cốt dừa béo thơm.',],
            ['name' => 'Bạc xỉu', 'cat' => $coffeeCat, 'price' => 28000, 'desc' => 'Sữa nhiều hơn cà phê, vị ngọt béo.',],
            ['name' => 'Sữa chua cà phê', 'cat' => $coffeeCat, 'price' => 42000, 'desc' => 'Kết hợp men sữa chua và espresso.',],

            // 2. TRÀ & TRÀ SỮA
            ['name' => 'Trà xanh', 'cat' => $teaCat, 'price' => 28000, 'desc' => 'Thanh mát, giàu chất chống oxy hóa.',],
            ['name' => 'Trà đen', 'cat' => $teaCat, 'price' => 28000, 'desc' => 'Hương đậm, hậu vị nhẹ chát.',],
            ['name' => 'Hồng trà', 'cat' => $teaCat, 'price' => 30000, 'desc' => 'Hương thơm mật đỏ dịu nhẹ.',],
            ['name' => 'Trà đào cam sả', 'cat' => $teaCat, 'price' => 38000, 'desc' => 'Trà + đào + cam + sả thơm mát.',],
            ['name' => 'Trà vải', 'cat' => $teaCat, 'price' => 36000, 'desc' => 'Hương vải tự nhiên ngọt thanh.',],
            ['name' => 'Trà tắc mật ong', 'cat' => $teaCat, 'price' => 34000, 'desc' => 'Kết hợp tắc tươi và mật ong.',],
            ['name' => 'Trà sữa trân châu', 'cat' => $teaCat, 'price' => 39000, 'desc' => 'Trà đen + sữa + trân châu dai.',],
            ['name' => 'Trà sữa matcha', 'cat' => $teaCat, 'price' => 42000, 'desc' => 'Matcha Nhật kết hợp sữa béo.',],
            ['name' => 'Trà sữa Oolong', 'cat' => $teaCat, 'price' => 41000, 'desc' => 'Oolong thơm nướng nhẹ.',],
            ['name' => 'Matcha latte', 'cat' => $teaCat, 'price' => 45000, 'desc' => 'Matcha + sữa tươi cân bằng.',],
            ['name' => 'Trà hoa cúc', 'cat' => $teaCat, 'price' => 30000, 'desc' => 'An thần nhẹ, hương dịu.',],
            ['name' => 'Trà hoa nhài', 'cat' => $teaCat, 'price' => 30000, 'desc' => 'Hương nhài thơm nhẹ tinh tế.',],
            ['name' => 'Trà bạc hà', 'cat' => $teaCat, 'price' => 32000, 'desc' => 'Mát lạnh sảng khoái.',],

            // 3. ĐỒ UỐNG KHÁC
            ['name' => 'Nước ép cam', 'cat' => $otherDrinkCat, 'price' => 35000, 'desc' => 'Cam tươi vắt nguyên chất.',],
            ['name' => 'Nước ép táo', 'cat' => $otherDrinkCat, 'price' => 36000, 'desc' => 'Táo ép lạnh giữ vitamin.',],
            ['name' => 'Nước ép dứa', 'cat' => $otherDrinkCat, 'price' => 34000, 'desc' => 'Thơm dịu, giàu bromelain.',],
            ['name' => 'Sinh tố bơ', 'cat' => $otherDrinkCat, 'price' => 45000, 'desc' => 'Bơ 034 béo mịn, ít đường.',],
            ['name' => 'Sinh tố xoài', 'cat' => $otherDrinkCat, 'price' => 42000, 'desc' => 'Xoài chín vàng thơm.',],
            ['name' => 'Smoothie yaourt dâu', 'cat' => $otherDrinkCat, 'price' => 48000, 'desc' => 'Yaourt + dâu + granola.',],
            ['name' => 'Soda Ý chanh bạc hà', 'cat' => $otherDrinkCat, 'price' => 42000, 'desc' => 'Ngọt nhẹ, sủi mát.',],
            ['name' => 'Soda Ý việt quất', 'cat' => $otherDrinkCat, 'price' => 43000, 'desc' => 'Hương việt quất đặc trưng.',],
            ['name' => 'Sữa tươi cacao nóng', 'cat' => $otherDrinkCat, 'price' => 38000, 'desc' => 'Sô cô la + sữa ấm.',],
            ['name' => 'Sữa đậu nành', 'cat' => $otherDrinkCat, 'price' => 22000, 'desc' => 'Nhà làm mỗi sáng.',],

            // 4. BÁNH & ĐỒ NGỌT
            ['name' => 'Tiramisu', 'cat' => $dessertCat, 'price' => 45000, 'desc' => 'Kem mascarpone + espresso.',],
            ['name' => 'Cheesecake New York', 'cat' => $dessertCat, 'price' => 48000, 'desc' => 'Béo mịn, đế quy bơ.',],
            ['name' => 'Red Velvet', 'cat' => $dessertCat, 'price' => 50000, 'desc' => 'Bột cacao nhẹ màu đỏ đặc trưng.',],
            ['name' => 'Mousse chanh dây', 'cat' => $dessertCat, 'price' => 46000, 'desc' => 'Chua ngọt thanh.',],
            ['name' => 'Croissant bơ', 'cat' => $dessertCat, 'price' => 30000, 'desc' => 'Lớp bánh nhiều tầng.',],
            ['name' => 'Pain au chocolat', 'cat' => $dessertCat, 'price' => 34000, 'desc' => 'Nhân chocolate tan chảy.',],
            ['name' => 'Cookie chip', 'cat' => $dessertCat, 'price' => 25000, 'desc' => 'Bánh quy bơ + chip sô cô la.',],
            ['name' => 'Donut đường', 'cat' => $dessertCat, 'price' => 20000, 'desc' => 'Chiên vàng phủ đường.',],

            // 5. ĐỒ ĂN NHẸ & ĂN SÁNG
            ['name' => 'Sandwich gà xé', 'cat' => $lightMealCat, 'price' => 42000, 'desc' => 'Gà xé + mayonnaise.',],
            ['name' => 'Mì ý sốt bò bằm', 'cat' => $lightMealCat, 'price' => 55000, 'desc' => 'Sốt cà chua cô đặc.',],
            ['name' => 'Salad rau củ', 'cat' => $lightMealCat, 'price' => 45000, 'desc' => 'Rau tươi + sốt dầu giấm.',],
            ['name' => 'Xúc xích + trứng ốp la', 'cat' => $lightMealCat, 'price' => 48000, 'desc' => 'Giàu đạm cho buổi sáng.',],
            ['name' => 'Bánh bao nhân thịt', 'cat' => $lightMealCat, 'price' => 25000, 'desc' => 'Nhân thịt trứng cút.',],
            ['name' => 'Ngũ cốc yaourt trái cây', 'cat' => $lightMealCat, 'price' => 49000, 'desc' => 'Yaourt + granola + trái cây.',],

            // 6. SẢN PHẨM MANG VỀ
            ['name' => 'Cà phê hạt rang 250g', 'cat' => $takeAwayCat, 'price' => 120000, 'desc' => 'Blend arabica/robusta cân bằng.',],
            ['name' => 'Bột cà phê pha phin 250g', 'cat' => $takeAwayCat, 'price' => 110000, 'desc' => 'Xay vừa cho phin VN.',],
            ['name' => 'Trà Oolong khô 100g', 'cat' => $takeAwayCat, 'price' => 90000, 'desc' => 'Lên men bán phần, hương mật.',],
            ['name' => 'Trà hoa cúc sấy 50g', 'cat' => $takeAwayCat, 'price' => 60000, 'desc' => 'Sấy nhẹ giữ màu vàng.',],
            ['name' => 'Syrup dâu homemade 300ml', 'cat' => $takeAwayCat, 'price' => 70000, 'desc' => 'Nấu từ dâu tươi, ít đường.',],
            ['name' => 'Cold brew chai 250ml', 'cat' => $takeAwayCat, 'price' => 55000, 'desc' => 'Ủ lạnh đóng chai tiện lợi.',],
            ['name' => 'Latte đóng chai 250ml', 'cat' => $takeAwayCat, 'price' => 60000, 'desc' => 'Sữa + espresso cân bằng vị.',],
        ];

        foreach ($products as $p) {
            Product::create([
                'name' => $p['name'],
                'description' => $p['desc'],
                'price' => $p['price'],
                'image' => Str::slug($p['name']).'.jpg',
                'category_id' => $p['cat']->id,
                'stock' => rand(20, 120),
                'featured' => rand(0, 1) === 1,
                'rating' => rand(40, 50) / 10,
                'available' => true,
                'specifications' => 'Auto generated item for menu seed.',
            ]);
        }
    }
}
