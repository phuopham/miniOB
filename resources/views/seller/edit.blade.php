@extends('layouts.app')
@section('content')
    <div class="m-4">
        <a href="{{ route('purchases.index') }}">&lt;- <u>Quay về</u></a>
    </div>
    <h2>Sửa nhà cung cấp</h2>
    <form class="d-flex row" action="{{ route('purchases.update', $vendor->id) }}" method="post">
        @csrf
        @method('PUT')
        <label class="col-3 form-label">Tên nhà cung cấp:</label>
        <input class="col-9 form-control" type="text" name="name" value="{{ $vendor->name }}">
        <label class="col-3 form-label">Địa chỉ:</label>
        <input class="col-9 form-control" type="text" name="address" value="{{ $vendor->address }}">
        <label class="col-3 form-label">SĐT:</label>
        <input class="col-9 form-control" type="text" name="phone" value="{{ $vendor->phone }}">
        <label class="col-3 form-label">Note:</label>
        <input class="col-9 form-control" type="text" name="note" value="{{ $vendor->note }}">
        <button class="btn btn-primary" type="submit">Cập nhật</button>
    </form>
@endsection
