@extends('layouts.app')

@section('content')
    <div>
        <h2>Lên đơn nhập</h2>
        <div id="customer">
            @if ($customer != null)
                <div class="d-flex row align-items-center">
                    <b class="col-2">Tên nhà cung cấp:</b>
                    <span class="col-3">{{ $customer->name }}</span>
                    <b class="col-2">Địa chỉ:</b>
                    <span class="col-5">{{ $customer->address }}</span>
                    <b class="col-2">SĐT:</b>
                    <span class="col-3">{{ $customer->phone }}</span>
                    <b class="col-2">Note:</b>
                    <span class="col-5">{{ $customer->note }}</span>
                </div>
            @endif
        </div>
        <form action="{{ route('purchases.addVendor') }}" class="d-flex align-items-center my-3" method="post">
            @csrf
            @if ($customer == null)
                <label class="form-label" for="">Nhà cung cấp: </label>
            @endif
            <select name="vendor" class="form-select w-1/3 me-3" id="">
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                @endforeach
            </select>
            @if ($customer != null)
                <button class="btn btn-primary" type="submit">Đổi nhà cung cấp này</button>
            @else
                <button class="btn btn-primary" type="submit">Chọn nhà cung cấp này</button>
            @endif
        </form>
        <div class="">
            <table class="table">
                <thead>
                    <tr>
                        <td class="d-none d-sm-table-cell">STT</td>
                        <td>Sản phẩm</td>
                        <td>Số lượng</td>
                        <td class="d-none d-sm-table-cell">Giá</td>
                        <td>Giá thành</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="cart">
                    @foreach ($products as $product)
                        <tr>
                            <td class="d-none d-sm-table-cell">{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                {{ $product->quantity }}
                            </td>
                            <td class="d-none d-sm-table-cell">{{ $product->price }}</td>
                            <td>{{ $product->quantity * $product->price }}</td>
                            <td>
                                <form class="d-inline" action="{{ route('purchases.removeProduct') }}" method="post">
                                    @csrf
                                    <input type="text" name="product" hidden value='{{ json_encode($product) }}'>

                                    <button class="btn btn-danger" type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <form action="{{ route('purchases.store') }}" method="post">
                    @csrf
                    <tfoot>
                        <tr>
                            <td class="d-none d-sm-table-cell"></td>
                            <td>Ship fee</td>
                            <td></td>
                            <td class="d-none d-sm-table-cell"></td>
                            <td><input style="width:80px;" type="number" name="ship" id="ship-fee"
                                    value="{{ $ship }}">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="d-none d-sm-table-cell"></td>
                            <td>Total</td>
                            <td></td>
                            <td class="d-none d-sm-table-cell"></td>
                            <td id="total">{{ $total }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
            </table>
        </div>
    </div>
    <a class="btn btn-secondary" onclick="return confirm('Are you sure you want to delete current cart?')"
        href="{{ route('purchases.cancel') }}">Hủy đơn</a>

    <input type="text" name="customer" hidden value='{{ json_encode($customer) }}' id="">
    <input type="text" name="products" hidden value=' {{ json_encode($products) }}'>
    <button id="submit-order" {{ $customer == null || $total == null ? 'disabled' : '' }} type="submit"
        class="btn btn-danger">Tạo đơn</button>
    </form>

    <form action="{{ route('purchases.addProduct') }}" method="post">
        @csrf
        <div>
            <label style="width:200px;" for="">Tên sản phẩm:</label>
            <select name="product_id" class="form-select mt-1 d-inline" id="">
                @foreach ($allProducts as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label style="width:200px;" for="">Số lượng:</label>
            <input type="number" class='form-control d-inline' name="quantity" value="1" min="1">
        </div>
        <div>
            <label style="width:200px;" for="">Giá:</label>
            <input type="number" class='form-control d-inline' name="price">
        </div>
        <div>
            <button class="btn btn-warning" type="submit">Thêm</button>
        </div>
    </form>
@endsection

@section('javascript')
    <script>
        let shipFee = document.querySelector('#ship-fee');
        let total = document.querySelector('#total');
        shipFee.addEventListener('input', function() {
            total.innerHTML = ({{ $total }} + Number(shipFee.value));
        });
    </script>
@endsection
