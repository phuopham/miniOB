@extends('layouts.app')
@section('content')
    <div class="m-4">
        <a href="{{ route('customers.index') }}">&lt;- <u>Quay về</u></a>
    </div>
    <h2>Sửa khách hàng</h2>
    <form class="d-flex row" action="{{ route('customers.update', $customer->id) }}" method="post">
        @csrf
        @method('PUT')
        <label class="col-3 form-label">Tên khách hàng:</label>
        <input class="col-9 form-control" type="text" name="name" value="{{ $customer->name }}">
        <label class="col-3 form-label">Địa chỉ:</label>
        <input class="col-9 form-control" type="text" name="address" value="{{ $customer->address }}">
        <label class="col-3 form-label">SĐT:</label>
        <input class="col-9 form-control" type="text" name="phone" value="{{ $customer->phone }}">
        <label class="col-3 form-label">Note:</label>
        <input class="col-9 form-control" type="text" name="note" value="{{ $customer->note }}">
        <button class="btn btn-primary" type="submit">Cập nhật</button>
    </form>
@endsection
