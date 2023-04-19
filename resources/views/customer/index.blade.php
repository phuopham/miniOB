@extends('layouts.app')

@section('content')
<div class="d-md-flex justify-content-between">
    <h2>Danh sách khách hàng</h2>
    <form action="{{ route('customers.index') }}">
        <a class="btn btn-warning" href="{{ route('customers.index') }}">Xóa</a>
        <input class="form-control d-inline" style="width:200px;" type="text" name="search" id=""
            placeholder="Tìm khách">
        <button class="btn btn-warning" type='submit'>Tìm kiếm</button>
    </form>
</div>

<table class="table">
    <thead>
        <tr>
            <th class="d-none d-sm-table-cell">STT</th>
            <th>Tên</th>
            <th class="d-none d-md-table-cell">Địa chỉ</th>
            <th class="d-none d-md-table-cell">SĐT</th>
            <th class="d-none d-md-table-cell">Note</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr>
            <td class="d-none d-sm-table-cell">{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td class="d-none d-md-table-cell">{{ $customer->address }}</td>
            <td class="d-none d-md-table-cell">{{ $customer->phone }}</td>
            <td class="d-none d-md-table-cell">{{ $customer->note }}</td>
            <td>
                <form class="d-inline" action="{{ route('cart.addCustomer') }}" method="post">
                    @csrf
                    <input type="text" name="customer" hidden value='{{ $customer }}'>
                    <button class="btn btn-danger">Tạo đơn</button>
                </form>
                <a class="btn btn-primary" href="{{ route('customers.show', $customer->id) }}">Xem</a>
                <a class="btn btn-warning" href="{{ route('customers.edit', $customer->id) }}">Sửa</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $customers->links() }}
<h3>Add new customer</h3>
<form class="d-flex row" action="{{ route('customers.store') }}" method="post">
    @csrf
    <label class="col-3 form-label" for="">Tên khách mới</label>
    <input class="col-9 form-control" type="text" name="name" required id="">
    <label class="col-3 form-label" for="">Địa chỉ</label>
    <input class="col-9 form-control" type="text" name="address" required id="">
    <label class="col-3 form-label" for="">SĐT</label>
    <input class="col-9 form-control" type="text" name="phone" required id="">
    <label class="col-3 form-label" for="">Note</label>
    <input class="col-9 form-control" type="text" name="note" id="">
    <label class="col-3 form-label" for=""></label>
    <input class="btn btn-primary" type="submit" value="Thêm khách" />
</form>
@endsection
