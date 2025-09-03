<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Số liệu tổng quan
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        
        // Đơn hàng gần đây
        $recentOrders = Order::with('user')
                           ->orderBy('created_at', 'desc')
                           ->take(5)
                           ->get();
        
        // Biểu đồ doanh thu theo tháng (6 tháng gần nhất)
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $monthlySales = Order::where('status', 'completed')
                         ->where('created_at', '>=', $sixMonthsAgo)
                         ->select(
                             DB::raw('MONTH(created_at) as month'),
                             DB::raw('YEAR(created_at) as year'),
                             DB::raw('SUM(total_amount) as total')
                         )
                         ->groupBy('year', 'month')
                         ->orderBy('year')
                         ->orderBy('month')
                         ->get();
        
        // Định dạng dữ liệu cho biểu đồ
        $months = [];
        $salesData = [];
        
        foreach ($monthlySales as $sale) {
            $monthName = Carbon::createFromDate($sale->year, $sale->month, 1)->format('M Y');
            $months[] = $monthName;
            $salesData[] = $sale->total;
        }
        
        // Sản phẩm bán chạy nhất
        $topProducts = DB::table('order_items')
                        ->join('products', 'order_items.product_id', '=', 'products.id')
                        ->select('products.id', 'products.name', 'products.image', 
                                DB::raw('SUM(order_items.quantity) as total_sold'))
                        ->groupBy('products.id', 'products.name', 'products.image')
                        ->orderBy('total_sold', 'desc')
                        ->take(5)
                        ->get();
        
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'totalRevenue',
            'recentOrders',
            'months',
            'salesData',
            'topProducts'
        ));
    }
}
