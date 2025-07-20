@extends('admin.layout.master')
@section('title') Продукты @endsection
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
                    @if($products->isEmpty())
                        @include('partials.empty')
                    @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Продукт</th>
                                    <th>В наличии</th>
                                    <th>Цена</th>
                                    <th>Склады</th>
                                    <th>Обновлен</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->stocks->sum('stock') }} единиц</td>
                                        <td>{{ number_format($product->price, 2, ',', ' ') }} ₽</td>
                                        <td>
                                            @forelse($product->stocks as $stock)
                                                <div>
                                                    {{ $stock->warehouse->name }}:
                                                    <strong>{{ $stock->stock }}</strong>
                                                </div>
                                            @empty
                                                <span class="text-muted">Нет данных</span>
                                            @endforelse
                                        </td>
                                        <td>
                                            {{ optional($product->movements()->latest()->first())->created_at?->format('d/m/Y H:i') ?? '---' }}
                                        </td>
                                        <td>
                                           <a href="javascript:void(0);" class="btn btn-sm btn-info"
                                                data-id="{{ $product->id }}"
                                                data-name="{{ $product->name }}"
                                                data-price="{{ $product->price }}"
                                                data-warehouse="{{ $product->stock->warehouse_id ?? '' }}"
                                                data-stock="{{ $product->stock->stock ?? 0 }}"
                                                onclick="openEditProductModal(this)">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal" data-bs-target="#delete_modal"
                                            onclick="setDeleteLink({{ $product->id }})">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно: Подтверждение удаления -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                        <i class="ti ti-trash-x fs-36"></i>
                    </span>
                    <h4 class="mb-1">Подтвердите удаление</h4>
                    <p class="mb-3 text-danger">Удаление продукта необратимо.</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Отмена</a>
                        <form id="deleteForm" action="{{ route('admin.product.delete', ':id') }}" method="POST">
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
@endsection
