@extends('layouts.app')

@section('content')
    <p>{{ $notification['message'] ?? '' }}</p>
    <div class="d-flex justify-content-between">
        <h2>Products</h2>
        <form action="{{ route('products.index') }}">
            <a class="btn btn-warning" href="{{ route('products.index') }}">Clear</a>
            <input class="form-control d-inline" type="text" name="search" id="">
            <button class="btn btn-warning" type='submit'>Search</button>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td><a class="btn btn-primary" href="{{ route('products.show', $product->id) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('products.edit', $product->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
    <h3>Add new product</h3>
    <form class="d-flex row" action="{{ route('products.store') }}" method="post">
        @csrf
        <label class="col-3 form-label" for="">Name</label>
        <input class="col-9 form-control" type="text" name="name" required id="">
        <label class="col-3 form-label" for="">Description</label>
        <input class="col-9 form-control" type="text" name="description" id="">
        <label class="col-3 form-label" for="">Price</label>
        <input class="col-9 form-control" type="number" name="price" required id="">
        <input class="btn btn-primary" type="submit" value="Add" />
    </form>
@endsection
