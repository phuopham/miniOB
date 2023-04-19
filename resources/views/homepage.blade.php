@php
    $totalShip = 0;
    $totalValue = 0;
    foreach ($data as &$item) {
        $totalShip += $item->ship;
        $totalValue += $item->total;
    }
@endphp

@extends('layouts.app')

@section('content')
    <h2>Welcome to Mini Online Business!</h2>
    <p>
        Tháng này chúng ta đã bán được <u>{{ count($data) }}</u> đơn. Tổng giá trị các đơn hàng là
        <u>{{ $totalValue }}</u>
        chưa bao gồm <u>{{ $totalShip }}</u> phí vận chuyển.
    </p>
    <p>
        Chúng ta còn cần phải xử lý <u>{{ count($uncompletedOrder) }}</u> đơn. Chi tiết như sau:
    </p>
    @foreach ($uncompletedOrder as $order)
        @if ($order->status == 'delivered')
            <p>Khách hàng {{ $order->customer->name }} vẫn chưa thanh toán đơn {{ $order->id }} với trị giá
                {{ $order->total }} </p>
        @endif
        @if ($order->status == 'paid')
            <p>Đơn {{ $order->id }} cần được giao cho khách hàng {{ $order->customer->name }} ở địa chỉ
                {{ $order->customer->address }}</p>
        @endif
        @if ($order->status == 'created')
            <p>Đơn {{ $order->id }} đã được lên đơn từ ngày
                {{ Carbon\Carbon::parse($order->created_at)->toDateString() }}.
                Cần sớm được xử
                lý!
            </p>
        @endif
    @endforeach
    <p>
        Chi tiết vui lòng vào phần <a href="{{ route('orders.index') }}">Đơn đã lên</a> để biết thêm chi tiết.
    </p>
    <p>
        Keep fighting!
    </p>
@endsection
