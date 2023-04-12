<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all()->toJson();
        return view('product.index')->with('products', json_decode($products));
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
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        $notification = array(
            'message' => 'Customer added successfully!',
            'alert_type' => 'success'
        );

        return redirect()->route('products.index')->with('notification', $notification);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id)->toJson();
        $orders = OrderDetail::where('product_id', $id)->get()->toJson();
        return view('product.show')
            ->with('product', json_decode($product))
            ->with('orders', json_decode($orders));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id)->toJson();
        return view('product.edit')
            ->with('product', json_decode($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        $notification = array(
            'message' => 'Product edited successfully!',
            'alert_type' => 'success'
        );

        return redirect()->route('products.show', $id)->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}