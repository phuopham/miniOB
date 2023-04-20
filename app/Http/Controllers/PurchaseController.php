<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->query('search')) {
            $searchTerm = $request->query('search');
            $purchases = Order::where('type', 'purchase')
                ->whereHas('customer', function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('address', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('phone', 'LIKE', "%{$searchTerm}%");
                })->simplePaginate(20);
            $condition = 'search';
        } elseif ($request->query('tab')) {
            if ($request->query('tab') == 'done') {
                $purchases = Order::where('type', 'purchase')->where('status', $request->query('tab'))->latest()->simplePaginate(10);
            } else {
                $purchases = Order::where('type', 'purchase')->where('status', $request->query('tab'))->simplePaginate(10);
            }
            $condition = $request->query('tab');
        } else {
            $purchases = Order::where('type', 'purchase')->latest()->simplePaginate(10);
            $condition = "";
        }
        $vendors = Customer::where('type', 'vendor')->latest()->simplePaginate(10);

        return view('purchase.index', )->with('orderStatus', array('created', 'paid', 'delivered', 'done'))->with('purchases', $purchases)->with('vendors', $vendors)->with('condition', $condition);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}