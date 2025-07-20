@extends('admin.layout.master')
@section('title') Редактировать продукт @endsection

@section('content')
<h3 class="mb-3">
    <a href="{{ route('admin.products') }}" class="text-decoration-none me-2">
        <i class="ti ti-arrow-left"></i>
    </a>
    Редактировать продукт
</h3>

<form action="{{ route('admin.product.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Название продукта <span class="text-danger">*</span></label>
        <input type="text" id="name" name="name" class="form-control"
               value="{{ old('name', $product->name) }}" required placeholder="Введите название продукта">
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Цена (₽) <span class="text-danger">*</span></label>
        <input type="number" step="0.01" id="price" name="price" class="form-control"
               value="{{ old('price', $product->price) }}" required placeholder="Введите цену">
    </div>

    <hr>
    <h5 class="mt-4 mb-3">Остатки на складах</h5>

    <div id="stock-lines">
        @foreach($product->stocks as $index => $stock)
            <div class="row mb-2 stock-line align-items-center">
                <div class="col-md-5">
                    <select name="stocks[{{ $index }}][warehouse_id]" class="form-control" required>
                        <option value="">-- Выберите склад --</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" @selected($warehouse->id == $stock->warehouse_id)>
                                {{ $warehouse->name }}
                            </option>
                        @endforeach
                    </select>



                </div>
                <div class="col-md-5">
                    <input type="number" name="stocks[{{ $index }}][stock]" class="form-control" min="0"
                           value="{{ $stock->stock }}" placeholder="Остаток">
                </div>
                <div class="col-md-2 text-end">
                    <button type="button" class="btn btn-danger btn-sm remove-line">−</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-outline-primary btn-sm" id="add-line">+ Добавить склад</button>
    </div>

    <div class="text-end mt-4">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let stockIndex = {{ $product->stocks->count() }};
        const warehouses = @json($warehouses);

        document.getElementById('add-line').addEventListener('click', function () {
            const line = document.createElement('div');
            line.className = 'row mb-2 stock-line align-items-center';
            line.innerHTML = `
                <div class="col-md-5">
                    <select name="stocks[${stockIndex}][warehouse_id]" class="form-control" required>
                        <option value="">-- Выберите склад --</option>
                        ${warehouses.map(w => `<option value="${w.id}">${w.name}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="number" name="stocks[${stockIndex}][stock]" class="form-control" min="0" placeholder="Остаток">
                </div>
                <div class="col-md-2 text-end">
                    <button type="button" class="btn btn-danger btn-sm remove-line">−</button>
                </div>
            `;
            document.getElementById('stock-lines').appendChild(line);
            stockIndex++;
        });

        document.getElementById('stock-lines').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-line')) {
                const line = e.target.closest('.stock-line');
                if (line) line.remove();
            }
        });
    });
</script>



@endsection
