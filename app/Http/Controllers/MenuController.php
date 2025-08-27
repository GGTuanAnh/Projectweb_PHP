<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display the menu page
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lấy tất cả danh mục từ database
        $categories = Category::all();
        
        // Lấy tất cả sản phẩm đã phân loại theo danh mục
        $menuItems = Product::with('category')
            ->where('available', true)
            ->orderBy('category_id')
            ->get();
        
        return view('menu', compact('categories', 'menuItems'));
    }
    
    /**
     * Show the specified menu item.
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Lấy thông tin sản phẩm theo ID
        $menuItem = Product::with('category')->findOrFail($id);
        
        // Lấy các sản phẩm liên quan (cùng danh mục)
        $relatedItems = Product::where('category_id', $menuItem->category_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();
        
        return view('menu-item', compact('menuItem', 'relatedItems'));
    }
}
