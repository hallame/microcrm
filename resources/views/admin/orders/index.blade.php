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
                                        {{-- <th>#</th> --}}
                                        <th>Клиент</th>
                                        <th>Продукты</th>
                                        <th>Итого</th>
                                        <th>Дата</th>
                                        <th>Действия</th>
                                        <th>Склад</th>
                                       <th>Статус</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ $order->customer ?? 'Неизвестный' }}</td>
                                            <td>
                                                @foreach($order->items as $item)
                                                    • {{ $item->product->name ?? 'удалено' }} (x{{ $item->count }})<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ number_format($order->items->sum(fn($pos) => $pos->product->price * $pos->count), 2, ',', ' ') }} ₽
                                            </td>


                                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if ($order->status === 'completed')
                                                    <span><i class="ti ti-lock"></i> Завершен</span>
                                                @elseif ($order->status === 'canceled')
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal"
                                                        data-action="{{ route('admin.order.reactivate', $order->id) }}"
                                                        data-message="Вы уверены, что хотите возобновить заказ?">
                                                        <i class="ti ti-refresh"></i> Возобновить
                                                    </button>
                                                @else
                                                    <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-sm btn-info">
                                                        <i class="ti ti-edit"></i>
                                                    </a>

                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal"
                                                        data-action="{{ route('admin.order.complete', $order->id) }}"
                                                        data-message="Вы уверены, что хотите завершить заказ?">
                                                        <i class="ti ti-check"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal"
                                                        data-action="{{ route('admin.order.cancel', $order->id) }}"
                                                        data-message="Вы уверены, что хотите отменить заказ?">
                                                        <i class="ti ti-x"></i>
                                                    </button>
                                                @endif
                                            </td>

                                            <td>{{ $order->warehouse->name }}</td>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно: Добавить заказ -->
    <div class="modal fade" id="add_order" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создать заказ</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                        <i class="ti ti-x"></i>
                    </button>
                </div>

                <form action="{{ route('admin.order.add') }}" method="POST">
                    @csrf
                    <div class="modal-body pb-0">
                        <div class="mb-3">
                            <label for="customer" class="form-label">Имя клиента <span class="text-danger">*</span></label>
                            <input type="text" id="customer" name="customer" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="warehouse_id" class="form-label">Склад <span class="text-danger">*</span></label>

                            <select id="warehouse_id" name="warehouse_id" class="form-control" required onchange="updateProductOptions()">
                                <option value="">-- Выберите склад --</option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <hr>
                        <h5>Товары в заказе</h5>
                        <div id="order-items">
                            <div class="row g-2 mb-2 order-item">
                                <div class="col-md-7">

                                    <select name="items[0][product_id]" class="form-control mt-2 product-select" required>
                                        <option value="">-- Сначала выберите склад --</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="items[0][count]" class="form-control" min="1" placeholder="Кол-во" required>
                                </div>
                                <div class="col-md-2 text-end">
                                    <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                                        <i class="ti ti-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 text-end">
                            <button type="button" class="btn btn-sm btn-secondary" onclick="addItem()">+ Добавить товар</button>
                        </div>

                        <div class="text-end me-3 mb-3">
                            <button type="submit" class="btn btn-primary">Сохранить заказ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <!-- Модальное окно: Подтверждение действия -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="avatar avatar-xl bg-transparent-warning text-warning mb-3">
                        <i class="ti ti-alert-circle fs-36"></i>
                    </span>
                    <h4 class="mb-2" id="confirmMessage">Вы уверены?</h4>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Отмена</button>
                        <form method="POST" id="confirmForm" action="">
                            @csrf
                            <button type="submit" class="btn btn-primary">Да, подтвердить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const confirmModal = document.getElementById('confirmModal');
        confirmModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const action = button.getAttribute('data-action');
            const message = button.getAttribute('data-message');

            const form = confirmModal.querySelector('#confirmForm');
            const messageEl = confirmModal.querySelector('#confirmMessage');

            form.setAttribute('action', action);
            messageEl.textContent = message;
        });
    </script>




    <script>
        const stockData = @json($stocksGroupedByWarehouse);
        function updateAllProductSelects() {
            const warehouseId = document.getElementById('warehouse_id').value;
            // Выбирает все выбранные продукты
            document.querySelectorAll('.product-select').forEach((productSelect, index) => {
                productSelect.innerHTML = ''; // reset

                if (!warehouseId || !stockData[warehouseId]) {
                    const opt = document.createElement('option');
                    opt.value = '';
                    opt.textContent = 'Сначала выберите склад';
                    productSelect.appendChild(opt);
                    return;
                }

                const availableProducts = stockData[warehouseId];

                if (availableProducts.length === 0) {
                    const opt = document.createElement('option');
                    opt.value = '';
                    opt.textContent = 'Нет продуктов в наличии';
                    productSelect.appendChild(opt);
                    return;
                }

                availableProducts.forEach(product => {
                    if (product.stock > 0) {
                        const option = document.createElement('option');
                        option.value = product.product_id;
                        option.textContent = `${product.product_name} (${product.stock} ед.)`;
                        productSelect.appendChild(option);
                    }
                });
            });
        }

        document.getElementById('warehouse_id').addEventListener('change', updateAllProductSelects);

        // Первоначальный вызов при необходимости
        document.addEventListener('DOMContentLoaded', updateAllProductSelects);
    </script>
    <script>
        let itemIndex = 1;
        function addItem() {
            const container = document.getElementById('order-items');
            const div = document.createElement('div');
            div.classList.add('row', 'g-2', 'mb-2', 'order-item');
            div.innerHTML = `
                <div class="col-md-7">
                    <select name="items[${itemIndex}][product_id]" class="form-control mt-2 product-select" required>
                        <option value="">-- Сначала выберите склад --</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="items[${itemIndex}][count]" class="form-control" min="1" placeholder="Кол-во" required>
                </div>
                <div class="col-md-2 text-end">
                    <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            `;
            container.appendChild(div);
            itemIndex++;

            // Обновляет продукты, доступные в этом новом select
            updateAllProductSelects();
        }

        function removeItem(button) {
            const row = button.closest('.order-item');
            row.remove();
        }
    </script>


@endsection
