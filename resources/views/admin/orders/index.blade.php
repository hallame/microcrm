@extends('admin.layout.master')
@section('title') Заказы @endsection
@section('content')


    <div class="row">
        {{-- Всего заказов --}}
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <span class="p-2 br-10 bg-primary-transparent border border-primary d-flex align-items-center justify-content-center">
                                    <i class="ti ti-shopping-cart fs-18 text-primary"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Всего заказов</p>
                                <h4>{{ $totalOrders }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- В ожидании --}}
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <span class="p-2 br-10 bg-warning-transparent border border-warning d-flex align-items-center justify-content-center">
                                    <i class="ti ti-clock fs-18 text-warning"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">В ожидании</p>
                                <h4>{{ $pendingOrders }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Завершённые --}}
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <span class="p-2 br-10 bg-success-transparent border border-success d-flex align-items-center justify-content-center">
                                    <i class="ti ti-check fs-18 text-success"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Завершено</p>
                                <h4>{{ $completedOrders }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Последний заказ --}}
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <span class="p-2 br-10 bg-secondary border border-info d-flex align-items-center justify-content-center">
                                    <i class="ti ti-calendar fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Последний заказ</p>
                                <h6>{{ $lastOrderDate ? $lastOrderDate->format('d/m/Y H:i') : 'Нет' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <div class="card">
        <div class="card-body p-3">
            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                <div class="d-flex align-items-center flex-wrap row-gap-3">
                    <!-- Фильтр по статусу -->
                    <div class="dropdown me-3">
                        <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                            Статус заказа
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3" id="status-dropdown">
                            <li>
                                <a href="{{ route('admin.orders', ['status' => 'all']) }}" class="dropdown-item rounded-1">Все</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders', ['status' => 'active']) }}" class="dropdown-item rounded-1">Ожидает</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders', ['status' => 'completed']) }}" class="dropdown-item rounded-1">Завершён</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders', ['status' => 'canceled']) }}" class="dropdown-item rounded-1">Отменён</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Фильтр по периоду -->
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                            Период: Последние 7 дней
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3" id="period-dropdown">
                            <li>
                                <a href="{{ route('admin.orders', ['period' => 'recently_added']) }}" class="dropdown-item rounded-1">Недавно добавленные</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders', ['period' => 'last_month']) }}" class="dropdown-item rounded-1">Последний месяц</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders', ['period' => 'last_7_days']) }}" class="dropdown-item rounded-1">Последние 7 дней</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Кнопка добавления (не liée à заказы ici, à adapter au besoin) -->
                <div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_order" class="btn btn-primary d-flex align-items-center text-center">
                        <i class="ti ti-circle-plus me-2"></i>Добавить заказ
                    </a>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-xl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    @if($orders->isEmpty())
                        @include('partials.empty')
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Клиент</th>
                                        <th>Продукты</th>
                                        <th>Итого</th>
                                        <th>Статус</th>

                                        <th>Дата</th>
                                        <th>Действия</th>
                                        <th>Склад</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->customer ?? 'Неизвестный' }}</td>
                                            <td>
                                                @foreach($order->items as $item)
                                                    • {{ $item->product->name ?? 'удалено' }} (x{{ $item->count }})<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ number_format($order->items->sum(fn($pos) => $pos->product->price * $pos->count), 2, ',', ' ') }} ₽
                                            </td>
                                            <td>
                                                @php
                                                    $status = $order->status;

                                                    // Traductions en russe
                                                    $statusLabels = [
                                                        'active' => 'В ожидании',
                                                        'completed' => 'Завершён',
                                                        'canceled' => 'Отменён',
                                                    ];

                                                    $badgeClass = match($status) {
                                                        'active' => 'bg-warning',
                                                        'completed' => 'bg-success',
                                                        'canceled' => 'bg-danger',
                                                        default => 'bg-secondary',
                                                    };

                                                    $translatedStatus = $statusLabels[$status] ?? 'Неизвестно';
                                                @endphp

                                                <span class="badge {{ $badgeClass }}">{{ $translatedStatus }}</span>
                                            </td>

                                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                             <td>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-info"
                                                        data-id="{{ $order->id }}"
                                                        data-name="{{ $order->name }}"
                                                        data-price="{{ $order->price }}"
                                                        data-warehouse="{{ $order->stock->warehouse_id ?? '' }}"
                                                        data-stock="{{ $order->stock->stock ?? 0 }}"
                                                        onclick="openEditProductModal(this)">
                                                        <i class="ti ti-edit"></i>
                                                    </a>



                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"
                                                    onclick="setDeleteLink({{ $order->id }})">
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                            </td>
                                            <td>{{ $order->warehouse->name }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

{{--
    <!-- Модальное окно: Добавить продукт -->
    <div class="modal fade" id="add_product" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Добавить продукт</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('admin.product.add') }}" method="POST">
                    @csrf
                    <div class="modal-body pb-0">
                        <div class="mb-3">
                            <label for="name" class="form-label">Название продукта <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Цена (₽) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" id="price" name="price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="warehouse_id" class="form-label">Склад <span class="text-danger">*</span></label>
                            <select name="warehouse_id" id="warehouse_id" class="form-control" required>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Начальный остаток <span class="text-danger">*</span></label>
                            <input type="number" id="stock" name="stock" class="form-control" min="0" required>
                        </div>
                        <div class="text-end me-3 mb-3">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Модальное окно: Редактировать продукт -->
    <div class="modal fade" id="edit_product" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Редактировать продукт</h5>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form id="editProductForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Название продукта</label>
                            <input type="text" id="edit_name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_price" class="form-label">Цена (₽)</label>
                            <input type="number" id="edit_price" name="price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_warehouse_id" class="form-label">Склад</label>
                            <select name="warehouse_id" id="edit_warehouse_id" class="form-control" required>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_stock" class="form-label">Остаток</label>
                            <input type="number" id="edit_stock" name="stock" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary mx-1">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Модальное окно: Подтверждение удаления -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                        <i class="ti ti-trash-x fs-36"></i>
                    </span>
                    <h4 class="mb-1">Подтвердите удаление</h4>
                    <p class="mb-3 text-danger">Удаление продукта необратимо.</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Отмена</a>
                        <form id="deleteForm" action="{{ route('admin.product.delete', ':id') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Да, удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <script>
        function setDeleteLink(id) {
            const form = document.getElementById('deleteForm');
            const action = form.getAttribute('action').replace(':id', id);
            form.setAttribute('action', action);
        }

        function openEditProductModal(el) {
        const form = document.getElementById('editProductForm');

        form.action = `/admin/products/update/${el.dataset.id}`;
        document.getElementById('edit_name').value = el.dataset.name;
        document.getElementById('edit_price').value = el.dataset.price;
        document.getElementById('edit_warehouse_id').value = el.dataset.warehouse;
        document.getElementById('edit_stock').value = el.dataset.stock;

        new bootstrap.Modal(document.getElementById('edit_product')).show();
    }


    </script>
@endsection
