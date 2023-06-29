<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        return view('home',compact('products'));
    }

    public function adminHome()
    {
        $products = Product::all();
        return view('admin.home',compact('products'));
    }

    public function product_show($id)
    {
        $product = Product::find(Crypt::decrypt($id));
        return view('layouts.stripe',compact('product'));
    }

    public function my_orders()
    {
        $orders = Purchase::select('purchases.id', 'purchases.stripe_id', 'purchases.amount', 'purchases.quantity', 'purchases.invoice', 'products.name', 'products.description', 'users.name' , 'users.email', 'products.thumbnail')
                    ->join('products', 'products.id', 'purchases.product_id')
                    ->join('users', 'users.id', 'purchases.user_id')
                    ->where([
                        ['purchases.user_id', '=', auth()->user()->id],
                        ['products.is_active', '=' , 1]
                    ])->get();
        return view('orders',compact('orders'));
    }

    public function show_order($id)
    {

    }
}
