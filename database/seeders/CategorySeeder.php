<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Đồ uống cà phê',
                'description' => 'Các loại cà phê pha phin, espresso, latte, cappuccino, cold brew...',
                'image' => 'coffee.jpg',
            ],
            [
                'name' => 'Trà & Trà sữa',
                'description' => 'Trà hoa quả, trà sữa, matcha latte, trà thảo mộc...',
                'image' => 'tea-milk-tea.jpg',
            ],
            [
                'name' => 'Đồ uống khác',
                'description' => 'Nước ép, sinh tố, smoothie, soda Ý, sữa...',
                'image' => 'other-drinks.jpg',
            ],
            [
                'name' => 'Bánh & Đồ ngọt',
                'description' => 'Bánh ngọt, bánh Âu, mousse, tiramisu, cookies...',
                'image' => 'desserts.jpg',
            ],
            [
                'name' => 'Đồ ăn nhẹ & ăn sáng',
                'description' => 'Sandwich, mì ý, salad, bánh bao, ngũ cốc...',
                'image' => 'light-meals.jpg',
            ],
            [
                'name' => 'Sản phẩm mang về',
                'description' => 'Cà phê hạt, trà khô, syrup, cold brew đóng chai...',
                'image' => 'takeaway.jpg',
            ],
        ];

        foreach ($categories as $category) {
            // Kiểm tra xem danh mục đã tồn tại chưa (dựa trên slug)
            $slug = Str::slug($category['name']);
            if (!Category::where('slug', $slug)->exists()) {
                Category::create([
                    'name' => $category['name'],
                    'slug' => $slug,
                    'description' => $category['description'],
                    'image' => $category['image'],
                ]);
            }
        }
    }
}
