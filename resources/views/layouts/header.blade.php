<nav class="navbar navbar-expand-lg bg-light shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <strong>Hi Nguyet</strong>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link " href="#hero">Home</a>
                </li>

                <li class="nav-item {{ request()->is('customers/*') ? 'active' : '' }}">
                    <a class="nav-link" href="customers">Customers</a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Portfolio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#news">News & Events</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact Us</a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>