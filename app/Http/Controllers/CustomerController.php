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
    public function index(Request $request)
    {
        if ($request->query('search')) {
            $searchTerm = $request->query('search');
            $customers = Customer::where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('id', $searchTerm)
                ->orWhere('address', 'LIKE', "%{$searchTerm}%")
                ->orWhere('phone', 'LIKE', "%{$searchTerm}%")
                ->simplePaginate(20);
            $condition = 'search';
        } else {
            $customers = Customer::latest()->simplePaginate(20);
            $condition = '';
        }
        return view('customer.index')->with('customers', $customers)->with('condition', $condition);
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

        return redirect()->route('customers.index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        $orders = Order::where('customer_id', $id)->get();
        return view('customer.show')
            ->with('customer', $customer)
            ->with('orders', $orders);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer.edit')
            ->with('customer', $customer);
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

        return redirect()->route('customers.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        return view('customer.index');
    }
}
