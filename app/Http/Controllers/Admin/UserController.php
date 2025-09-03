<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of all users
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();
        
        // Tìm kiếm theo tên hoặc email
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Lọc theo vai trò
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }
        
        // Sắp xếp
        $sortField = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);
        
        $users = $query->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }
    
    /**
     * Show the form for editing the specified user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    
    /**
     * Update the specified user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,staff,customer',
        ];
        
        // Nếu mật khẩu được cung cấp, thêm quy tắc xác thực
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }
        
        $request->validate($rules);
        
        // Cập nhật thông tin người dùng
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        
        // Cập nhật mật khẩu nếu được cung cấp
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        return redirect()->route('admin.users')
            ->with('success', 'Thông tin người dùng đã được cập nhật thành công!');
    }
}
