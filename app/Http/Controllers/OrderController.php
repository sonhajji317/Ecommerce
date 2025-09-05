<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pay($id)
    {
        $order = Order::with('product')->findOrFail($id);

        //midtrans config
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'name' => Auth::user()->name,
            ),
        );

        $snapToken = Snap::getSnapToken($params);

        return view('order.pay', compact('snapToken', 'order'));
    }

    public function index()
    {
        $query = Order::with(['product', 'user'])
            ->latest();

        // kalau bukan admin, hanya order miliknya
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        // filter by nama product
        if (request()->filled('search')) {
            $search = request('search');
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $orders = $query->simplePaginate(4)->withQueryString();

        return view('order.index', compact('orders'));
    }


    public function checkout(Request $request, $id)
    {
        $auth = Auth::user();

        $product = Product::with('category')->find($id);
        $request->request->add([
            'product_id' => $product->id,
            'total_price' => $request->qty * $product->price,
            'status' => 'unpaid',
            'user_id' => Auth::user()->id,
        ]);

        $order = Order::create($request->all());

        //SAMPLE REQUEST START HERE

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'name' => Auth::user()->name,
            ),
        );

        $snapToken = Snap::getSnapToken($params);
        // dd($snapToken);
        return view('order.checkout', compact('snapToken', 'order', 'product', 'auth'));
    }

    public function orderDetails($id)
    {
        $product = Product::with('category')->find($id);
        return view('order.details', compact('product'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orderList');
    }
}
