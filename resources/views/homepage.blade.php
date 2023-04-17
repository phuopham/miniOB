@php
$totalShip = 0;
$totalValue = 0;
foreach($data as &$item){
$totalShip += $item->ship;
$totalValue += $item->total;
}
@endphp

@extends('layouts.app')

@section('content')
<h2>Welcome to Mini Online Business!</h2>
<p>
    Tháng này chúng ta đã bán được {{ count($data) }} đơn. Tổng giá trị các đơn hàng là {{ $totalValue }} chưa bao gồm
    {{
    $totalShip }} phí vận chuyển.
</p>
<p>
    Keep fighting!
</p>
@endsection
