@extends('backend.admin.layout.master')
@section('title') Objets @endsection
@section('content')

<div class="row">
    <div class="col-xl-4 col-md-6 d-flex">
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Total Objets</p>
                            <h4>{{ $total }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 d-flex">
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Objets Actifs</p>
                            <h4>{{ $active }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 d-flex">
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Objets Inactifs</p>
                            <h4>{{ $inactive }}</h4>
                        </div>
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
                        Sélectionner le statut
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3" id="status-dropdown">
                        <li>
                            <a href="{{ route('admin.objects', ['status' => 'all']) }}" class="dropdown-item rounded-1">Tous les Objets</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.objects', ['status' => 'active']) }}" class="dropdown-item rounded-1">Objets Actifs</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.objects', ['status' => 'inactive']) }}" class="dropdown-item rounded-1">Objets Inactifs</a>
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
                            <a href="{{ route('admin.objects', ['period' => 'recently_added']) }}" class="dropdown-item rounded-1">Récemment ajoutés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.objects', ['period' => 'last_month']) }}" class="dropdown-item rounded-1">Dernier mois</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.objects', ['period' => 'last_7_days']) }}" class="dropdown-item rounded-1">Derniers 7 jours</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_object" class="btn btn-primary d-flex align-items-center text-center"><i class="ti ti-circle-plus me-2"></i>Ajouter un objet</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div>
                    @if($objects->isEmpty())
                        @include('partials.empty')
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Objet</th>
                                <th>Ethnie</th>
                                <th>Usage</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($objects as $object)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $object->name ?? 'N/A' }}</td>
                                    <td>{{ $object->ethnic ?? 'N/A' }}</td>
                                    <td> {{ Str::limit($object->function ?? 'N/A', 30) }} </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                            <input type="hidden" name="status[{{ $object->id }}]" value="0">
                                            <!-- Case à cocher avec la valeur '1' si cochée -->
                                            <input class="form-check-input me-2" type="checkbox" role="switch"
                                                name="status[{{ $object->id }}]" value="1" {{ $object->status ? 'checked' : '' }}
                                                id="status-switch-{{ $object->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.object.details', $object->id) }}"
                                            class="btn btn-sm btn-info" title="Voir"> <i class="ti ti-eye"></i>
                                         </a>

                                        <a href="{{ route('admin.object.edit', $object->id) }}" class="btn btn-sm btn-secondary" title="Modifier">
                                            <i class="ti ti-edit"></i>
                                        </a>

                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $object->id }})">
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

<!-- Add object -->
<div class="modal fade" id="add_object">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un nouvel objet</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.object.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom de l'objet <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Grotte sacrée de Kouankan" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="local_name" class="form-label">Nom local <span class="text-danger">*</span></label>
                                <input type="text" required  name="local_name" class="form-control" placeholder="Ex: Kouankan Sacred Cave" value="{{ old('local_name') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="museum_id" class="form-label">Musée <span class="text-danger">*</span></label>
                                <select name="museum_id" id="museum_id" class="form-control" required>
                                    @foreach($museums as $museum)
                                        <option value="{{ $museum->id }}" {{ $museum->id == 1 ? 'selected' : '' }}>{{ $museum->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ethnic" class="form-label">Ethnie <span class="text-danger">*</span></label>
                                <input type="text" name="ethnic"  required  class="form-control" placeholder="Ex: Malinké" value="{{ old('ethnic') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="locality" class="form-label">Localité <span class="text-danger">*</span></label>
                                <input type="text" name="locality" required  class="form-control" placeholder="Ex: Kouankan" value="{{ old('locality') }}">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Catégorie</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">-- Sélectionner une catégorie --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="language_id" class="form-label">Langue <span class="text-danger">*</span></label>
                                <select name="language_id" id="language_id" class="form-control" required>
                                    @foreach($languages as $lang)
                                        <option value="{{ $lang->id }}" {{ $lang->id == 1 ? 'selected' : '' }}>{{ $lang->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image principale  <span class="text-danger">*</span></label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="function" class="form-label">Usage / Fonction <span class="text-danger">*</span></label>
                                <textarea name="function" id="function" required class="form-control" rows="3" placeholder="Ex: Rituel, cérémonies, protection...">{{ old('function') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description  </label>
                                <textarea name="description" id="description" required class="form-control" rows="3" placeholder="Ex: Description du site historique de la Grotte sacrée..."></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary mb-3">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add object -->

<!-- Edit object -->
@if($objects->isNotEmpty())
    <div class="modal fade" id="edit_object">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier l'objet</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('admin.object.update', $object->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Cette méthode permet de simuler une requête PUT -->
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Grotte sacrée de Kouankan" value="{{ old('name', $object->name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="local_name" class="form-label">Nom local <span class="text-danger">*</span></label>
                                    <input type="text" name="local_name" class="form-control" placeholder="Nom local ou nom traditionnel" value="{{ old('local_name', $object->local_name) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="museum_id" class="form-label">Musée <span class="text-danger">*</span></label>
                                    <select name="museum_id" id="museum_id" class="form-control" required>
                                        @foreach($museums as $museum)
                                            <option value="{{ $museum->id }}"
                                                {{ old('museum_id', $object->museum_id ?? null) == $museum->id ? 'selected' : '' }}>
                                                {{ $museum->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ethnic" class="form-label">Ethnie <span class="text-danger">*</span></label>
                                    <input type="text" name="ethnic" class="form-control" placeholder="Ex: Kpèlè, Manon, Kissi..." value="{{ old('ethnic', $object->ethnic) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="locality" class="form-label">Localité <span class="text-danger">*</span></label>
                                    <input type="text" name="locality" class="form-control" placeholder="Ex: Kouankan, Lola, Beyla..." value="{{ old('locality', $object->locality) }}">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Catégorie</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">-- Sélectionner une catégorie --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $object->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="language_id" class="form-label">Langue <span class="text-danger">*</span></label>
                                    <select name="language_id" id="language_id" class="form-control" required>
                                        @foreach($languages as $lang)
                                            <option value="{{ $lang->id }}" {{ $lang->id == $object->language_id ? 'selected' : '' }}>{{ $lang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image principale  <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    <small class="text-info">Vous pouvez laissez ce champ vide.</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="function" class="form-label">Usage / Fonction<span class="text-danger">*</span></label>
                                    <textarea name="function" id="function" required class="form-control" rows="3" placeholder="Ex: Rituel, cérémonies, protection...">{{ old('function', $object->function) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description  <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" required class="form-control" rows="3" placeholder="Description ...">{{ old('description', $object->description) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary mb-3">Mettre à jour</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
<!-- /Edit object -->

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
                    Attention : En supprimant cet élément, toutes les informations associées seront définitivement perdues.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Annuler</a>

                    <!-- Formulaire de suppression dynamique -->
                    <form id="deleteForm" action="{{ route('admin.object.delete', ':id') }}" method="POST" style="display: inline;">
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
            var objectId = this.name.match(/\[(\d+)\]/)[1];
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/zpanel/object/status-update/${objectId}`, {
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
    function setDeleteLink(objectId) {
        var formAction = document.getElementById('deleteForm');
        formAction.action = formAction.action.replace(':id', objectId);
    }
</script>

<script>
    function showMessage(message, type) {
        toastr[type](message);
    }
</script>
@endsection
