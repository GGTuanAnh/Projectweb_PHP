<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of all orders
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Order::with('user');
        
        // Lọc theo trạng thái
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Tìm kiếm theo ID
        if ($request->has('search')) {
            $query->where('id', 'LIKE', "%{$request->search}%");
        }
        
        // Sắp xếp
        $sortField = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);
        
        $orders = $query->paginate(10);
        
        $statuses = [
            'pending' => 'Đang chờ',
            'processing' => 'Đang xử lý',
            'shipping' => 'Đang giao hàng',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy'
        ];
        
        return view('admin.orders.index', compact('orders', 'statuses'));
    }
    
    /**
     * Display the specified order
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with(['orderItems.product', 'user'])->findOrFail($id);
        
        $statuses = [
            'pending' => 'Đang chờ',
            'processing' => 'Đang xử lý',
            'shipping' => 'Đang giao hàng',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy'
        ];
        
        return view('admin.orders.show', compact('order', 'statuses'));
    }
    
    /**
     * Update the status of an order
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipping,completed,cancelled'
        ]);
        
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        
        // Nếu đơn hàng được đánh dấu là hoàn thành, cập nhật thời gian hoàn thành
        if ($request->status == 'completed') {
            $order->completed_at = now();
        }
        
        // Nếu đơn hàng bị hủy, cập nhật thời gian hủy
        if ($request->status == 'cancelled') {
            $order->cancelled_at = now();
        }
        
        $order->save();
        
        return redirect()->back()
            ->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công!');
    }
}
