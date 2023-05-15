<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
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
        $cart = cart::find(2);
        if ($cart == null) {
            $memory = new cart;
            $memory->id = 2;
            $memory->name = '';
            $memory->products = [];
            $memory->save();
        }
        $customer = json_decode($cart->customer);
        $products = json_decode($cart->products);
        $total = 0;
        foreach ($products as &$product) {
            $total += $product->price * $product->quantity;
        }

        $products = collect(json_decode($cart->products));
        $vendors = Customer::where('type', 'vendor')->get();
        $allProducts = Product::all();
        return view('purchase.create')
            ->with('ship', $cart->ship)
            ->with('customer', $customer)
            ->with('products', $products)
            ->with('total', $total)
            ->with('vendors', $vendors)
            ->with('allProducts', $allProducts);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->customer_id = json_decode($request->input('customer'))->id;
        $order->ship_price = $request->input('ship');
        $order->type = 'purchase';
        $order->save();
        $products = json_decode($request->input('products'));
        $total = 0;
        foreach ($products as &$product) {
            $orderDetail = new OrderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product->id;
            $orderDetail->quantity = $product->quantity;
            $orderDetail->price = $product->price;
            $orderDetail->save();
            $total += $product->quantity * $product->price;
        }
        $order->total = $total;
        $order->save();
        return redirect()->route('purchases.cancel')->with('success', 'Thêm đơn hàng số: ' . $order->id . ' thành công!');
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

    public function addVendor(Request $request)
    {
        $cart = cart::find(2);
        $vendor = Customer::find($request->input('vendor'))->toJson();
        $cart->customer = $vendor;
        $cart->save();
        return redirect()->back()->with('success', 'Nhà cung cấp đã được thêm vào đơn!');
    }

    public function addProduct(Request $request)
    {
        $cart = cart::find(2);
        $getProduct = Product::find($request->input('product_id'));
        $newProduct = new Product;
        $newProduct->id = $request->input('product_id');
        $newProduct->name = $getProduct->name;
        $newProduct->quantity = $request->input('quantity');
        $newProduct->price = $request->input('price');
        $products = collect(json_decode($cart->products));

        foreach ($products as &$product) {
            if ($product->id == $newProduct->id) {
                return redirect()->back()->with('error', $newProduct->name . ' đã có trong đơn nhập. Đề nghị check lại số lượng và giá!');
            }
        }
        $products->push($newProduct);

        $cart->products = $products;
        $cart->save();
        return redirect()->back()->with('success', $newProduct->name . ' đã được thêm vào đơn!');
    }

    public function removeProduct(Request $request)
    {
        $cart = cart::find(2);
        $removeProduct = json_decode($request->input('product'));
        $products = collect(json_decode($cart->products));

        $products = $products->reject(function ($product) use ($removeProduct) {
            return $product->id == $removeProduct->id;
        });

        $cart->products = $products;
        $cart->save();
        return redirect()->back()->with('success', $removeProduct->name . ' đã được xóa khỏi đơn nhập!');
    }

    //correct
    public function cancelPurchase()
    {
        $cart = cart::find(2);
        $cart->customer = '';
        $cart->ship = 0;
        $cart->products = [];
        $cart->save();
        if (session('success'))
            return redirect()->route('purchases.index')->with('success', session('success'));
        return redirect()->route('purchases.index')->with('success', 'Đơn đã được hủy!');
    }
}