@extends('layouts.app')

@section('content')
    <p>{{ $notification['message'] ?? '' }}</p>
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
            {!! Form::label('join_date', __('Dịch vụ liệu trình') . ':*', [
                'class' => 'mb-0 mr-8',
            ]) !!}
            <button class="btn btn-info" onclick="onAddClick(event)">Thêm dịch vụ</button>
        </div>
        <div class="services-wrap">
            <div class="services">
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('services', __('Tên dịch vụ') . ':*') !!}
                        {!! Form::select('services[]', $services, null, [
                            'class' => 'form-control select2 service-select',
                        ]) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('timegap', __('Thời gian chờ:*')) !!}
                        {!! Form::number('timegap[]', 10, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <button class="btn  btn-danger btn-sm btn-services disabled" onclick="selfdelete(event)"> -
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
            $('.services:first').clone().insertBefore('#service__extend');
            // fix reinit select2
            $('.services:last').find('.select2-container').remove();
            $('.services:last').find('.select2').removeClass('select2-hidden-accessible').removeAttr('data-select2-id')
                .removeAttr('tabindex').removeAttr('aria-hidden').select2({

                });
            if ($('.btn-services').length > 1)
                $('.btn-services').removeClass('disabled');
        }
        selfdelete = (event) => {
            event.preventDefault();

            if ($('.btn-services').length > 1) {
                if ($('.btn-services').length == 2) {
                    $(event.target).parents('.services').remove();
                    $('.btn-services').addClass('disabled');
                } else {
                    $(event.target).parents('.services').remove();
                    $('.btn-services').removeClass('disabled');
                }
            }


        }
    </script>
@endsection
