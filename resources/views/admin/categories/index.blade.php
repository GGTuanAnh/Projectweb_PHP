@extends('layouts.admin')

@section('title', 'Quản lý danh mục')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Quản lý danh mục</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục</h6>
            <a href="#" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Số sản phẩm</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->products_count }}</td>
                            <td>{{ $category->created_at->format('d/m/Y') }}</td>
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
                            <td colspan="5" class="text-center">Không có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
