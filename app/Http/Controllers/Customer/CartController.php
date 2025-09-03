<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display the cart page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        // Lấy thông tin chi tiết sản phẩm và tính tổng tiền
        if ($cart) {
            foreach ($cart as $id => $details) {
                $total += $details['price'] * $details['quantity'];
            }
        }
        
        return view('customer.cart', compact('cart', 'total'));
    }
    
    /**
     * Add a product to cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);
        
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image ?? 'images/default-product.jpg'
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }
    
    /**
     * Remove a product from cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }
    
    /**
     * Update cart item quantity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity');
        
        if(isset($cart[$id]) && $quantity > 0) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật!');
    }
}
