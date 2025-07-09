<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalValue = Product::selectRaw('SUM(price * quantity) as total')
            ->value('total') ?? 0;
        
        $lowStockCount = Product::where('quantity', '<', 5)->count();
        $recentProducts = Product::latest()->take(5)->get();

        return view('home', [
            'totalProducts' => $totalProducts,
            'totalValue' => $totalValue,
            'lowStockCount' => $lowStockCount,
            'recentProducts' => $recentProducts
        ]);
    }
}
