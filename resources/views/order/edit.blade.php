@extends('layouts.app')
@section('content')
    <div class="m-4">
        <a href="{{ route('orders.index') }}">&lt;- <u>Cancel</u></a>
        {{-- <a href="{{ route('orders.index') }}">Edit -&gt;</a> --}}
    </div>
    <h2>Edit order</h2>
    <form class="d-flex row" action="{{ route('orders.update', $order->id) }}" method="post">
        @csrf
        @method('PUT')
        <label class="col-3 form-label">Name</label>
        <input class="col-9 form-control" type="text" name="name" value="{{ $order->name }}">
        <label class="col-3 form-label">Description</label>
        <input class="col-9 form-control" type="text" name="description" value="{{ $order->description }}">
        <label class="col-3 form-label">Price</label>
        <input class="col-9 form-control" type="number" name="price" value="{{ $order->price }}">
        <button class="btn btn-primary" type="submit">Update</button>
    </form>
@endsection
