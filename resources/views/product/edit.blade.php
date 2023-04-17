@extends('layouts.app')
@section('content')
<div class="m-4">
    <a href="{{ route('products.index') }}">&lt;- <u>Quay về</u></a>
    {{-- <a href="{{ route('products.index') }}">Edit -&gt;</a> --}}
</div>
<h2>Sửa sản phẩm</h2>
<form class="d-flex row" action="{{ route('products.update', $product->id) }}" method="post">
    @csrf
    @method('PUT')
    <label class="col-3 form-label">Tên sản phẩm:</label>
    <input class="col-9 form-control" type="text" name="name" value="{{ $product->name }}">
    <label class="col-3 form-label">Mô tả</label>
    <input class="col-9 form-control" type="text" name="description" value="{{ $product->description }}">
    <label class="col-3 form-label">Giá</label>
    <input class="col-9 form-control" type="number" name="price" value="{{ $product->price }}">
    <button class="btn btn-primary" type="submit">Cập nhật</button>
</form>
@endsection