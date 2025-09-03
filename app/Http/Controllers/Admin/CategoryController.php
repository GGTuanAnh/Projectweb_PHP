<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withCount('products')
                            ->orderBy('name')
                            ->paginate(10);
        
        return view('admin.categories.index', compact('categories'));
    }
    
    /**
     * Show the form for creating a new category
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }
    
    /**
     * Store a newly created category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string'
        ]);
        
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->save();
        
        return redirect()->route('admin.categories')
            ->with('success', 'Danh mục đã được tạo thành công!');
    }
    
    /**
     * Show the form for editing the specified category
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }
    
    /**
     * Update the specified category
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string'
        ]);
        
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->save();
        
        return redirect()->route('admin.categories')
            ->with('success', 'Danh mục đã được cập nhật thành công!');
    }
    
    /**
     * Remove the specified category
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Kiểm tra xem danh mục có sản phẩm không
        if ($category->products()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Không thể xóa danh mục này vì có sản phẩm thuộc danh mục này!');
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories')
            ->with('success', 'Danh mục đã được xóa thành công!');
    }
}
