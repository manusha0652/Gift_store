<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index(){
return view('admin.index');
    }


    public function home(){
        if (Auth::check()) { 
            // Fetch products from the database
            $products = Product::where('quantity', '>', 0)->get();
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
        $user = Auth::user();
        $user_id = $user ? $user->id : null;
        $count = $user_id ? Cart::where('user_id', $user_id)->count() : 0;

        return view('home.index', compact('products', 'count'));
    }
    public function productDetails($id){
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }
    public function whyUs(){
        $user = Auth::user();
        $user_id = $user ? $user->id : null;
        $count = $user_id ? Cart::where('user_id', $user_id)->count() : 0;
        return view('home.why_us', compact('count'));
    }
    public function Testimonial(){
         $products = Product::where('quantity', '>', 0)->get();
            // Pass the products to the view
              $user = Auth::user();
        $user_id = $user ? $user->id : null;
        $count = $user_id ? Cart::where('user_id', $user_id)->count() : 0;

        $testimonials = Testimonial::all();
        return view('home.testimonial', compact('testimonials' ,'count'));
    }
    public function ContactUs(){
         $products = Product::where('quantity', '>', 0)->get();
            // Pass the products to the view
             $user = Auth::user();
        $user_id = $user ? $user->id : null;
        $count = $user_id ? Cart::where('user_id', $user_id)->count() : 0;
        return view('home.contact_us', compact('count'));
    }
    public function product(){
        $products = Product::all();
        return view('home.product',     compact('products', 'count'));
    }
    public function customLogout(Request $request){
       
        Auth::logout();
        return redirect()->route('home.index');
    }
    public function store_testimonial(Request $request){
        // Validate the request data
       
              $testimonial = new Testimonial();
        $testimonial->name = $request->input('name');
        $testimonial->title = $request->input('title');
        $testimonial->city = $request->input('city');
        $testimonial->message = $request->input('message');
        $testimonial->save();
        toastr()->success('Testimonial submitted successfully!');
        
        return redirect()->back();
    }
   
}