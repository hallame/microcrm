@extends('admin.layout.master')
@section('title') Добавить заказ @endsection
@section('content')

<h3 class="mb-3">
    <a href="{{ route('admin.orders') }}" class="text-decoration-none me-2">
        <i class="ti ti-arrow-left"></i>
    </a>
    Добавить заказ
</h3>

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
