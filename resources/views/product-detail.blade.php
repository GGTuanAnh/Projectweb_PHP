@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products') }}">Sản phẩm</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products', ['category' => $product->category->id]) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-5">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
        </div>
        
        <!-- Product Info -->
        <div class="col-md-7">
            <h1 class="mb-3">{{ $product->name }}</h1>
            
            <div class="d-flex mb-3">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $product->rating)
                        <span class="text-warning h4">★</span>
                    @else
                        <span class="text-muted h4">★</span>
                    @endif
                @endfor
                <span class="ms-2 text-muted">({{ $product->rating }})</span>
            </div>
            
            <h3 class="text-primary mb-4">{{ number_format($product->price) }} VND</h3>
            
            <p class="mb-4">{{ $product->description }}</p>
            
            @if($product->specifications)
            <div class="mb-4">
                <h4>Thông tin chi tiết</h4>
                <p>{{ $product->specifications }}</p>
            </div>
            @endif
            
            <div class="d-flex align-items-center mb-4">
                <div class="input-group me-3" style="width: 130px;">
                    <button class="btn btn-outline-secondary" type="button" id="decrease">-</button>
                    <input type="text" class="form-control text-center" value="1" id="quantity">
                    <button class="btn btn-outline-secondary" type="button" id="increase">+</button>
                </div>
                <button class="btn btn-primary">Thêm vào giỏ hàng</button>
            </div>
            
            <div class="mb-3">
                <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                    {{ $product->stock > 0 ? 'Còn hàng' : 'Hết hàng' }}
                </span>
                <span class="badge bg-secondary ms-2">Danh mục: {{ $product->category->name }}</span>
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
    <div class="mt-5">
        <h3 class="mb-4">Sản phẩm liên quan</h3>
        <div class="row">
            @foreach($relatedProducts as $related)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ asset($related->image) }}" class="card-img-top" alt="{{ $related->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $related->name }}</h5>
                        <p class="card-text">{{ number_format($related->price) }} VND</p>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('products.show', $related->id) }}" class="btn btn-sm btn-outline-primary w-100">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('increase').addEventListener('click', function() {
        let quantity = document.getElementById('quantity');
        let value = parseInt(quantity.value, 10);
        quantity.value = value + 1;
    });
    
    document.getElementById('decrease').addEventListener('click', function() {
        let quantity = document.getElementById('quantity');
        let value = parseInt(quantity.value, 10);
        if (value > 1) {
            quantity.value = value - 1;
        }
    });
</script>
@endsection
@endsection
