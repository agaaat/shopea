<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function myOrder(){
        $order = Order::with(['user','product'])->where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('my_order',compact('order'));
    }

    public function checkout(Request $request){
        // dd($request->all());
        $request->request->add(['total_price' => $request->qty * 10000, 'status' => 'Unpaid']);
        
        // name, address, phone, qty, total_price
        // $order = Order::create($request->all());
        $product = Product::find($request->product_id);
        // dd($product);
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'qty' => 1,
            'total_price' => $product->price
        ]);


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => $request->name,
                'phone' => $request->phone,
            ),
        );

        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $updateOrderSnapToken = Order::find($order->id);
        $updateOrderSnapToken->snapToken = $snapToken;
        $updateOrderSnapToken->update();
        // dd($snapToken);

        return view('checkout', compact('snapToken', 'order'));
    }

    public function callback(Request $request){
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' or $request->transaction_status == 'settlement'){
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Paid']);
            }
        }
    }

}
