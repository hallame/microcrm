<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
        <a href="{{ route('admin.dashboard') }}" class="logo-text dark-logo1"> МИКРО ЦРМ</a>
        <a href="{{ route('admin.dashboard') }}" class="logo-small">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="Logo">
        </a>
    </div>
    <!-- /Logo -->
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>СУПЕР АДМИН</span></li>
                <li>
                    <ul>
                        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="ti ti-smart-home"></i><span> Главная</span>
                                <span class="badge badge-danger fs-10 fw-medium text-white p-1"><i class="ti ti-shield-lock text-white"></i></span>
                            </a>
                        </li>

                        <li class="submenu">
                            <a href="{{ route('admin.warehouses') }}" class="{{ request()->routeIs(['admin.warehouses', 'admin.warehouse.details']) ? 'active subdrop' : '' }}">
                                <i class="ti ti-users-group"></i><span>Склады</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.warehouses') }}" class="{{ request()->routeIs('admin.warehouses', 'admin.warehouse.add') ? 'active' : '' }}">Все склады</a></li>
                                <li><a href="#" class="{{ request()->routeIs('admin.warehouse.add') ? 'active' : '' }}" data-bs-toggle="modal" data-bs-target="#add_warehouse">Добавить склад</a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="{{ route('admin.products') }}" class="{{ request()->routeIs(['admin.products', 'admin.product.edit', 'admin.product.add.form', 'admin.product.add']) ? 'active subdrop' : '' }}">
                                <i class="ti ti-users-group"></i><span>Продукты</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products', 'admin.product.add', 'admin.product.edit') ? 'active' : '' }}">Все Продукты</a></li>
                                <li><a href="{{ route('admin.product.add.form') }}" class="{{ request()->routeIs('admin.product.add.form', 'admin.product.add') ? 'active' : '' }}">Добавить Продукт</a></li>
                            </ul>
                        </li>

                         <li class="submenu">
                            <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs(['admin.orders', 'admin.order.edit', 'admin.order.add.form']) ? 'active subdrop' : '' }}">
                                <i class="ti ti-users-group"></i><span>Заказы</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders', 'admin.order.add') ? 'active' : '' }}">Все Заказы</a></li>
                                <li><a href="{{ route('admin.order.add.form') }}" class="{{ request()->routeIs('admin.order.add', 'admin.order.add.form') ? 'active' : '' }}">Создать Заказ</a></li>
                            </ul>
                        </li>

                        <li class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                            <a href="{{ route('admin.orders') }}">
                                <i class="ti ti-smart-home"></i><span> Заказы</span>
                                <span class="badge badge-success fs-10 fw-medium text-white p-1">New</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap');
    .logo-text {
        font-size: 20px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: block;
        font-family: "Roboto", sans-serif;
    }

    .logo-normal {
        color: #2C3E50;
    }

    .logo-small {
        font-size: 20px;
        color: #3498DB;
    }

    .dark-logo1 {
        color: white;
        padding: 5px 10px 30px 5px;
        text-shadow: 1px 1px 3px rgba(247, 74, 0, 0.9);
    }
</style>

