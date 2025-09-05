<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::select('id','name','slug','description')->orderBy('name')->get();
        return CategoryResource::collection($categories)->additional([
            'meta' => [
                'total' => $categories->count(),
            ]
        ]);
    }
}
