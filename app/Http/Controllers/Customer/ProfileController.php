<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('customer.profile', compact('user'));
    }
    
    /**
     * Update the user's profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);
        
        // Cập nhật thông tin cơ bản
        $user->name = $request->name;
        $user->email = $request->email;
        
        // Cập nhật mật khẩu nếu có
        if ($request->filled('new_password')) {
            // Kiểm tra mật khẩu hiện tại
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác']);
            }
            
            $user->password = Hash::make($request->new_password);
        }
        
        $user->save();
        
        return redirect()->back()->with('success', 'Thông tin cá nhân đã được cập nhật thành công!');
    }
}
