<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $cart_items = Cart::with('product')->where('user_id', $user_id)->get();

        
        
        return view('home.cart', compact('cart_items'));
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
    public function delete_item($id)
    {    $cart_item = Cart::find($id);
          if ($cart_item) {
       
        $currentProductQuantity = Product::find($cart_item->product_id);
       
            if ($currentProductQuantity) {
                $currentProductQuantity->quantity = $currentProductQuantity->quantity + 1;
                $currentProductQuantity->save();
            }

        
            $cart_item->delete();
            toastr()->success('Product removed from cart successfully!');
            

        } else {
            toastr()->error('Product not found in cart.');
        }
        return redirect()->back();
    }
    public function updateQuantity(Request $request)
    {
        $user_id = Auth::id(); 
        $id = $request->input('id');  // now using cart id
        $quantity = $request->input('quantity');
    
        $cartItem = Cart::where('user_id', $user_id)
                        ->where('id', $id)  // safe lookup by cart row
                        ->first();
    
        if ($cartItem) {
            $previousQuantity = $cartItem->quantity; // Store the previous quantity
            $cartItem->quantity = $quantity;
            $cartItem->save();

            $updateProductQuantity = Product::find($cartItem->product_id);
            if ($updateProductQuantity) {
                // Adjust the product quantity based on the difference
                $quantityDifference = $quantity - $previousQuantity;
                $newQuantity = $updateProductQuantity->quantity - $quantityDifference;

                // Ensure the quantity does not go below 0
                $updateProductQuantity->quantity = max(0, $newQuantity);
                $updateProductQuantity->save();
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Item not found']);
        }
    }
        } 

    
    

