<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use App\Models\Admin;
use App\Notifications\OrderComplete;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function SetDeliveryAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500'
        ]);

        session([
            'delivery_address' => $request->address,
            'delivery_lat' => $request->latitude ?? null,
            'delivery_lng' => $request->longitude ?? null,
        ]);

        return response()->json(['success' => true, 'message' => 'Address updated']);
    }

    public function ClearDeliveryAddress()
    {
        session()->forget(['delivery_address', 'delivery_lat', 'delivery_lng']);
        return response()->json(['success' => true]);
    }

    public function CashOrder(Request $request)
    {
        $user = Admin::where('role', 'admin')->get();


        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $totalAmount = 0;

        foreach ($cart as $car) {
            $totalAmount += ($car['price'] * $car['quantity']);
        }

        if (Session()->has('coupon')) {
            $tt = (Session()->get('coupon')['discount_amount']);
        } else {
            $tt = $totalAmount;
        }

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',

            'currency' => 'Taka',
            'amount' => $totalAmount,
            'total_amount' => $tt,
            'invoice_no' => 'LunchPuffin' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),

            'status' => 'Pending',
            'created_at' => Carbon::now(),

        ]);
        $carts = session()->get('cart', []);
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart['id'],
                'client_id' => $cart['client_id'],
                'qty' => $cart['quantity'],
                'price' => $cart['price'],
                'created_at' => Carbon::now(),
            ]);
        } // End Foreach

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        if (Session::has('cart')) {
            Session::forget('cart');
        }
        // Clear delivery address session after order
        session()->forget(['delivery_address', 'delivery_lat', 'delivery_lng']);

        // Send Notification to admin
        Notification::send($user, new OrderComplete($request->name));
        $notification = array(
            'message' => 'Order Placed Successfully',
            'alert-type' => 'success'
        );

        return view('frontend.checkout.thanks')->with($notification);
    }
}