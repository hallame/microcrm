@extends('backend.admin.layout.master')
@section('title') Gestion des Sliders @endsection
@section('content')


<div class="row">
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-pink-transparent border border-pink d-flex align-items-center justify-content-center">
                                <i class="ti ti-world text-pink fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Total Sliders</p>
                            <h4>{{ $total }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-success-transparent border border-success d-flex align-items-center justify-content-center">
                                <i class="ti ti-checkbox  fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Actives</p>
                            <h4>{{ $active }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-danger border border-pink d-flex align-items-center justify-content-center">
                                <i class="ti ti-x fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Inactives</p>
                            <h4>{{ $inactive }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary"><i class="ti ti-circle-arrow-up me-1"></i>Tableau de board</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="d-flex align-items-center flex-wrap row-gap-3">
                <!-- Filtre par statut -->
                <div class="dropdown me-3">
                    <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                        Sélectionner
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3" id="status-dropdown">
                        <li>
                            <a href="{{ route('admin.sliders', ['status' => 'all']) }}" class="dropdown-item rounded-1">Tout</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sliders', ['status' => 'active']) }}" class="dropdown-item rounded-1">Actifs</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sliders', ['status' => 'inactive']) }}" class="dropdown-item rounded-1">Inactifs</a>
                        </li>
                    </ul>
                </div>
                <!-- Filtre par période -->
                <div class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                        Trier par : Derniers 7 jours
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3" id="period-dropdown">
                        <li>
                            <a href="{{ route('admin.sliders', ['period' => 'recently_added']) }}" class="dropdown-item rounded-1">Récemment ajoutés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sliders', ['period' => 'last_month']) }}" class="dropdown-item rounded-1">Dernier mois</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sliders', ['period' => 'last_7_days']) }}" class="dropdown-item rounded-1">Derniers 7 jours</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_slider" class="btn btn-primary d-flex align-items-center text-center"><i class="ti ti-circle-plus me-2"></i>Nouveau slider</a>
                {{-- <a href="{{ route('admin.pages') }}" class="btn btn-primary"><i class="ti ti-book me-1"></i>Toutes les pages</a> --}}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div>
                    @if($sliders->isEmpty())
                        @include('partials.empty')
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Slider</th>
                                {{-- <th>Type</th> --}}
                                {{-- <th>Page</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slider->title ?? 'N/A' }}</td>
                                    {{-- <td>{{ $slider->type ?? 'N/A' }}</td> --}}
                                    {{-- <td>{{ $slider->page ?? 'N/A' }}</td> --}}
                                    <td>
                                        {{-- @if ($slider->page != 'home') --}}
                                            <div class="form-check form-switch">
                                                <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                                <input type="hidden" name="status[{{ $slider->id }}]" value="0">
                                                <!-- Case à cocher avec la valeur '1' si cochée -->
                                                <input class="form-check-input me-2" type="checkbox" role="switch"
                                                    name="status[{{ $slider->id }}]" value="1" {{ $slider->status ? 'checked' : '' }}
                                                    id="status-switch-{{ $slider->id }}">
                                            </div>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $slider->id }})">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        {{-- @endif --}}
                                        <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-sm btn-secondary" title="Modifier">
                                            <i class="ti ti-edit"></i>
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

<!-- Add slider -->
<div class="modal fade" id="add_slider">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nouveau slider</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
           <form action="{{ route('admin.slider.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        {{-- Titre --}}
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Ex : Bienvenue à Zaly Merveille">
                        </div>

                        {{-- Sous-titre --}}
                        <div class="col-md-6 mb-3">
                            <label for="subtitle" class="form-label">Sous-titre</label>
                            <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Ex : Explorez les trésors cachés">
                        </div>

                        {{-- Type --}}
                        {{-- <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" name="type" id="type" class="form-control" placeholder="Ex : intro, promo, guinee">
                        </div> --}}

                        {{-- Langue --}}
                        <div class="col-md-6 mb-3">
                            <label for="language_id" class="form-label">Langue</label>
                            <select name="language_id" id="language_id" class="form-control" required>
                                @foreach($languages as $lang)
                                    <option value="{{ $lang->id }}" {{ $lang->id == 1 ? 'selected' : '' }}>{{ $lang->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Page (textuelle) --}}

                        {{-- <div class="col-md-6 mb-3 d-none">
                            <label for="page" class="form-label">Page</label>
                            <select name="page" id="page" class="form-control">
                                <option value="home" selected>home</option>
                            </select>
                        </div> --}}
                        <input type="hidden" name="page" value="home">



                        {{-- Page liée --}}
                        {{-- <div class="col-md-6 mb-3">
                            <label for="page_id" class="form-label">Page liée</label>
                            <select name="page_id" id="page_id" class="form-control">
                                <option value="">-- Aucune --</option>
                                @foreach($pages as $page)
                                    <option value="{{ $page->id }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        {{-- Statut --}}
                        {{-- <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Statut</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" selected>Actif</option>
                                <option value="0">Inactif</option>
                            </select>
                        </div> --}}



                        {{-- Image --}}
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>

                        {{-- Submit --}}
                        <div class="col-md-12 text-end mb-3">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add slider -->

<!-- Modal pour confirmation de suppression -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirmer la suppression</h4>
                <p class="mb-3 text-danger">
                    Attention : En confirmant la suppression, toutes les informations associées seront définitivement perdues.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Annuler</a>

                    <!-- Formulaire de suppression dynamique -->
                    <form id="deleteForm" action="{{ route('admin.slider.delete', ':id') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var sliderId = this.name.match(/\[(\d+)\]/)[1];
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/zpanel/slider/status-update/${sliderId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success('Statut mis à jour avec succès !');
                } else {
                    toastr.error('Échec de la mise à jour du statut.');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                toastr.error('Erreur lors de la mise à jour du statut.');
            });

        });
    });
</script>

<script>
    function setDeleteLink(sliderId) {
        var formAction = document.getElementById('deleteForm');
        formAction.action = formAction.action.replace(':id', sliderId);
    }
</script>

<script>
    function showMessage(message, type) {
        toastr[type](message);
    }
</script>
@endsection
