@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between m-4">
        <a href="{{ route('orders.index') }}">&lt;- <u>Back</u></a>
        <a href="{{ route('orders.edit', $order->id) }}"><u>Edit</u> -&gt;</a>
    </div>
    <h2>order detail</h2>
    <div class="d-flex row">
        <p class="col-2 form-label">Name</p>
        <p class="col-9">{{ $order->name }}</p>
        <p class="col-2 form-label">Address</p>
        <p class="col-9">{{ $order->address }}</p>
        <p class="col-2 form-label">Phone</p>
        <p class="col-9">{{ $order->phone }}</p>
        <p class="col-2 form-label">Note</p>
        <p class="col-9">{{ $order->note }}</p>
    </div>
@endsection
