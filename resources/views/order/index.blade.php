@extends('layouts.app')

@section('content')
<h2>Danh sách đơn hàng</h2>

<div class="d-md-flex justify-content-between align-items-start">
    <ul class="nav nav-tabs flex-fill">
        <li class="nav-item">
            <a class="nav-link {{ $condition == 'created' ? 'active' : '' }}" {{ $condition=='created'
                ? 'aria-current="page"' : '' }} href="{{ route('orders.index', ['tab' => 'created']) }}">Đã tạo</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $condition == 'paid' ? 'active' : '' }}" {{ $condition=='paid' ? 'aria-current="page"'
                : '' }} href="{{ route('orders.index', ['tab' => 'paid']) }}">Đã thanh toán</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $condition == 'delivered' ? 'active' : '' }}" {{ $condition=='delivered'
                ? 'aria-current="page"' : '' }} href="{{ route('orders.index', ['tab' => 'delivered']) }}">Đã giao
                hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $condition == 'done' ? 'active' : '' }}" {{ $condition=='done' ? 'aria-current="page"'
                : '' }} href="{{ route('orders.index', ['tab' => 'done']) }}">Hoàn thành</a>
        </li>
    </ul>
    <form action="{{ route('orders.index') }}">
        <a class="btn btn-warning" href="{{ route('orders.index') }}">Xóa</a>
        <input class="form-control d-inline" type="text" style="width:200px;" name="search" id=""
            placeholder="Tìm kiếm">
        <button class="btn btn-warning" type='submit'>Tìm kiếm</button>
    </form>

</div>

<div class="d-flex row">
    @foreach ($orders as $order)
    <div class="col-lg-6">
        <div class="shadow rounded rounded-3 my-3 p-3">
            <div class="d-flex row">

                <p class="col-md-6"><span>Tên khách:</span>
                    <span>{{ $order->customer->name }}</span>
                </p>
                <p class="col-md-6"><span>Số hóa đơn:</span>
                    <span>{{ $order->id }}</span>
                </p>
                <p class="col-md-6"><span>Địa chỉ:</span>
                    <span>{{ $order->customer->address }}</span>
                </p>
                <p class="col-md-6"><span> Note:</span>
                    <span>{{ $order->customer->note }}</span>
                </p>
                <p class="col-md-6"><span>SĐT:</span>
                    <span>{{ $order->customer->phone }}</span>
                </p>
                <div class="col-md-6 d-flex">
                    <p>Status:</p>
                    <form action="{{ route('orders.changeStatus', $order->id) }}" method="post">
                        @csrf
                        <select name="status" id="">
                            @foreach ($orderStatus as $item)
                            <option value="{{ $item }}" {{ $item==$order->status ? 'selected' : '' }}>
                                {{ $item }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary" type="submit">Thay đổi</button>
                    </form>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Giá thành</th>
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
                        <td>Phí vận chuyển</td>
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
            <a class="btn btn-warning" href="{{ route('orders.show', $order->id ) }}" target="_blank">In ấn</a>
        </div>
    </div>
    @endforeach
    {{ $orders->links() }}
</div>
@endsection