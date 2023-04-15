@extends('layouts.app')

@section('content')
    <p>{{ $notification['message'] ?? '' }}</p>
    <div class="d-flex justify-content-between">
        <h2>Customers</h2>
        <form action="{{ route('customers.index') }}">
            <a class="btn btn-warning" href="{{ route('customers.index') }}">Clear</a>
            <input class="form-control d-inline" type="text" name="search" id="">
            <button class="btn btn-warning" type='submit'>Search</button>
        </form>
    </div>

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
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->note }}</td>
                    <td>
                        <form class="d-inline" action="{{ route('cart.addCustomer') }}" method="post">
                            @csrf
                            <input type="text" name="customer" hidden value='{{ $customer }}'>
                            <button class="btn btn-danger">Create
                                order</button>
                        </form>
                        <a class="btn btn-primary" href="{{ route('customers.show', $customer->id) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('customers.edit', $customer->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $customers->links() }}
    <h3>Add new customer</h3>
    <form class="d-flex row" action="{{ route('customers.store') }}" method="post">
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

{{-- @section('javascript')
    <script>
        function addCustomer(customer) {
            let cusInStore = JSON.parse(localStorage.getItem('customer'));
            if (cusInStore != null) {
                let result = confirm('Are you sure you want change the customer?');
                if (result) {
                    localStorage.setItem('customer', JSON.stringify(customer));
                }
            } else {
                localStorage.setItem('customer', JSON.stringify(customer));
            }
            location.reload();
        }
    </script>
@endsection --}}
