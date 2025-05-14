<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;


class PayhereController extends Controller
{
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
    
        $cart_items = json_decode($request->input('cart_items'), true);
        $subtotal = $request->input('subtotal');
        $delivery_charges = $request->input('delivery_charges');
        $total = $request->input('total');
       
        
       
    
        // Create order in database with 'pending' status
        $order = new Order();
        $order->user_id = $user_id;
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->postal_code = $request->input('postal_code');
        $order->notes = $request->input('notes');
        $order->subtotal = (float) $subtotal;
        $order->delivery_charges = (float) $delivery_charges;
        $order->total = (float) $total;
        $order->status = 'pending';
        $order->save();
    
        // Store order items
        if (is_array($cart_items)) {
            foreach ($cart_items as $cart_item) {
                $orderItem = new OrderItem();
                $orderItem->user_id = $user_id;
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $cart_item['product']['id'];
                $orderItem->price = $cart_item['product']['price'];
                $orderItem->quantity = $cart_item['quantity'];
                $orderItem->save();
            }
        }
    
      
        $merchant_id = env('PAYHERE_MERCHANT_ID');
        $merchant_secret = env('PAYHERE_MERCHANT_SECRET');
        $amount = number_format($order->total, 2, '.', ''); 
        $currency = 'LKR';
  
        
            $data = [
    'merchant_id' => $merchant_id,
    'return_url' => route('payhere.return'),
    'cancel_url' => route('payhere.cancel'),
    'notify_url' => route('payhere.notify'),
    'order_id' => $order->id,
    'items' => 'Order# ' . $order->id,
    'currency' => $currency,
    'amount' => $amount,
    'first_name' => $order->name,
    'last_name' => '',
    'email' => $order->email,
    'phone' => $order->phone,
    'address' => $order->address,
    'city' => $order->city,
    'country' => 'LK',

        ];
       
 
        
        $hash = strtoupper(
            md5(
                $merchant_id .
                $order->id .
                $amount .
                $currency .
                strtoupper(md5($merchant_secret))
            )
        );
       
    
        return view('payhere.checkout', compact('data', 'hash'));
    }
    public function return()
    {
    
       
        return view('payhere.return');
    }
    public function cancel()
    {
        
        return view('payhere.cancel');
    }
    public function notify()
    {
       
    
       return view('payhere.notify');
        
    }
}
