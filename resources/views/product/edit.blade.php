@extends('layouts.app')
@section('content')
    <div class="m-4">
        <a href="{{ route('products.index') }}">&lt;- <u>Cancel</u></a>
        {{-- <a href="{{ route('products.index') }}">Edit -&gt;</a> --}}
    </div>
    <h2>Edit product</h2>
    <form class="d-flex row" action="{{ route('products.update', $product->id) }}" method="post">
        @csrf
        @method('PUT')
        <label class="col-3 form-label">Name</label>
        <input class="col-9 form-control" type="text" name="name" value="{{ $product->name }}">
        <label class="col-3 form-label">Description</label>
        <input class="col-9 form-control" type="text" name="description" value="{{ $product->description }}">
        <label class="col-3 form-label">Price</label>
        <input class="col-9 form-control" type="number" name="price" value="{{ $product->price }}">
        <button class="btn btn-primary" type="submit">Update</button>
    </form>
@endsection
