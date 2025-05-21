<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\PaymentIntent;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


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
        $order->status = 'Cash On Delivery';
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
    'country' => 'Sri Lanka',

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
    public function return(Request $request)
    {
        // Handle the return from PayHere
        // You can update the order status here based on the response from PayHere
        // For example, you can mark the order as 'completed' or 'failed'
    {
      $order_id = $request->input('order_id');
        $status = $request->input('status_code');
        
        $order = Order::findOrFail($order_id);
        
        if ($status == 2) {
            // Payment successful
            return redirect()->route('payhere.notify', $order->id)
                ->with('success', 'Your payment was successful!');
        } else {
            // Payment failed
            return redirect()->route('payhere.cancle', $order->id)
                ->with('error', 'Your payment was not successful. Please try again.');
        }
       
       
    }
}
     public function cancel(Request $request)
    {
        $order_id = $request->input('order_id');
        $order = Order::findOrFail($order_id);
        
        return redirect()->route('payhere.cancel', $order->id)
            ->with('warning', 'You cancelled the payment process.');
    }
    public function notify(Request $request)
    {
        // Get the PayHere notification data
        $merchant_id = $request->input('merchant_id');
        $order_id = $request->input('order_id');
        $payment_id = $request->input('payment_id');
        $payhere_amount = $request->input('payhere_amount');
        $payhere_currency = $request->input('payhere_currency');
        $status_code = $request->input('status_code');
        $md5sig = $request->input('md5sig');
        
        $merchant_secret = config('payhere.merchant_secret');
        
        // Calculate MD5 hash for verification
        $local_md5sig = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                $payhere_amount . 
                $payhere_currency . 
                $status_code . 
                strtoupper(md5($merchant_secret))
            )
        );
        
        // Find the order
        $order = Order::find($order_id);
        
        if (!$order) {
            Log::error('PayHere notification: Order not found', ['order_id' => $order_id]);
            return response('Order not found', 404);
        }
        
        // Verify hash and update order status
        if ($local_md5sig === $md5sig) {
            if ($status_code == 2) {
                $order->status = 'Paid';
                $order->payment_id = $payment_id;
                $order->payment_status = 'Completed';
                $order->save();
                
                // Additional actions after successful payment (e.g., send email)
                // ...
                
                Log::info('PayHere payment successful', ['order_id' => $order_id, 'payment_id' => $payment_id]);
            } else {
                $order->status = 'Payment Failed';
                $order->payment_status = 'Failed';
                $order->save();
                
                Log::warning('PayHere payment failed', ['order_id' => $order_id, 'status_code' => $status_code]);
            }
            
            return response('OK', 200);
        } else {
            Log::error('PayHere notification: Hash verification failed', [
                'order_id' => $order_id,
                'local_hash' => $local_md5sig,
                'payhere_hash' => $md5sig
            ]);
            
            return response('Hash verification failed', 400);
        }
    }
}

    



