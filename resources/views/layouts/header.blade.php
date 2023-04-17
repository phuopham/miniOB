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
                <li class="nav-item {{ request()->is('orders') || request()->is('orders/*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('orders.index') }}">Đơn đã tạo</a>
                </li>
                <li class="nav-item {{ request()->is('cart') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cart.index') }}">Đơn đang lên</a>
                </li>
            </ul>
        </div>
    </div>
</nav>