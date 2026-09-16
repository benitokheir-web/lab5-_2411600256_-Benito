<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $lowStock = Product::where('quantity', '>', 0)
            ->whereColumn('quantity', '<=', 'reorder_level')
            ->count();
        $outOfStock = Product::where('quantity', '<=', 0)->count();

        $inventoryValue = Product::selectRaw(
            'COALESCE(SUM(quantity * unit_price), 0) as total'
        )->value('total');

        $recentProducts = Product::latest()->take(8)->get();

        return view('dashboard', compact(
            'totalProducts',
            'lowStock',
            'outOfStock',
            'inventoryValue',
            'recentProducts'
        ));
    }
}
