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
        if (Auth::check()) { 
            // Fetch products from the database
            $products = Product::all();
            // Pass the products to the view
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
            
            return view('home.index', compact('products', 'count'));
        } else {
            return redirect()->route('login');
        }
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
    public function whyUs(){
        return view('home.why_us');
    }
    public function Testimonial(){
        return view('home.testimonial');
    }
    public function ContactUs(){
        return view('home.contact_us');
    }
   
}