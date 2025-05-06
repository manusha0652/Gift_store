<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class HomeController extends Controller
{
    public function index(){
return view('admin.index');
    }


    public function home(){
        // Fetch products from the database
         $products = Product::all();
        // Pass the products to the view
         return view('home.index', compact('products'));
       
    }
    public function login_home(){
        $products = Product::all();
        // Pass the products to the view
         return view('home.index', compact('products'));
    }
    public function productDetails($id){
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }
    public function addToCart( $id){
        $product_id = $id;
        $user= Auth::user();
        $user_id = $user->id;
        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;
        $data->save();
        toastr()->success('🎉 Product added to your cart successfully! 🛒');
        return redirect()->back();
       
}
}