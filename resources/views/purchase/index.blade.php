@extends('layouts.app')

@section('content')
    <div class="d-flex d-lg-none justify-content-end m-4">
        <a href="{{ route('purchases.create') }}"><u>Tạo đơn mới</u> -&gt;</a>
    </div>
    <div class="d-lg-flex justify-content-between align-items-center">
        <h2>Danh sách đơn nhập</h2>
        <form action="{{ route('purchases.index') }}">
            <a class="btn btn-warning" href="{{ route('purchases.index') }}">Xóa</a>
            <input class="form-control d-inline" type="text" style="width:200px;" name="search" id=""
                placeholder="Tìm kiếm">
            <button class="btn btn-warning" type='submit'>Tìm kiếm</button>
        </form>
    </div>

    <div class="d-lg-flex">
        <div class="col-lg-8">
            <div class="d-md-flex justify-content-between align-items-start">
                <ul class="nav nav-tabs flex-fill">
                    <li class="nav-item">
                        <a class="nav-link {{ $condition == 'created' ? 'active' : '' }}"
                            {{ $condition == 'created' ? 'aria-current="page"' : '' }}
                            href="{{ route('purchases.index', ['tab' => 'created']) }}">Đã tạo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $condition == 'paid' ? 'active' : '' }}"
                            {{ $condition == 'paid' ? 'aria-current="page"' : '' }}
                            href="{{ route('purchases.index', ['tab' => 'paid']) }}">Đã thanh toán</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $condition == 'delivered' ? 'active' : '' }}"
                            {{ $condition == 'delivered' ? 'aria-current="page"' : '' }}
                            href="{{ route('purchases.index', ['tab' => 'delivered']) }}">Đã giao
                            hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $condition == 'done' ? 'active' : '' }}"
                            {{ $condition == 'done' ? 'aria-current="page"' : '' }}
                            href="{{ route('purchases.index', ['tab' => 'done']) }}">Hoàn thành</a>
                    </li>
                </ul>
            </div>
            @foreach ($purchases as $order)
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
                                        <option value="{{ $item }}"
                                            {{ $item == $order->status ? 'selected' : '' }}>
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
                    <a class="btn btn-warning" href="{{ route('purchases.show', $order->id) }}" target="_blank">In ấn</a>
                </div>
            @endforeach
            {{ $purchases->links() }}
        </div>
        <div class="col-lg-4">
            <h4>Nhà cung cấp</h4>
            <div class="d-none d-md-flex justify-content-end">
                <a href="{{ route('purchases.create') }}">Tạo đơn mới -></a>
            </div>
            <ol>
                @foreach ($vendors as $vendor)
                    <li class="border rounded-3 shadow-lg p-2"><b class="fs-5">{{ $vendor->name }} </b><br> SĐT:
                        {{ $vendor->phone }}
                        <br>
                        {{ $vendor->address }} <br> {{ $vendor->note }}
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection
