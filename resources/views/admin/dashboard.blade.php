@extends('admin.layout.master')
@section('title') Панель управления @endsection
@section('content')

    <!-- Welcome Wrap -->
    <div class="welcome-wrap mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div class="mb-3">
                <h2 class="mb-1 text-white">Добро пожаловать, Админ!</h2>
            </div>
            <div class="d-flex align-items-center flex-wrap mb-1">
                <!-- Кнопка: Добавить продукт -->
                <a href="{{ route('admin.product.add.form') }}" class="btn btn-dark btn-md me-2 mb-2">
                    <i class="ti ti-circle-plus me-2"></i>Добавить продукт
                </a>
                <!-- Кнопка: Добавить заказ -->
                <a href="{{ route('admin.order.add.form') }}" class="btn btn-light btn-md mb-2">
                    <i class="ti ti-calendar me-2"></i>Создать заказ
                </a>
            </div>
        </div>
        <div class="welcome-bg">
            <img src="{{ asset('assets/back/img/bg/welcome-bg-02.svg') }}" alt="img" class="welcome-bg-01">
            <img src="{{ asset('assets/back/img/bg/welcome-bg-03.svg') }}" alt="img" class="welcome-bg-02">
            <img src="{{ asset('assets/back/img/bg/welcome-bg-01.svg') }}" alt="img" class="welcome-bg-03">
        </div>
    </div>
    <!-- /Welcome Wrap -->

    <div class="row">
        <!-- Продукты -->
        <div class="col-xl-3 col-md-6">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-md br-10 icon-rotate bg-primary flex-shrink-0">
                            <span class="d-flex align-items-center"><i class="ti ti-package text-white fs-16"></i></span>
                        </div>
                        <div class="ms-3">
                            <p class="fw-medium text-truncate mb-1">Продукты</p>
                            <h5>{{ $totalProducts }}</h5>
                        </div>
                    </div>
                    <span class="position-absolute top-0 end-0">
                        <img src="{{ asset('assets/back/img/bg/card-bg-04.png') }}" alt="Img">
                    </span>
                </div>
            </div>
        </div>

        <!-- Заказы -->
        <div class="col-xl-3 col-md-6">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-md br-10 icon-rotate bg-secondary flex-shrink-0">
                            <span class="d-flex align-items-center"><i class="ti ti-clipboard-list text-white fs-16"></i></span>
                        </div>
                        <div class="ms-3">
                            <p class="fw-medium text-truncate mb-1">Заказы</p>
                            <h5>{{ $totalOrders }}</h5>
                        </div>
                    </div>
                    <span class="position-absolute top-0 end-0">
                        <img src="{{ asset('assets/back/img/bg/card-bg-04.png') }}" alt="Img">
                    </span>
                </div>
            </div>
        </div>

        <!-- Клиенты -->
        <div class="col-xl-3 col-md-6">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-md br-10 icon-rotate bg-danger flex-shrink-0">
                            <span class="d-flex align-items-center"><i class="ti ti-users-group text-white fs-16"></i></span>
                        </div>
                        <div class="ms-3">
                            <p class="fw-medium text-truncate mb-1">Клиенты</p>
                            <h5>{{ $totalCustomers }}</h5>
                        </div>
                    </div>
                    <span class="position-absolute top-0 end-0">
                        <img src="{{ asset('assets/back/img/bg/card-bg-04.png') }}" alt="Img">
                    </span>
                </div>
            </div>
        </div>

        <!-- Склады -->
        <div class="col-xl-3 col-md-6">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-md br-10 icon-rotate bg-info flex-shrink-0">
                            <span class="d-flex align-items-center"><i class="ti ti-building-warehouse text-white fs-16"></i></span>
                        </div>
                        <div class="ms-3">
                            <p class="fw-medium text-truncate mb-1">Склады</p>
                            <h5>{{ $totalWarehouses }}</h5>
                        </div>
                    </div>
                    <span class="position-absolute top-0 end-0">
                        <img src="{{ asset('assets/back/img/bg/card-bg-04.png') }}" alt="Img">
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                        <h5>Последние заказы</h5>
                        <div>
                            <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-primary px-3">Показать все</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        @if($latestOrders->isEmpty())
                            @include('partials.empty')
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Клиент</th>
                                        <th>Продукты</th>
                                        <th>Итого</th>
                                        <th>Склад</th>
                                        <th>Статус</th>
                                        <th>Дата создания</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($latestOrders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->customer }}</td>
                                            <td>
                                                @foreach($order->items as $item)
                                                    • {{ $item->product->name ?? 'удалено' }} (x{{ $item->count }})<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ number_format($order->items->sum(fn($pos) => $pos->product->price * $pos->count), 2, ',', ' ') }} ₽
                                            </td>
                                            <td>{{ $order->warehouse->name ?? '—' }}</td>
                                            <td>
                                                @if($order->status === 'completed')
                                                    <span class="badge bg-success">Завершён</span>
                                                @elseif($order->status === 'canceled')
                                                    <span class="badge bg-danger">Отменён</span>
                                                @else
                                                    <span class="badge bg-warning">Активен</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        {{-- Блок: Список складов --}}
        <div class="col-xl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                        <h5>Склады</h5>
                        <div>
                            <a href="{{ route('admin.warehouses') }}" class="btn btn-sm btn-primary px-3">Показать все</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Проверка: есть ли склады --}}
                    @if($warehouses->isEmpty())
                        @include('partials.empty')
                    @else
                        @foreach ($warehouses as $warehouse)
                            @php
                                // Случайные классы оформления
                                $borderClasses = ['border-primary', 'border-info', 'border-success', 'border-danger', 'border-dark'];
                                $bgClasses = ['bg-primary', 'bg-info', 'bg-success', 'bg-danger', 'bg-dark'];

                                $randomBorder = $borderClasses[array_rand($borderClasses)];
                                $randomBg = $bgClasses[array_rand($bgClasses)];
                            @endphp

                            {{-- Карточка склада --}}
                            <div class="border border-dashed bg-body-secondary rounded p-2 mb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="d-block border border-3 h-12 {{ $randomBorder }} rounded-5 me-2" style="height: 50px;"></span>
                                        <div>
                                            <h6 class="fw-medium mb-1 text-truncate">
                                                {{ Str::limit($warehouse->name, 50) }}
                                            </h6>
                                            <p>
                                                Добавлен: {{ \Carbon\Carbon::parse($warehouse->created_at)->format('d/m/Y') }} <br>
                                                Обновлен: {{ \Carbon\Carbon::parse($warehouse->updated_at)->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        {{-- Общее количество товаров на складе --}}
                                        <div class="circle-border {{ $randomBg }} d-flex justify-content-center align-items-center"
                                            style="width: 40px; height: 40px; border-radius: 50%; font-size: 14px;">
                                            <div class="text-black text-bold circle-border bg-body d-flex justify-content-center align-items-center"
                                                style="width: 37px; height: 37px; border-radius: 50%; font-size: 14px; font-weight: 600">
                                                {{ $warehouse->stocks->sum('stock') }}
                                            </div>
                                        </div>
                                        <span class="ms-2">единиц</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>


        <!-- История движения товаров -->
        <div class="col-xl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <h5 class="mb-0">Последние перемещения</h5>
                        @if ($latestMovements->count())
                            <a href="#" class="btn btn-sm btn-primary">Показать все</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if ($latestMovements->count())
                        @foreach ($latestMovements as $movement)
                            @php
                                $quantity = $movement->quantity;
                                $type = $movement->type;

                                $bgColor = match($type) {
                                    'create'     => 'bg-success',
                                    'update'     => 'bg-primary',
                                    'cancel'     => 'bg-danger',
                                    'complete'   => 'bg-warning',
                                    'reactivate' => 'bg-info',
                                    'delete'     => 'bg-dark',
                                    'order'      => 'bg-secondary',
                                    default      => 'bg-purple',
                                };

                                $typeLabel = match($type) {
                                    'create'     => 'Создание',
                                    'update'     => 'Обновление',
                                    'cancel'     => 'Отмена',
                                    'complete'   => 'Завершение',
                                    'reactivate' => 'Возобновление',
                                    'delete'     => 'Удаление',
                                    'order'      => 'Заказ',
                                    default      => 'Неизвестно',
                                };
                            @endphp

                            <div class="d-flex align-items-center justify-content-between mb-2 p-2 rounded shadow-sm {{ $bgColor }} text-white">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/images/box.png') }}" class="rounded-circle border border-2" alt="Склад">
                                    </a>
                                    <div class="ms-3">
                                        <h6 class="fs-14 fw-bold text-truncate mb-1">
                                            {{ $movement->product->name ?? 'Продукт удалён' }}
                                            <span class="badge bg-dark">{{ $typeLabel }}</span>
                                        </h6>
                                        <p class="fs-13 mb-0">
                                            {{ $movement->warehouse->name ?? 'Склад удалён' }}:
                                            {{ $quantity > 0 ? '+' : '' }}{{ $quantity }} ед.
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <span class="fw-bold fs-12">
                                        <i class="ti ti-clock fs-14 me-1"></i>
                                        {{ $movement->created_at->format('d.m.Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @include('partials.empty')
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                    <h5>Продукты</h5>
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="{{ route('admin.products') }}" class="btn btn-md btn-primary px-3">Показать все</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        @if($products->isEmpty())
                            @include('partials.empty')
                        @else
                            <table class="table table-nowrap dashboard-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Наименование</th>
                                        <th>Цена</th>
                                        <th>Склады</th>
                                        <th>Общий остаток</th>
                                        <th>Обновлен</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            {{-- Название продукта --}}
                                            <td>
                                                <h6 class="fw-medium">{{ $product->name }}</h6>
                                            </td>

                                            {{-- Цена продукта --}}
                                            <td>{{ number_format($product->price, 2, ',', ' ') }} ₽</td>

                                            {{-- Перечисление складов, где есть продукт --}}
                                            <td>
                                                @foreach ($product->stocks as $stock)
                                                    <div>
                                                        {{ $stock->warehouse->name ?? '—' }} ({{ $stock->stock }})
                                                    </div>
                                                @endforeach
                                            </td>

                                            {{-- Общий остаток по всем складам --}}
                                            <td>{{ $product->stocks->sum('stock') }} единиц</td>

                                            <td>
                                                {{ optional($product->movements()->latest()->first())->created_at?->format('d/m/Y H:i') ?? '---' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

