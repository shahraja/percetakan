<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $users = User::all()->count();
        $transaksi = Transaksi::all()->count();
        $product = Product::all()->count();

        return view('admin.dashboard', compact('users', 'transaksi', 'product'));
    }
}
