<section>
    <div class="m-5 p-5" style="height:500px;">

    </div>
    <div id="cart-box" class="fixed-bottom d-flex row justify-content-between align-items-end m-2">
        <div class=" d-none d-md-block col-5 bg-teal shadow-lg rounded rounded-3 ">

            <marquee behavior="alternate">
                Truy cập vào link: "http://{{ gethostbyname(gethostname()) }}/" bằng trình duyệt để truy cập vào app
                trên điện thoại. Yêu cầu máy tính bật và điện thoại kết nối không dây vào chung mạng với mạng máy tính!
            </marquee>
            <div class="d-flex justify-content-between">
                <div>
                    http://{{ gethostbyname(gethostname()) }}/
                </div>
                <div>
                    Design by Phuong
                </div>
            </div>
        </div>
        @if ($cart->customer != '' || $cart->products != '[]')
            <div class=" col-12 col-md-6 col-xl-4 bg-teal shadow-lg rounded rounded-3 "
                {{ request()->is('cart') ? 'hidden' : '' }}>
                <div class="d-flex align-items-center justify-content-between">
                    <h4>Cart</h4>
                    <a class="btn btn-secondary"
                        onclick="return confirm('Are you sure you want to delete current cart?')"
                        href="{{ route('cart.cancel') }}">Hủy đơn</a>
                    <a href="{{ route('cart.index') }}"><u>Tới đơn hàng -&gt;</u></a>
                </div>
                @if ($cart->customer != '')
                    <div>Tên khách: {{ json_decode($cart->customer)->name }}</div>
                @else
                    <div>Thêm <a href="{{ route('customers.index') }}">khách hàng</a></div>
                @endif
                <div>Sản phẩm</div>
                @if ($cart->products != '[]')
                    <ul>
                        @foreach (json_decode($cart->products) as $product)
                            <li class="mb-2">
                                <form class="d-inline" action="{{ route('cart.removeProduct') }}" method="post">
                                    @csrf
                                    <input type="text" name="product" hidden value='{{ json_encode($product) }}'>

                                    <button class="btn btn-danger" type="submit">Xóa</button>
                                </form>
                                {{ $product->name }} - {{ $product->quantity }}
                                <form class="d-inline" action="{{ route('cart.reduceQuantity') }}" method="post">
                                    @csrf
                                    <input type="text" name="product" hidden value='{{ json_encode($product) }}'>
                                    <button class="btn btn-secondary px-3">-</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div>Thêm <a href="{{ route('products.index') }}">sản phẩm</a></div>
                @endif
            </div>
        @endif
    </div>
</section>
