<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addCustomer(Request $request)
    {
        $cart = cart::find(1);
        $cart->customer = $request->input('customer');
        $cart->save();
        return redirect()->back()->with('success', 'Khách đã được thêm vào đơn!');
    }

    public function addProducts(Request $request)
    {
        $cart = cart::find(1);
        $newProduct = json_decode($request->input('products'));
        $newProduct->quantity = 1;

        $products = collect(json_decode($cart->products));
        $itemInList = false;

        foreach ($products as &$product) {
            if ($product->id == $newProduct->id) {
                $product->quantity += 1;
                $itemInList = true;
            }
        }
        if (!$itemInList) {
            $products->push($newProduct);
        }
        $cart->products = $products;
        $cart->save();
        return redirect()->back()->with('success', $newProduct->name . ' đã được thêm vào đơn!');
    }

    public function reduceQuantity(Request $request)
    {
        $cart = cart::find(1);
        $reduceProduct = json_decode($request->input('product'));
        $products = collect(json_decode($cart->products));
        $toDelete = false;

        foreach ($products as &$product) {
            if ($product->id == $reduceProduct->id) {
                $product->quantity -= 1;
                $toDelete = $product->quantity == 0 ? true : false;
            }
        }
        if ($toDelete) {
            $products = $products->reject(function ($product) use ($reduceProduct) {
                return $product->id == $reduceProduct->id;
            });
        }
        $cart->products = $products;
        $cart->save();
        return redirect()->back()->with('success', $reduceProduct->name . ' đã được bớt đi!');
    }

    public function removeProduct(Request $request)
    {
        $cart = cart::find(1);
        $removeProduct = json_decode($request->input('product'));
        $products = collect(json_decode($cart->products));

        $products = $products->reject(function ($product) use ($removeProduct) {
            return $product->id == $removeProduct->id;
        });

        $cart->products = $products;
        $cart->save();
        return redirect()->back()->with('success', $removeProduct->name . ' đã được xóa khỏi đơn!');
    }

    public function addShip(Request $request)
    {
        $cart = cart::find(1);
        $cart->ship = $request->input('ship');
        $cart->save();
        return redirect()->back()->with('success', 'Tiền ship đã được thay đổi thành công!');
    }

    public function cancelCart()
    {
        $cart = cart::find(1);
        $cart->customer = '';
        $cart->ship = 0;
        $cart->products = [];
        $cart->save();
        if (session('success'))
            return redirect()->route('cart.index')->with('success', session('success'));
        return redirect()->route('cart.index')->with('success', 'Đơn đã được hủy!');
    }

    public function index()
    {
        $cart = cart::find(1);
        if ($cart == null) {
            $memory = new cart;
            $memory->id = 1;
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

        return view('cart.index')
            ->with('ship', $cart->ship)
            ->with('customer', $customer)
            ->with('products', $products)
            ->with('total', $total);
    }
}