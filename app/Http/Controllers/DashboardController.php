<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();
        
        $productsWithShopee = Product::whereNotNull('shopee_link')->count();
        
        $recentProducts = Product::latest()
            ->take(5)
            ->get();
        
        $productsWithoutShopee = Product::whereNull('shopee_link')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalUsers' => $totalUsers,
            'productsWithShopee' => $productsWithShopee,
            'recentProducts' => $recentProducts,
            'productsWithoutShopee' => $productsWithoutShopee,
        ]);
    }

    public function user()
    {
        $user = Auth::user();
        
        $myOrders = Order::where('user_id', $user->id)
            ->with('items')
            ->latest()
            ->get();
        
        $totalSpent = Order::where('user_id', $user->id)->sum('total');
        
        $totalOrders = Order::where('user_id', $user->id)->count();
        
        $recommendations = Product::inRandomOrder()
            ->take(5)
            ->get();

        return view('user.dashboard', [
            'user' => $user,
            'myOrders' => $myOrders,
            'totalSpent' => $totalSpent,
            'totalOrders' => $totalOrders,
            'recommendations' => $recommendations,
        ]);
    }

    public function welcome()
    {
        // Cek apakah user sudah login
        $user = Auth::user();
        
        if ($user) {
            // Jika sudah login, ambil data user
            $myOrders = Order::where('user_id', $user->id)
                ->with('items')
                ->latest()
                ->get();
            
            $totalSpent = Order::where('user_id', $user->id)->sum('total');
            
            $totalOrders = Order::where('user_id', $user->id)->count();
            
            $recommendations = Product::inRandomOrder()
                ->take(5)
                ->get();

            return view('user.dashboard', [
                'user' => $user,
                'myOrders' => $myOrders,
                'totalSpent' => $totalSpent,
                'totalOrders' => $totalOrders,
                'recommendations' => $recommendations,
            ]);
        }
        
        // Jika guest, tampilkan welcome page
        return view('welcome');
    }
}