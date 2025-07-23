@extends('admin.layout.master')
@section('title', 'История движений товаров')

@section('content')
    <h3 class="mb-4">История движений товаров</h3>
    <form method="GET" action="{{ route('admin.movements') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="product_id" class="form-label">Продукт</label>
            <select name="product_id" id="product_id" class="form-select">
                <option value="">-- Все продукты --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="warehouse_id" class="form-label">Склад</label>
            <select name="warehouse_id" id="warehouse_id" class="form-select">
                <option value="">-- Все склады --</option>
                @foreach($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}" {{ request('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                        {{ $warehouse->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="from" class="form-label">С даты</label>
            <input type="date" name="from" id="from" value="{{ request('from') }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label for="to" class="form-label">По дату</label>
            <input type="date" name="to" id="to" value="{{ request('to') }}" class="form-control">
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary w-100">Фильтровать</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Продукт</th>
                    <th>Склад</th>
                    <th>Тип</th>
                    <th>Кол-во</th>
                     <th>Дата</th>
                    <th>Причина</th>
                </tr>
            </thead>
            <tbody id="movements-table-body">
                <tr><td colspan="7" class="text-center">Загрузка...</td></tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-3" id="pagination-links"></div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetchMovements();

            function buildPagination(links) {
                const container = document.getElementById('pagination-links');
                container.innerHTML = '';

                links.forEach(link => {
                    const a = document.createElement('a');
                    a.classList.add('btn', 'btn-sm', 'mx-1');

                    // active/inactive
                    if (link.active) {
                        a.classList.add('btn-primary');
                    } else {
                        a.classList.add('btn-outline-primary');
                    }

                    // previous/next
                    if (link.label.includes('previous')) {
                        a.innerHTML = '← Предыдущая';
                    } else if (link.label.includes('next')) {
                        a.innerHTML = 'Следующая →';
                    } else {
                        a.innerHTML = link.label;
                    }

                    // manage click
                    if (link.url) {
                        a.href = link.url;
                        a.addEventListener('click', function (e) {
                            e.preventDefault();
                            fetchMovements(link.url); // API request
                        });
                    } else {
                        a.classList.add('disabled');
                        a.href = '#';
                    }

                    container.appendChild(a);
                });
            }


            function fetchMovements(url = '/api/movements' + window.location.search) {
                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        const tbody = document.getElementById('movements-table-body');
                        tbody.innerHTML = '';

                        if (data.data.length === 0) {
                            tbody.innerHTML = `<tr><td colspan="7" class="text-center text-muted">Нет данных для отображения</td></tr>`;
                            return;
                        }

                        data.data.forEach(movement => {
                            let typeLabel = {
                                'create': 'Создание',
                                'update': 'Обновление',
                                'cancel': 'Отмена',
                                'complete': 'Завершение',
                                'reactivate': 'Возобновление',
                                'delete': 'Удаление',
                                'order': 'Заказ'
                            }[movement.type] ?? 'Неизвестно';

                            tbody.innerHTML += `
                                <tr>
                                    <td>${movement.product?.name || '-'}</td>
                                    <td>${movement.warehouse?.name || '-'}</td>
                                    <td>${typeLabel}</td>
                                    <td>${movement.quantity}</td>
                                    <td>${new Date(movement.created_at).toLocaleString('ru-RU')}</td>
                                    <td>${movement.reason}</td>
                                </tr>
                            `;
                        });

                        buildPagination(data.links);
                    });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filters = ['product_id', 'warehouse_id', 'from', 'to'];

            filters.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('change', () => {
                        document.forms[0].submit(); // automatic submit after choice
                    });
                }
            });
        });
    </script>


@endsection

