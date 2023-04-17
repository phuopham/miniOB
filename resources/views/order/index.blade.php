@extends('layouts.app')

@section('content')
    <h2>Orders</h2>

    <div class="d-md-flex justify-content-between align-items-start">
        <ul class="nav nav-tabs flex-fill">
            <li class="nav-item">
                <a class="nav-link {{ $condition == 'created' ? 'active' : '' }}"
                    {{ $condition == 'created' ? 'aria-current="page"' : '' }}
                    href="{{ route('orders.index', ['tab' => 'created']) }}">Created</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $condition == 'paid' ? 'active' : '' }}"
                    {{ $condition == 'paid' ? 'aria-current="page"' : '' }}
                    href="{{ route('orders.index', ['tab' => 'paid']) }}">Paid</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $condition == 'delivered' ? 'active' : '' }}"
                    {{ $condition == 'delivered' ? 'aria-current="page"' : '' }}
                    href="{{ route('orders.index', ['tab' => 'delivered']) }}">Delivered</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $condition == 'done' ? 'active' : '' }}"
                    {{ $condition == 'done' ? 'aria-current="page"' : '' }}
                    href="{{ route('orders.index', ['tab' => 'done']) }}">Done</a>
            </li>
        </ul>
        <form action="{{ route('orders.index') }}">
            <a class="btn btn-warning" href="{{ route('orders.index') }}">Clear</a>
            <input class="form-control d-inline" type="text" style="width:200px;" name="search" id="">
            <button class="btn btn-warning" type='submit'>Search</button>
        </form>

    </div>

    <div class="d-flex row">
        @foreach ($orders as $order)
            <div class="col-lg-6">
                <div class="shadow rounded rounded-3 my-3 p-3">
                    <div class="d-flex row">

                        <p class="col-md-6"><span>Name:</span>
                            <span>{{ $order->customer->name }}</span>
                        </p>
                        <p class="col-md-6"><span>ID:</span>
                            <span>{{ $order->id }}</span>
                        </p>
                        <p class="col-md-6"><span>Address:</span>
                            <span>{{ $order->customer->address }}</span>
                        </p>
                        <p class="col-md-6"><span> Note:</span>
                            <span>{{ $order->customer->note }}</span>
                        </p>
                        <p class="col-md-6"><span>Phone:</span>
                            <span>{{ $order->customer->phone }}</span>
                        </p>
                        <div class="col-md-6 d-flex">
                            <p>Status:</p>
                            <form action="{{ route('orders.changeStatus', $order->id) }}" method="post">
                                @csrf
                                <select name="status" id="">
                                    @foreach ($orderStatus as $item)
                                        <option value="{{ $item }}"
                                            {{ $item == $order->status ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" type="submit">Change</button>
                            </form>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetail as $orderDetail)
                                <tr>
                                    <td>{{ $orderDetail->id }}</td>
                                    <td>{{ $orderDetail->product->name }}</td>
                                    <td>{{ $orderDetail->quantity }}</td>
                                    <td>{{ $orderDetail->price }}</td>
                                    <td>{{ $orderDetail->quantity * $orderDetail->price }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td>Ship fee</td>
                                <td></td>
                                <td></td>
                                <td>{{ $order->ship_price }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-primary">
                                    {{ $order->orderDetail->sum(function ($orderDetail) {
                                        return $orderDetail->price * $orderDetail->quantity;
                                    }) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary">Print</button>
                </div>
            </div>
        @endforeach
        {{ $orders->links() }}
    </div>
@endsection
