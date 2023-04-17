@extends('layouts.app')

@section('content')
    <div>
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
                        <td class="d-none d-sm-table-cell">id</td>
                        <td>Product</td>
                        <td>Quantity</td>
                        <td class="d-none d-sm-table-cell">Price</td>
                        <td>Total price</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="cart">
                    @foreach ($products as $product)
                        <tr>
                            <td class="d-none d-sm-table-cell">{{ $product->id }}</td>
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
                            <td class="d-none d-sm-table-cell">{{ $product->price }}</td>
                            <td>{{ $product->quantity * $product->price }}</td>
                            <td>
                                <form class="d-inline" action="{{ route('cart.removeProduct') }}" method="post">
                                    @csrf
                                    <input type="text" name="product" hidden value='{{ json_encode($product) }}'>

                                    <button class="btn btn-danger" type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <form action="{{ route('orders.store') }}" method="post">
                    @csrf
                    <tfoot>
                        <tr>
                            <td class="d-none d-sm-table-cell"></td>
                            <td>Ship fee</td>
                            <td></td>
                            <td class="d-none d-sm-table-cell"></td>
                            <td><input style="width:80px;" type="number" name="ship" id="ship-fee"
                                    value="{{ $ship }}">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="d-none d-sm-table-cell"></td>
                            <td>Total</td>
                            <td></td>
                            <td class="d-none d-sm-table-cell"></td>
                            <td id="total">{{ $total }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
            </table>
        </div>
    </div>
    <a class="btn btn-secondary" onclick="return confirm('Are you sure you want to delete current cart?')"
        href="{{ route('cart.cancel') }}">Cancel</a>

    <input type="text" name="customer" hidden value='{{ json_encode($customer) }}' id="">
    <input type="text" name="products" hidden value=' {{ json_encode($products) }}'>
    <button id="submit-order" {{ $customer == null || $total == null ? 'disabled' : '' }} type="submit"
        class="btn btn-danger">Submit order</button>
    </form>
@endsection

@section('javascript')
    <script>
        let shipFee = document.querySelector('#ship-fee');
        let total = document.querySelector('#total');
        shipFee.addEventListener('input', function() {
            total.innerHTML = ({{ $total }} + Number(shipFee.value));
        });
    </script>
@endsection
