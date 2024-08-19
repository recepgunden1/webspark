<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $monthTotalCount = Order::where('created_at', '>=', now()->subDays(30))->count();
        $TotalCount = Order::count();

        $monthTotalPrice = Order::where('created_at', '>=', now()->subDays(30))->sum('price');
        $TotalPrice = Order::sum('price');

        return view('backend.pages.index', compact('monthTotalCount','monthTotalPrice','TotalCount','TotalPrice'));
    }
}
