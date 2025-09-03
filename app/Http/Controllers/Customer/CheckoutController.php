<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        if (count($cart) === 0) {
            return redirect()->route('cart')->with('error', 'Giỏ hàng của bạn đang trống.');
        }
        
        // Tính tổng tiền
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        
        return view('customer.checkout', compact('cart', 'total'));
    }
    
    /**
     * Process the checkout
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'note' => 'nullable|string'
        ]);
        
        $cart = session()->get('cart', []);
        if (count($cart) === 0) {
            return redirect()->route('cart')->with('error', 'Giỏ hàng của bạn đang trống.');
        }
        
        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        
        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'status' => 'pending',
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note
        ]);
        
        // Thêm các sản phẩm vào đơn hàng
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
        }
        
        // Xóa giỏ hàng sau khi đã tạo đơn hàng
        session()->forget('cart');
        
        // Chuyển hướng đến trang thanh toán
        return redirect()->route('payment', ['order_id' => $order->id]);
    }
}
