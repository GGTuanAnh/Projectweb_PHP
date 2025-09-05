<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category:id,name,slug');

        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->get('category'));
            });
        }

        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name','like',"%$search%")
                  ->orWhere('description','like',"%$search%");
            });
        }

        $perPage = min(50, (int) $request->get('per_page', 20));
        $products = $query->select('id','name','price','image','category_id','description','rating')
                          ->paginate($perPage);

        return ProductResource::collection($products)->additional([
            'meta' => [
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
            ],
        ]);
    }

    public function show(Product $product)
    {
    $product->load('category:id,name,slug');
    return new ProductResource($product);
    }
}
