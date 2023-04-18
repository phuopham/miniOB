@extends('layouts.app')

@section('content')
<h2>Create Order</h2>
/////////////////////////////////////////
<form class="d-flex row" action="{{ route('orders.store') }}" method="post">
    @csrf
    <label class="col-3 form-label" for="">Name</label>
    <input class="col-9 form-control" type="text" name="name" required id="">
    <label class="col-3 form-label" for="">Description</label>
    <input class="col-9 form-control" type="text" name="description" id="">
    <label class="col-3 form-label" for="">Price</label>
    <input class="col-9 form-control" type="number" name="price" required id="">
    <input class="btn btn-primary" type="submit" value="Add" />
</form>
/////////////////////////////////////////////
<div class="form-group">
    <div class="d-flex align-items-center">
        <label for="">Add products</label>
        <button class="btn btn-info" onclick="onAddClick(event)">Add new product</button>
    </div>
    <div class="product-wrap">
        <div class="product">
            <div class="row">
                <div class="col-sm-6">
                    <label for="">Sản phẩm:</label>
                    <select name="products[]" id="">
                        @foreach ($products as $product)
                        <option value="{{ $product->name }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="">Quantity</label>
                    <input type="number" name="quantity[]">
                </div>
                <button class="btn  btn-danger btn-sm btn-product disabled" onclick="selfdelete(event)"> -
                </button>
            </div>
        </div>
        <div id="service__extend"></div>
    </div>
</div>
@endsection


@section('javascript')
<script>
    onAddClick = (event) => {
            event.preventDefault();
            $('.product:first').clone().insertBefore('#service__extend');
            // fix reinit select2
            $('.product:last').find('.select2-container').remove();
            // $('.product:last').find('.select2').removeClass('select2-hidden-accessible').removeAttr('data-select2-id')
            //     .removeAttr('tabindex').removeAttr('aria-hidden').select2({

            //     });
            if ($('.btn-product').length > 1)
                $('.btn-product').removeClass('disabled');
        }
        selfdelete = (event) => {
            event.preventDefault();

            if ($('.btn-product').length > 1) {
                if ($('.btn-product').length == 2) {
                    $(event.target).parents('.product').remove();
                    $('.btn-product').addClass('disabled');
                } else {
                    $(event.target).parents('.product').remove();
                    $('.btn-product').removeClass('disabled');
                }
            }


        }
</script>
@endsection