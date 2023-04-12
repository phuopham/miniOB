<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all()->toArray();
        return view('customer.index')->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->note = $request->note;
        $customer->save();

        $notification = array(
            'message' => 'Customer added successfully!',
            'alert_type' => 'success'
        );

        return redirect()->route('customers.index')->with('notification', $notification);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::find($id)->toJson();
        $orders = Order::where('customer_id', $id)->get()->toJson();
        return view('customer.show')
            ->with('customer', json_decode($customer))
            ->with('orders', $orders);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::find($id)->toJson();
        return view('customer.edit')
            ->with('customer', json_decode($customer));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->note = $request->note;
        $customer->save();

        $notification = array(
            'message' => 'Customer edited successfully!',
            'alert_type' => 'success'
        );

        return redirect()->route('customers.index')->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        return view('customer.index');
    }
}