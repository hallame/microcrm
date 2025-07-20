@extends('admin.layout.master')
@section('title') Добавить продукт @endsection
@section('content')

    <h3 class="mb-3">
        <a href="{{ route('admin.products') }}" class="text-decoration-none me-2">
            <i class="ti ti-arrow-left"></i>
        </a>
        Добавить продукт
    </h3>

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


    <script>
            let stockIndex = 1;
            function addStockLine() {
                const container = document.getElementById('stock-lines');
                const clone = container.firstElementChild.cloneNode(true);

                // Update les noms
                clone.querySelectorAll('select, input').forEach(el => {
                    const newName = el.name.replace(/\[\d+\]/, `[${stockIndex}]`);
                    el.name = newName;
                    el.value = '';
                });

                container.appendChild(clone);
                stockIndex++;
            }

            function removeStockLine(button) {
                const container = document.getElementById('stock-lines');
                if (container.children.length > 1) {
                    button.closest('.stock-line').remove();
                }
            }
    </script>

@endsection
