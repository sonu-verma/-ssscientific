<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">SSS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->fullname }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
{{--        <div class="form-inline">--}}
{{--            <div class="input-group" data-widget="sidebar-search">--}}
{{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search"--}}
{{--                       aria-label="Search">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-sidebar">--}}
{{--                        <i class="fas fa-search fa-fw"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ ($prefix == '' && $controllerName == 'DashboardController')?'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard</p>
                        </p>
                    </a>
                </li>
                <li class="nav-header"></li>
                <li class="nav-item  {{ $prefix == 'admin'?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ $prefix == 'admin'?'active':'' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Master Info
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roles') }}" class="nav-link  {{ $controllerName == 'RolesController'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories') }}" class="nav-link  {{ $controllerName == 'CategoryController'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customers') }}" class="nav-link  {{ $controllerName == 'CustomerController'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products') }}" class="nav-link {{ $controllerName == 'ProductController'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  {{ ($prefix == '' && $controllerName == 'QuoteController')?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ ($prefix == '' && $controllerName == 'QuoteController')?'active':'' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Quote Info
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('quotes') }}" class="nav-link  {{ $controllerName == 'QuoteController'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quotations</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  {{ ($prefix == '' && ($controllerName == 'InvoiceController' || $controllerName == 'PurchaseOrderController'))?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ ($prefix == '' && $controllerName == 'InvoiceController')?'active':'' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Order Info
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('purchase.orders') }}" class="nav-link  {{ $controllerName == 'PurchaseOrderController'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchase Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('invoices') }}" class="nav-link  {{ $controllerName == 'InvoiceController'?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoices</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
