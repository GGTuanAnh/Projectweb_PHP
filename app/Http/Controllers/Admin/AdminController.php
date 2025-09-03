<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Constructor với middleware
     */
    public function __construct()
    {
        // Middleware sẽ được cài đặt sau khi Kernel.php đã được tìm thấy
    }
    
    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $latestProducts = Product::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('productsCount', 'categoriesCount', 'latestProducts'));
    }
    
    /**
     * Quản lý sản phẩm
     */
    public function products()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }
    
    /**
     * Quản lý danh mục
     */
    public function categories()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }
    
    /**
     * Quản lý đơn hàng
     */
    public function orders()
    {
        return view('admin.orders.index');
    }
}
