<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the products
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::with('category');
        
        // Tìm kiếm theo tên
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }
        
        // Lọc theo danh mục
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        // Sắp xếp
        $sortField = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);
        
        $products = $query->paginate(10);
        $categories = Category::all();
        
        return view('admin.products.index', compact('products', 'categories'));
    }
    
    /**
     * Show the form for creating a new product
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
    
    /**
     * Store a newly created product
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'available' => 'boolean'
        ]);
        
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->available = $request->has('available');
        
        // Xử lý hình ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $filename);
            $product->image = 'images/products/' . $filename;
        }
        
        $product->save();
        
        return redirect()->route('admin.products')
            ->with('success', 'Sản phẩm đã được tạo thành công!');
    }
    
    /**
     * Show the form for editing the specified product
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        
        return view('admin.products.edit', compact('product', 'categories'));
    }
    
    /**
     * Update the specified product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'available' => 'boolean'
        ]);
        
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->available = $request->has('available');
        
        // Xử lý hình ảnh
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $filename);
            $product->image = 'images/products/' . $filename;
        }
        
        $product->save();
        
        return redirect()->route('admin.products')
            ->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }
    
    /**
     * Remove the specified product
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Xóa hình ảnh sản phẩm nếu có
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        
        $product->delete();
        
        return redirect()->route('admin.products')
            ->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
