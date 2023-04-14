@extends('layouts.app')

@section('content')
    <h2>Welcome to Mini Online Business</h2>
    <p>Khi tạo đơn hàng mới cần tạo từ bảng <a href="{{ route('customers.index') }}"><u>customer</u></a>!</p>
@endsection
