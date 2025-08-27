@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Sản phẩm cà phê</h1>
    
    <div class="row">
        <!-- Sidebar for categories -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Danh mục</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('products') }}" class="list-group-item list-group-item-action {{ !request()->has('category') ? 'active' : '' }}">
                        Tất cả sản phẩm
                    </a>
                    @foreach($categories as $category)
                    <a href="{{ route('products', ['category' => $category->id]) }}" class="list-group-item list-group-item-action {{ request('category') == $category->id ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Products grid -->
        <div class="col-md-9">
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-truncate">{{ $product->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">{{ number_format($product->price) }} VND</span>
                                <div>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $product->rating)
                                            <span class="text-warning">★</span>
                                        @else
                                            <span class="text-muted">★</span>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary w-100">Chi tiết</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
