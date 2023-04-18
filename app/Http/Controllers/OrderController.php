<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->query('search')) {
            $searchTerm = $request->query('search');
            // $ordersByName = Order::where('', 'LIKE', "%{$searchTerm}%")
            //     ->orWhere('customer_email', 'LIKE', "%{$searchTerm}%")
            //     ->get();

            $orders = Order::whereHas('customer', function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('address', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('phone', 'LIKE', "%{$searchTerm}%");
            })->simplePaginate(20);
            $condition = 'search';
        } elseif ($request->query('tab')) {
            if ($request->query('tab') == 'done') {
                $orders = Order::where('status', $request->query('tab'))->latest()->simplePaginate(20);
            } else {
                $orders = Order::where('status', $request->query('tab'))->simplePaginate(20);
            }
            $condition = $request->query('tab');
        } else {
            $orders = Order::with('orderDetail')->latest()->simplePaginate(20);
            $condition = "";
        }

        return view('order.index')->with('orders', $orders)->with('orderStatus', array('created', 'paid', 'delivered', 'done'))->with('condition', $condition);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $customer = Customer::find($request->query('customer'));

        return view('order.create')->with('customer', $customer);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(json_decode($request->input('customer'))->id);
        $order = new Order;
        $order->customer_id = json_decode($request->input('customer'))->id;
        $order->ship_price = $request->input('ship');
        $order->save();
        $products = json_decode($request->input('products'));
        foreach ($products as &$product) {
            $orderDetail = new OrderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product->id;
            $orderDetail->quantity = $product->quantity;
            $orderDetail->price = $product->price;
            $orderDetail->save();
        }

        return redirect()->route('cart.cancel');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('order.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function changeStatus(Request $request, $id)
    {
        // dd($id);
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('orders.index');
    }

}