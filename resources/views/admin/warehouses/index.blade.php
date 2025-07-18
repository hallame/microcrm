@extends('admin.layout.master')
@section('title') Склады @endsection
@section('content')

<div class="row">
    {{-- Всего складов --}}
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-pink-transparent border border-pink d-flex align-items-center justify-content-center">
                                <i class="ti ti-building-warehouse text-pink fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Всего складов</p>
                            <h4>{{ $totalWarehouses }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Всего товаров на складе --}}
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-success-transparent border border-success d-flex align-items-center justify-content-center">
                                <i class="ti ti-package fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Продукты в наличии</p>
                            <h4>{{ $totalProductsInStock }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Общий запас--}}
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-info-transparent border border-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-database fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Общий остаток</p>
                            <h4>{{ $totalStock }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Последнее движение --}}
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-secondary border border-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-refresh fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Последнее движение</p>
                            <h6>{{ $lastMovementDate ? $lastMovementDate->format('d/m/Y H:i') : 'Нет' }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-12 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div>
                    @if($warehouses->isEmpty())
                        @include('partials.empty')
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Товары</th>
                                <th>Всего на складе</th>
                                <th>Добавлен</th>
                                <th>Последнее движение</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warehouses as $warehouse)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $warehouse->name ? Str::limit($warehouse->name, 40) : 'N/A' }}</td>
                                    <td>{{ $warehouse->stocks->count() }}</td>
                                    <td>{{ $warehouse->stocks->sum('stock') }} единиц</td>
                                    <td>{{ \Carbon\Carbon::parse($warehouse->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        {{ optional($warehouse->movements()->latest()->first())->created_at?->format('d/m/Y H:i') ?? '---' }}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-warning"
                                            onclick="openEditModal({{ $warehouse->id }}, '{{ $warehouse->name }}')">
                                            <i class="ti ti-edit"></i>
                                        </a>

                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                           data-bs-toggle="modal" data-bs-target="#delete_modal"
                                           onclick="setDeleteLink({{ $warehouse->id }})">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Модальное окно редактирования склада -->
<div class="modal fade" id="edit_warehouse" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Редактировать склад</h5>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form id="editWarehouseForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Название склада <span class="text-danger">*</span></label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary mx-1">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Модальное окно подтверждения удаления -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Подтвердите удаление</h4>
                <p class="mb-3 text-danger">
                    Внимание: при удалении этого склада вся связанная информация будет безвозвратно удалена.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Отмена</a>

                    <!-- Динамическая форма удаления -->
                    <form id="deleteForm" action="{{ route('admin.warehouse.delete', ':id') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Да, удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function setDeleteLink(id) {
        const form = document.getElementById('deleteForm');
        const action = form.getAttribute('action').replace(':id', id);
        form.setAttribute('action', action);
    }
</script>


<script>
    function openEditModal(id, name) {
        const form = document.getElementById('editWarehouseForm');
        form.action = `/admin/warehouses/update/${id}`;
        document.getElementById('edit_name').value = name;
        new bootstrap.Modal(document.getElementById('edit_warehouse')).show();
    }
</script>

@endsection
