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
                    <th>#</th>
                    <th>Продукт</th>
                    <th>Склад</th>
                    <th>Тип</th>
                    <th>Кол-во</th>
                     <th>Дата</th>

                    <th>Причина</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movements as $movement)
                        @php
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
                    <tr>
                        <td>{{ $movement->id }}</td>
                        <td>{{ $movement->product->name ?? '-' }}</td>
                        <td>{{ $movement->warehouse->name ?? '-' }}</td>
                        <td>{{ $typeLabel }}</td>
                        <td>{{ $movement->quantity }}</td>
                        <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>

                        <td>{{ $movement->reason }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Нет данных для отображения</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $movements->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
@endsection
