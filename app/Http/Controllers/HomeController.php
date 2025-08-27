<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lấy danh mục và sản phẩm từ database
        $categories = \App\Models\Category::all();
        
        // Lấy các sản phẩm nổi bật (featured)
        $featuredItems = \App\Models\Product::where('featured', true)
            ->orderBy('rating', 'desc')
            ->take(6)
            ->get();
            
        // Lấy sản phẩm có rating cao
        $featuredProducts = \App\Models\Product::orderBy('rating', 'desc')
            ->take(4)
            ->get();
        
        // Giữ lại reviews mẫu vì chúng ta chưa có bảng reviews
        $reviews = [
            (object)[
                'id' => 1,
                'name' => 'Nguyễn Văn A',
                'avatar' => 'images/review-1.jpg',
                'comment' => 'Cà phê ngon, không gian thoáng đãng, nhân viên phục vụ nhiệt tình.',
                'rating' => 5
            ],
            (object)[
                'id' => 2,
                'name' => 'Trần Thị B',
                'avatar' => 'images/review-2.jpg',
                'comment' => 'Đồ uống chất lượng, giá cả phải chăng.',
                'rating' => 4
            ],
        ];
        
        return view('home', compact('categories', 'featuredItems', 'featuredProducts', 'reviews'));
    }
}
