<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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
        $product = Product::find($id);
        return view('home.cart',compact('product'));
}
}