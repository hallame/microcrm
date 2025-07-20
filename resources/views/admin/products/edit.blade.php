@extends('admin.layout.master')
@section('title') Редактировать продукт @endsection
@section('content')

<h3 class="mb-3">
    <a href="{{ route('admin.products') }}" class="text-decoration-none me-2">
        <i class="ti ti-arrow-left"></i>
    </a>
    Редактировать продукт #{{ $product->id }}
</h3>

<form action="{{ route('admin.product.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Название продукта <span class="text-danger">*</span></label>
        <input type="text" id="name" name="name" class="form-control" required placeholder="Введите название"
               value="{{ old('name', $product->name) }}">
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Цена (₽) <span class="text-danger">*</span></label>
        <input type="number" step="0.01" id="price" name="price" class="form-control" required placeholder="Введите цену"
               value="{{ old('price', $product->price) }}">
    </div>

    <hr>
    <h5 class="mt-4 mb-3">Остатки на складах</h5>

    @foreach($warehouses as $warehouse)
        @php
            $stockValue = $product->stocks->firstWhere('warehouse_id', $warehouse->id)?->stock ?? '';
        @endphp
        <div class="row mb-2 align-items-center">
            <div class="col-md-6">
                <label class="form-label">{{ $warehouse->name }}</label>
            </div>
            <div class="col-md-6">
                <input type="number"
                       name="stocks[{{ $warehouse->id }}]"
                       class="form-control"
                       min="0"
                       placeholder="Остаток на складе"
                       value="{{ old("stocks.$warehouse->id", $stockValue) }}">
            </div>
        </div>
    @endforeach

    <div class="text-end mt-4">
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </div>
</form>

@endsection
