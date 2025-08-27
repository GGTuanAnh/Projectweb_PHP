<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị trang danh sách sản phẩm
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')
            ->where('available', true)
            ->orderBy('rating', 'desc')
            ->paginate(12);
        
        return view('products', compact('categories', 'products'));
    }
    
    /**
     * Hiển thị chi tiết sản phẩm
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();
        
        return view('product-detail', compact('product', 'relatedProducts'));
    }
}
