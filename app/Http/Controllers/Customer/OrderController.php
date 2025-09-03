<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);
        
        return view('customer.orders.index', compact('orders'));
    }
    
    /**
     * Display the specified order
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        
        // Kiểm tra quyền sở hữu đơn hàng
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền truy cập đơn hàng này.');
        }
        
        return view('customer.orders.show', compact('order'));
    }
}
