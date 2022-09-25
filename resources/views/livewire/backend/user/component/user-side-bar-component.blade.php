<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="#" style="font-size: 3rem;font-weight: 900;color: #5e72e4;padding-bottom: 0;">
                Karman
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link active" href="{{route('dashboard')}}">--}}
{{--                            <i class="ni ni-tv-2 text-primary"></i>--}}
{{--                            <span class="nav-link-text">Dashboard</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.products')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Products</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.categories')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Categories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.cashier')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Cashier</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.debts')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Debts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.sellers')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Sellers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.bills')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Bills</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.sales')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Sales</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.contributions')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Contributions</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.incomes')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Incomes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.expenses')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Expenses</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.containers-manager')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Containers Manager</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backend.productsdatabase')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Products Database</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
