<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
            })->get();
            $condition = 'search';
        } elseif ($request->query('tab')) {
            if ($request->query('tab') == 'done') {
                $orders = Order::where('status', $request->query('tab'))->latest()->take(10)->get();
            } else {
                $orders = Order::where('status', $request->query('tab'))->get();
            }
            $condition = $request->query('tab');
        } else {
            $orders = Order::with('orderDetail')->latest()->take(10)->get();
            $condition = "";
        }

        return view('order.index')->with('orders', $orders)->with('orderStatus', array('created', 'paid', 'delivered', 'done'))->with('condition', $condition);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
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

        $notification = array(
            'message' => 'Order updated successfully!',
            'alert_type' => 'success'
        );

        return redirect()->route('orders.index')->with('notification', $notification);
    }

}
