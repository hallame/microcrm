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

        <div class="mb-3">
            <label for="name" class="form-label">Название продукта <span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Введите название продукта" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Цена (₽) <span class="text-danger">*</span></label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" placeholder="Например: 150.00" required>
        </div>

        <hr>
        <h5 class="mt-4 mb-3">Остатки на складах</h5>

        <div id="stock-lines">
            <div class="row mb-3 stock-line">
                <div class="col-md-6">
                    <select name="stocks[0][warehouse_id]" class="form-select" required>
                        <option value="">-- Выберите склад --</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" name="stocks[0][stock]" class="form-control" min="0" placeholder="Количество" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger" onclick="removeStockLine(this)">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="mb-3 text-start">
            <button type="button" class="btn btn-secondary" onclick="addStockLine()">
                <i class="ti ti-plus"></i> Добавить склад
            </button>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>

    <script>
        let stockIndex = 1;
        function addStockLine() {
            const container = document.getElementById('stock-lines');
            const clone = container.firstElementChild.cloneNode(true);

            // Очистка значений и имен
            clone.querySelectorAll('select, input').forEach(el => {
                if (el.name.includes('warehouse_id')) {
                    el.name = `stocks[${stockIndex}][warehouse_id]`;
                } else if (el.name.includes('stock')) {
                    el.name = `stocks[${stockIndex}][stock]`;
                }
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
