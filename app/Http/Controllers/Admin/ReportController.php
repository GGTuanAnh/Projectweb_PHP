<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display sales reports
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sales(Request $request)
    {
        $dateRange = $request->input('date_range', 'this_month');
        $customStartDate = $request->input('start_date');
        $customEndDate = $request->input('end_date');
        
        // Xác định thời gian dựa trên range được chọn
        switch ($dateRange) {
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::today()->endOfDay();
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday();
                $endDate = Carbon::yesterday()->endOfDay();
                break;
            case 'this_week':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case 'last_week':
                $startDate = Carbon::now()->subWeek()->startOfWeek();
                $endDate = Carbon::now()->subWeek()->endOfWeek();
                break;
            case 'this_month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            case 'last_month':
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
                break;
            case 'this_year':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            case 'custom':
                $startDate = Carbon::createFromFormat('Y-m-d', $customStartDate)->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', $customEndDate)->endOfDay();
                break;
            default:
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
        }
        
        // Lấy dữ liệu đơn hàng trong khoảng thời gian
        $query = Order::whereBetween('created_at', [$startDate, $endDate]);
        
        // Tổng doanh thu
        $totalRevenue = $query->sum('total_amount');
        
        // Số lượng đơn hàng
        $totalOrders = $query->count();
        
        // Giá trị đơn hàng trung bình
        $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        
        // Doanh thu theo ngày
        $dailySales = Order::whereBetween('created_at', [$startDate, $endDate])
                       ->select(
                           DB::raw('DATE(created_at) as date'),
                           DB::raw('SUM(total_amount) as total_sales'),
                           DB::raw('COUNT(*) as order_count')
                       )
                       ->groupBy('date')
                       ->orderBy('date')
                       ->get();
        
        // Format dữ liệu cho biểu đồ
        $dates = [];
        $salesData = [];
        $orderCountData = [];
        
        foreach ($dailySales as $sale) {
            $dates[] = Carbon::parse($sale->date)->format('d/m/Y');
            $salesData[] = $sale->total_sales;
            $orderCountData[] = $sale->order_count;
        }
        
        return view('admin.reports.sales', compact(
            'dateRange',
            'customStartDate',
            'customEndDate',
            'totalRevenue',
            'totalOrders',
            'avgOrderValue',
            'dates',
            'salesData',
            'orderCountData'
        ));
    }
    
    /**
     * Display product reports
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function products(Request $request)
    {
        // Sản phẩm bán chạy nhất
        $topSellingProducts = DB::table('order_items')
                                ->join('products', 'order_items.product_id', '=', 'products.id')
                                ->select(
                                    'products.id',
                                    'products.name',
                                    'products.image',
                                    DB::raw('SUM(order_items.quantity) as quantity_sold'),
                                    DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue')
                                )
                                ->groupBy('products.id', 'products.name', 'products.image')
                                ->orderBy('quantity_sold', 'desc')
                                ->take(10)
                                ->get();
        
        // Doanh thu theo danh mục
        $categoryRevenue = DB::table('order_items')
                            ->join('products', 'order_items.product_id', '=', 'products.id')
                            ->join('categories', 'products.category_id', '=', 'categories.id')
                            ->select(
                                'categories.id',
                                'categories.name',
                                DB::raw('SUM(order_items.quantity * order_items.price) as revenue')
                            )
                            ->groupBy('categories.id', 'categories.name')
                            ->orderBy('revenue', 'desc')
                            ->get();
        
        // Dữ liệu cho biểu đồ danh mục
        $categoryNames = $categoryRevenue->pluck('name')->toArray();
        $categoryRevenueData = $categoryRevenue->pluck('revenue')->toArray();
        
        return view('admin.reports.products', compact(
            'topSellingProducts',
            'categoryNames',
            'categoryRevenueData'
        ));
    }
}
