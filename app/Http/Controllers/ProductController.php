<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->query('search')) {
            $searchTerm = $request->query('search');
            $products = Product::where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('id', $searchTerm)
                ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                ->orWhere('price', 'LIKE', "%{$searchTerm}%")
                ->simplePaginate(20);
            $condition = 'search';
        } else {
            $products = Product::query()->simplePaginate(20);
            $condition = '';
        }
        return view('product.index')->with('products', $products)->with('condition', $condition);
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

        return redirect()->route('products.index')->with('success', 'Sản phẩm ' . $request->name . ' đã được tạo thành công!');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        $orders = OrderDetail::where('product_id', $id)->get();
        return view('product.show')
            ->with('product', $product)
            ->with('orders', $orders);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit')
            ->with('product', $product);
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

        return redirect()->route('products.show', $id)->with('success', 'Sản phẩm ' . $request->name . ' đã được cập nhật!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}