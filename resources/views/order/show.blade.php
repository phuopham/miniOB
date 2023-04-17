<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hóa đơn</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">

    <link href="{{ URL('/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        @media screen {
            #screenOnly {
                display: block;
            }
        }

        @media print {
            #screenOnly {
                display: none;
            }
        }
    </style>
</head>

<body>
    <page size="A4">
        <a class="btn btn-primary m-5" id="screenOnly" href="{{ route('orders.index') }}">Quay về</a>
        <h2 class="text-center"> Hóa đơn</h2>
        <p class="text-center"><i>Số hóa đơn:</i>
            <span>{{ $order->id }}</span>
        </p>
        <div class=" my-4">

            <p><span>Tên cửa hàng:</span>
                <span>Shop của Nguyệt</span>
            </p>

            <p><span>Địa chỉ:</span>
                <span>227 Ngọc Lâm - Long Biên - Hà Nội</span>
            </p>
            <p><span>SĐT / Zalo:</span>
                <span>0983737315</span>
            </p>
            <p><span>Facebook:</span>
                <span>https://www.facebook.com/bichnguyet.do.96</span>
            </p>
        </div>
        <div class="mb-4">
            <p><span>Tên khách:</span>
                <span>{{ $order->customer->name }}</span>
            </p>

            <p><span>Địa chỉ:</span>
                <span>{{ $order->customer->address }}</span>
            </p>
            <p><span> Note:</span>
                <span>{{ $order->customer->note }}</span>
            </p>
            <p><span>SĐT:</span>
                <span>{{ $order->customer->phone }}</span>
            </p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Giá thành</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDetail as $orderDetail)
                <tr>
                    <td>{{ $orderDetail->id }}</td>
                    <td>{{ $orderDetail->product->name }}</td>
                    <td>{{ $orderDetail->quantity }}</td>
                    <td>{{ $orderDetail->price }}</td>
                    <td>{{ $orderDetail->quantity * $orderDetail->price }}</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td>Phí vận chuyển</td>
                    <td></td>
                    <td></td>
                    <td>{{ $order->ship_price }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-primary">
                        {{ $order->orderDetail->sum(function ($orderDetail) {
                        return $orderDetail->price * $orderDetail->quantity;
                        }) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </page>
</body>
<script>
    window.print();
</script>

</html>