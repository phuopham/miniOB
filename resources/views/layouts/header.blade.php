<nav class="navbar navbar-expand-lg bg-light shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <strong>Shop của Nguyệt</strong>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('index.index') }}">Trang chủ</a>
                </li>

                <li class="nav-item {{ request()->is('customers') || request()->is('customers/*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customers.index') }}">Khách hàng</a>
                </li>

                <li class="nav-item {{ request()->is('products') || request()->is('products/*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('products.index') }}">Sản phẩm</a>
                </li>
                {{-- <li class="nav-item {{ request()->is('orders') || request()->is('orders/*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('orders.index') }}">Đơn đã tạo</a>
                </li>
                <li class="nav-item {{ request()->is('cart') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cart.index') }}">Đơn đang lên</a>
                </li> --}}

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Đơn hàng
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="nav-link {{ request()->is('cart') ? 'active' : '' }}"
                                href="{{ route('cart.index') }}">Đơn đang lên</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="nav-link {{ request()->is('orders') || request()->is('orders/*') ? 'active' : '' }}"
                                href="{{ route('orders.index') }}">Đơn bán</a></li>
                        <li><a class="nav-link {{ request()->is('purchases') || request()->is('purchases/*') ? 'active' : '' }}"
                                href="{{ route('purchases.index') }}">Đơn nhập</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
