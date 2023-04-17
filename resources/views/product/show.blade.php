@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between m-4">
    <a href="{{ route('products.index') }}">&lt;- <u>Quay về</u></a>
    <a href="{{ route('products.edit', $product->id) }}"><u>Sửa sản phẩm</u> -&gt;</a>
</div>
<h2>Chi tiết sản phẩm</h2>
<div class="d-flex row">
    <p class="col-2 form-label">Tên sản phẩm:</p>
    <p class="col-9">{{ $product->name }}</p>
    <p class="col-2 form-label">Mô tả:</p>
    <p class="col-9">{{ $product->description ?? '' }}</p>
    <p class="col-2 form-label">Giá:</p>
    <p class="col-9">{{ $product->price }}</p>
</div>
@endsection