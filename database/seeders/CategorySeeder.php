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
                'name' => 'Hot Coffee',
                'description' => 'Delicious hot coffee drinks to warm you up',
                'image' => 'hot-coffee.jpg',
            ],
            [
                'name' => 'Cold Coffee',
                'description' => 'Refreshing cold coffee drinks for hot days',
                'image' => 'cold-coffee.jpg',
            ],
            [
                'name' => 'Pastries',
                'description' => 'Freshly baked pastries to complement your coffee',
                'image' => 'pastries.jpg',
            ],
            [
                'name' => 'Desserts',
                'description' => 'Sweet treats and desserts',
                'image' => 'desserts.jpg',
            ],
            [
                'name' => 'Tea',
                'description' => 'Various tea options for tea lovers',
                'image' => 'tea.jpg',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'image' => $category['image'],
            ]);
        }
    }
}
