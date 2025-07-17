@extends('backend.admin.layout.master')
@section('title') Hôtels @endsection
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Total Hôtels</p>
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Hôtels Actifs</p>
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Hôtels Inactifs</p>
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
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-info-transparent border border-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-star fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Note Moyenne</p>
                            <span class="fw-bold text-black ">
                                {{ $averageRating }}
                            </span>
                            <span>({{ $totalReviews }} Avis)</span>
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
                            <a href="{{ route('admin.hotels', ['status' => 'all']) }}" class="dropdown-item rounded-1">Tous les Hôtels</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.hotels', ['status' => 'active']) }}" class="dropdown-item rounded-1">Hôtels Actifs</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.hotels', ['status' => 'inactive']) }}" class="dropdown-item rounded-1">Hôtels Inactifs</a>
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
                            <a href="{{ route('admin.hotels', ['period' => 'recently_added']) }}" class="dropdown-item rounded-1">Récemment ajoutés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.hotels', ['period' => 'last_month']) }}" class="dropdown-item rounded-1">Dernier mois</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.hotels', ['period' => 'last_7_days']) }}" class="dropdown-item rounded-1">Derniers 7 jours</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_hotel" class="btn btn-primary d-flex align-items-center text-center"><i class="ti ti-circle-plus me-2"></i>Ajouter un Hôtel</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div>
                    @if($hotels->isEmpty())
                        @include('partials.empty')
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Hôtel</th>
                                <th>Catégorie</th>
                                <th>Emplacement</th>
                                {{-- <th>Réservé</th> --}}
                                <th>Avis</th>
                                {{-- <th>Vues</th> --}}
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hotels as $hotel)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $hotel->name ?? 'N/A' }}</td>
                                    <td>{{ $hotel->category ? $hotel->category->name : 'N/A' }}</td>
                                    <td>
                                        {{ $hotel->city ?? 'N/A' }} - {{ $hotel->country->name ?? 'N/A' }}
                                    </td>
                                    {{-- <td> {{ $hotel->reservations_count }} fois </td> --}}
                                    <td>
                                        <span class="text-warning">
                                            @if ($hotel->reviews_count > 0)
                                            <i class="fas fa-star"></i>
                                            @else
                                            <i class="far fa-star"></i>
                                            @endif
                                        </span>
                                        {{ number_format($hotel->average_rating ?? 0, 1) }} ({{ $hotel->reviews_count }})
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                            <input type="hidden" name="status[{{ $hotel->id }}]" value="0">
                                            <!-- Case à cocher avec la valeur '1' si cochée -->
                                            <input class="form-check-input me-2" type="checkbox" role="switch"
                                                name="status[{{ $hotel->id }}]" value="1" {{ $hotel->status ? 'checked' : '' }}
                                                id="status-switch-{{ $hotel->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        {{-- <a href="{{ route('admin.hotel.details', $hotel->id) }}"
                                            class="btn btn-sm btn-info" title="Voir"> <i class="ti ti-eye"></i>
                                         </a> --}}

                                        <a href="{{ route('admin.hotel.edit', $hotel->id) }}" class="btn btn-sm btn-secondary" title="Modifier">
                                            <i class="ti ti-edit"></i>
                                        </a>

                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $hotel->id }})">
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

<!-- Add hotel -->
<div class="modal fade" id="add_hotel">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un nouveau Hôtel</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.hotel.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">

                        {{-- Nom de l'hôtel --}}
                        <div class="col-md-4">
                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Ex : Hôtel Zaly Palace" required>
                        </div>

                        {{-- Ville --}}
                        <div class="col-md-4">
                            <label for="city" class="form-label">Ville <span class="text-danger">*</span></label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="Ex : N'zérékoré" required>
                        </div>

                        {{-- Emplacement --}}
                        <div class="col-md-4">
                            <label for="location" class="form-label">Emplacement</label>
                            <input type="text" name="location" id="location" class="form-control" placeholder="Ex : Route de Macenta, KM 15">
                        </div>

                        {{-- Adresse / Quartier --}}
                        <div class="col-md-4">
                            <label for="address" class="form-label">Adresse (quartier / district)</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Ex : Quartier Zébéla, District Sud">
                        </div>

                        {{-- Téléphone --}}
                        <div class="col-md-4">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Ex : +2290167617769">
                        </div>

                        {{-- Email --}}
                        <div class="col-md-4">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Ex : support@omizix.com">
                        </div>

                        {{-- Pays --}}
                        <div class="col-md-4">
                            <label for="country_id" class="form-label">Pays</label>
                            <select name="country_id" id="country_id" class="form-control">
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $country->id == 1 ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Catégorie --}}
                        <div class="col-md-4">
                            <label for="category_id" class="form-label">Catégorie</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">-- Sélectionner une catégorie --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Langue --}}
                        <div class="col-md-4">
                            <label for="language_id" class="form-label">Langue</label>
                            <select name="language_id" id="language_id" class="form-control">
                                @foreach($languages as $lang)
                                    <option value="{{ $lang->id }}" {{ $lang->id == 1 ? 'selected' : '' }}>{{ $lang->name }}</option>
                                @endforeach
                            </select>
                        </div>





                        {{-- Chambres disponibles --}}
                        <div class="col-md-4">
                            <label for="rooms_available" class="form-label">Chambres disponibles</label>
                            <input type="number" name="rooms_available" id="rooms_available" class="form-control" placeholder="Ex : 12">
                        </div>

                        {{-- Total chambres --}}
                        <div class="col-md-4">
                            <label for="total_rooms" class="form-label">Nombre total de chambres</label>
                            <input type="number" name="total_rooms" id="total_rooms" class="form-control" placeholder="Ex : 20">
                        </div>

                        {{-- Prix par nuit --}}
                        <div class="col-md-4">
                            <label for="price_per_night" class="form-label">Prix par nuit</label>
                            <input type="number" step="0.01" name="price_per_night" id="price_per_night" class="form-control" placeholder="Ex : 250000">
                        </div>

                        {{-- Installations --}}
                        <div class="col-md-4">
                            <label for="facilities" class="form-label">Installations</label>
                            <input type="text" name="facilities" id="facilities" class="form-control" placeholder="Ex : Wifi, Piscine, Parking, Climatisation">
                        </div>

                        {{-- Image --}}
                        <div class="col-md-4">
                            <label for="image" class="form-label">Image principale</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>

                        {{-- Statut --}}
                        <div class="col-md-4">
                            <label for="status" class="form-label">Statut</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" selected>Actif</option>
                                <option value="0">Inactif</option>
                            </select>
                        </div>

                         {{-- Description --}}
                         <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Brève présentation de l'hôtel, des services, etc."></textarea>
                        </div>

                        {{-- Bouton de soumission --}}
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add hotel -->

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
                    <form id="deleteForm" action="{{ route('admin.hotel.delete', ':id') }}" method="POST" style="display: inline;">
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
            var hotelId = this.name.match(/\[(\d+)\]/)[1];
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/zpanel/hotel/status-update/${hotelId}`, {
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
    function setDeleteLink(hotelId) {
        var formAction = document.getElementById('deleteForm');
        formAction.action = formAction.action.replace(':id', hotelId);
    }
</script>

<script>
    function showMessage(message, type) {
        toastr[type](message);
    }
</script>
@endsection
