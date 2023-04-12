@extends('layouts.app')
@section('content')
    <div class="m-4">
        <a href="{{ route('orders.index') }}">&lt;- <u>Cancel</u></a>
        {{-- <a href="{{ route('orders.index') }}">Edit -&gt;</a> --}}
    </div>
    <h2>Edit order</h2>
    <form class="d-flex row" action="{{ route('orders.update', $order->id) }}" method="put">
        <label class="col-3 form-label">Name</label>
        <input class="col-9 form-control" type="text" name="name" value="{{ $order->name }}">
        <label class="col-3 form-label">Address</label>
        <input class="col-9 form-control" type="text" name="name" value="{{ $order->address }}">
        <label class="col-3 form-label">Phone</label>
        <input class="col-9 form-control" type="text" name="name" value="{{ $order->phone }}">
        <label class="col-3 form-label">Note</label>
        <input class="col-9 form-control" type="text" name="name" value="{{ $order->note }}">
        <button class="btn btn-primary" type="submit">Update</button>
    </form>
@endsection
