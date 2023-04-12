@extends('layouts.app')

@section('content')
    <p>{{ $notification['message'] ?? '' }}</p>
    <h2>orders</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Tel</th>
                <th>Note</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order['id'] }}</td>
                    <td>{{ $order['name'] }}</td>
                    <td>{{ $order['address'] }}</td>
                    <td>{{ $order['phone'] }}</td>
                    <td>{{ $order['note'] }}</td>
                    <td><a class="btn btn-primary" href="{{ route('orders.show', $order['id']) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('orders.edit', $order['id']) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Add new order</h3>
    <form class="d-flex row" action="{{ route('orders.store') }}" method="post">
        @csrf
        <label class="col-3 form-label" for="">Name</label>
        <input class="col-9 form-control" type="text" name="name" required id="">
        <label class="col-3 form-label" for="">Address</label>
        <input class="col-9 form-control" type="text" name="address" required id="">
        <label class="col-3 form-label" for="">Phone</label>
        <input class="col-9 form-control" type="text" name="phone" required id="">
        <label class="col-3 form-label" for="">Note</label>
        <input class="col-9 form-control" type="text" name="note" id="">
        <label class="col-3 form-label" for=""></label>
        <input class="btn btn-primary" type="submit" value="Add" />
    </form>
@endsection
