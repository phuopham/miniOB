@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between m-4">
    <a href="{{ route('customers.index') }}">&lt;- <u>Quay về</u></a>
    <a href="{{ route('customers.edit', $customer->id) }}"><u>Sửa khách hàng</u> -&gt;</a>
</div>
<h2>Customer detail</h2>
<div class="d-flex row">
    <p class="col-2 form-label">Tên:</p>
    <p class="col-9">{{ $customer->name }}</p>
    <p class="col-2 form-label">Địa chỉ:</p>
    <p class="col-9">{{ $customer->address }}</p>
    <p class="col-2 form-label">SĐT:</p>
    <p class="col-9">{{ $customer->phone }}</p>
    <p class="col-2 form-label">Note:</p>
    <p class="col-9">{{ $customer->note }}</p>
</div>
@endsection