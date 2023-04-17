@extends('layouts.app')

@section('content')
<p>{{ $notification['message'] ?? '' }}</p>
<div class="d-md-flex justify-content-between">
    <h2>Danh sách sản phẩm</h2>
    <form action="{{ route('products.index') }}">
        <a class="btn btn-warning" href="{{ route('products.index') }}">Xóa</a>
        <input class="form-control d-inline" style="width:200px;" type="text" name="search" id=""
            placeholder="Tìm kiếm sản phẩm">
        <button class="btn btn-warning" type='submit'>Tìm kiếm</button>
    </form>
</div>

<table class="table">
    <thead>
        <tr>
            <th class="d-none d-sm-table-cell">STT</th>
            <th>Tên sản phẩm</th>
            <th class="d-none d-sm-table-cell">Mô tả</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td class="d-none d-sm-table-cell">{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td class="d-none d-sm-table-cell">{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td><a class="btn btn-primary" href="{{ route('products.show', $product->id) }}">Xem</a>
                <a class="btn btn-warning" href="{{ route('products.edit', $product->id) }}">Sửa</a>
                <form class="d-inline" action="{{ route('cart.addProducts') }}" method="post">
                    @csrf
                    <input type="text" name="products" hidden value='{{ $product }}'>
                    <button class="btn btn-danger">Thêm vào đơn</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $products->links() }}
<h3>Tạo sản phẩm mới</h3>
<form class="d-flex row" action="{{ route('products.store') }}" method="post">
    @csrf
    <label class="col-3 form-label" for="">Tên sản phẩm:</label>
    <input class="col-9 form-control" type="text" name="name" required id="">
    <label class="col-3 form-label" for="">Mô tả:</label>
    <input class="col-9 form-control" type="text" name="description" id="">
    <label class="col-3 form-label" for="">Giá</label>
    <input class="col-9 form-control" type="number" name="price" required id="">
    <input class="btn btn-primary" type="submit" value="Tạo sản phẩm" />
</form>
@endsection

{{-- @section('javascript')
<script>
    function addItem(product) {
            product.quantity = 1
            console.log(product)
            let cart = JSON.parse(localStorage.getItem('products'));
            console.log(cart)
            if (cart != null) {
                var foundIndex = cart.findIndex(item => item.id === product.id);
                if (foundIndex !== -1) {
                    cart[foundIndex].quantity += product.quantity;
                } else {
                    cart.push(product);
                }
                localStorage.setItem('products', JSON.stringify(cart));
            } else {
                localStorage.setItem('products', JSON.stringify([product]));
            }
            location.reload();
        }
</script>
@endsection --}}