<!-- Modal : Добавить склад -->
<div class="modal fade" id="add_warehouse" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Добавить склад</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.warehouse.add') }}" method="POST">
                @csrf
                <div class="modal-body pb-0">
                    <div class="mb-3">
                        <label for="name" class="form-label">Название склада <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Например: Центральный склад" required>
                    </div>
                    <div class="text-end mt-3 mb-3">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



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
