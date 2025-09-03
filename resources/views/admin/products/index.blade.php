@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Quản lý sản phẩm</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
            <a href="{{ route('admin.products') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'Không có' }}</td>
                            <td>{{ number_format($product->price) }} VND</td>
                            <td>
                                @if($product->available)
                                    <span class="badge badge-success">Có sẵn</span>
                                @else
                                    <span class="badge badge-danger">Hết hàng</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
