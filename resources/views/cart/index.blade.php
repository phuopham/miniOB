@extends('layouts.app')

@section('content')
    <div class="p-3">
        <h2>Cart</h2>
        <div id="customer">
            @if ($customer != null)
                <div class="d-flex row align-items-center">
                    <b class="col-2">Customer:</b>
                    <span class="col-3">{{ $customer->name }}</span>
                    <b class="col-2">Address:</b>
                    <span class="col-5">{{ $customer->address }}</span>
                    <b class="col-2">Phone:</b>
                    <span class="col-3">{{ $customer->phone }}</span>
                    <b class="col-2">Note:</b>
                    <span class="col-5">{{ $customer->note }}</span>
                </div>
            @else
                Please add a <a href="{{ route('customers.index') }}">customer</a> to submit this order
            @endif
        </div>
        <div class="">
            <table class="table">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Product</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Total price</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="cart">
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <form class="d-inline" action="{{ route('cart.reduceQuantity') }}" method="post">
                                    @csrf
                                    <input type="text" name="product" hidden value='{{ json_encode($product) }}'>
                                    <button class="btn btn-danger">-</button>
                                </form>
                                {{ $product->quantity }}
                                <form class="d-inline" action="{{ route('cart.addProducts') }}" method="post">
                                    @csrf
                                    <input type="text" name="products" hidden value='{{ json_encode($product) }}'>
                                    <button class="btn btn-danger">+</button>
                                </form>
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity * $product->price }}</td>
                            <td>
                                <form class="d-inline" action="{{ route('cart.removeProduct') }}" method="post">
                                    @csrf
                                    <input type="text" name="product" hidden value='{{ json_encode($product) }}'>

                                    <button type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <form action="{{ route('orders.store') }}" method="post">
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>Ship fee</td>
                            <td></td>
                            <td></td>
                            <td><input style="width:100px;" type="number" name="ship" id="ship-fee"
                                    value="{{ $ship }}">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td id="total">{{ $total }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
            </table>
        </div>
    </div>

    <button id="submit-order" {{ $customer == null || $total == null ? 'disabled' : '' }} type="submit"
        class="btn btn-danger">Submit order</button>
    </form>
@endsection
