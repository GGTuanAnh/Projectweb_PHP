<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    /**
     * Display the payment page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = Order::findOrFail($orderId);
        
        // Kiểm tra quyền sở hữu đơn hàng
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền truy cập đơn hàng này.');
        }
        
        // Kiểm tra trạng thái đơn hàng
        if ($order->status !== 'pending') {
            return redirect()->route('customer.orders.show', $order->id)
                ->with('info', 'Đơn hàng này đã được thanh toán hoặc đã bị hủy.');
        }
        
        return view('customer.payment', compact('order'));
    }
    
    /**
     * Process the payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|string|in:cash,card,momo,zalopay',
        ]);
        
        $orderId = $request->input('order_id');
        $order = Order::findOrFail($orderId);
        
        // Kiểm tra quyền sở hữu đơn hàng
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền truy cập đơn hàng này.');
        }
        
        // Kiểm tra trạng thái đơn hàng
        if ($order->status !== 'pending') {
            return redirect()->route('customer.orders.show', $order->id)
                ->with('info', 'Đơn hàng này đã được thanh toán hoặc đã bị hủy.');
        }
        
        $paymentMethod = $request->input('payment_method');
        
        // Mô phỏng xử lý thanh toán
        // Trong dự án thực tế, đây là nơi tích hợp với các cổng thanh toán
        
        switch ($paymentMethod) {
            case 'card':
                // Xử lý thanh toán thẻ
                // $this->processCardPayment($order, $request);
                break;
                
            case 'momo':
                // Xử lý thanh toán MoMo
                // $this->processMomoPayment($order, $request);
                break;
                
            case 'zalopay':
                // Xử lý thanh toán ZaloPay
                // $this->processZaloPayment($order, $request);
                break;
                
            default:
                // Thanh toán tiền mặt (mặc định)
                break;
        }
        
        // Cập nhật trạng thái đơn hàng
        $order->update([
            'status' => 'processing',
            'payment_method' => $paymentMethod,
            'paid_at' => now()
        ]);
        
        return redirect()->route('customer.orders.show', $order->id)
            ->with('success', 'Đơn hàng của bạn đã được thanh toán thành công và đang được xử lý!');
    }
}
