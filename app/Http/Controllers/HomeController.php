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
         
        
         return view('home.index', compact('products'));
       
    }
    public function login_home(){
        $products = Product::all();
        // Pass the products to the view
        $user = Auth::user();
        $user_id = $user->id;
        $count = Cart::where('user_id', $user_id)->count();
 
         return view('home.index', compact('products','count'));
    }
    public function productDetails($id){
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }
    
   
}