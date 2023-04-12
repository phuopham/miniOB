@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between m-4">
        <a href="{{ route('products.index') }}">&lt;- <u>Back</u></a>
        <a href="{{ route('products.edit', $product->id) }}"><u>Edit</u> -&gt;</a>
    </div>
    <h2>Product detail</h2>
    <div class="d-flex row">
        <p class="col-2 form-label">Name</p>
        <p class="col-9">{{ $product->name }}</p>
        <p class="col-2 form-label">Description</p>
        <p class="col-9">{{ $product->description ?? '' }}</p>
        <p class="col-2 form-label">Price</p>
        <p class="col-9">{{ $product->price }}</p>
    </div>
@endsection
