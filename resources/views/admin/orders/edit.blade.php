@extends('admin.layout.master')
@section('title') Редактировать заказ @endsection
@section('content')

<h3 class="mb-3">
    <a href="{{ route('admin.orders') }}" class="text-decoration-none me-2">
        <i class="ti ti-arrow-left"></i>
    </a>
    Редактировать заказ #{{ $order->id }}
</h3>

<form action="{{ route('admin.order.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Клиент</label>
        <input type="text" name="customer" class="form-control" value="{{ $order->customer }}" required>
    </div>

    <div class="mb-3">
        <label>Склад</label>
        <select name="warehouse_id" id="edit_warehouse_id" class="form-control" required>
            @foreach($warehouses as $warehouse)
                <option value="{{ $warehouse->id }}" {{ $warehouse->id == $order->warehouse_id ? 'selected' : '' }}>
                    {{ $warehouse->name }}
                </option>
            @endforeach
        </select>
    </div>

    <hr>
    <h5>Продукты</h5>
    <div id="edit_order_items">
        @foreach($order->items as $index => $item)
        <div class="row g-2 mb-2 order-item">
            <div class="col-md-7">
                <select name="items[{{ $index }}][product_id]" class="form-control product-select" required>
                    @foreach($stocksGroupedByWarehouse[$order->warehouse_id] ?? [] as $product)
                        <option value="{{ $product['product_id'] }}"
                            {{ $product['product_id'] == $item->product_id ? 'selected' : '' }}>
                            {{ $product['product_name'] }} ({{ $product['stock'] }} ед.)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="items[{{ $index }}][count]" class="form-control"
                       value="{{ $item->count }}" min="1" required>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-danger" onclick="this.closest('.order-item').remove()">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mb-3 text-end">
        <button type="button" class="btn btn-sm btn-secondary" onclick="addEditItem()">+ Добавить товар</button>
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>

<script>
    const stockData = @json($stocksGroupedByWarehouse);
    let editItemIndex = {{ $order->items->count() }};

    function addEditItem() {
        const warehouseId = document.getElementById('edit_warehouse_id').value;
        const container = document.getElementById('edit_order_items');

        const div = document.createElement('div');
        div.classList.add('row', 'g-2', 'mb-2', 'order-item');

        let options = '';
        const products = stockData[warehouseId] || [];
        products.forEach(product => {
            if (product.stock > 0) {
                options += `<option value="${product.product_id}">
                                ${product.product_name} (${product.stock} ед.)
                            </option>`;
            }
        });

        div.innerHTML = `
            <div class="col-md-7">
                <select name="items[${editItemIndex}][product_id]" class="form-control product-select" required>
                    ${options}
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="items[${editItemIndex}][count]" class="form-control" min="1" required>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-danger" onclick="this.closest('.order-item').remove()">
                    <i class="ti ti-x"></i>
                </button>
            </div>`;
        container.appendChild(div);
        editItemIndex++;
    }

    document.getElementById('edit_warehouse_id').addEventListener('change', function () {
        document.getElementById('edit_order_items').innerHTML = '';
        editItemIndex = 0;
    });
</script>



@endsection
