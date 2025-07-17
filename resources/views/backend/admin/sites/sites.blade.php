@extends('backend.admin.layout.master')
@section('title') Sites Touristiques @endsection
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Total Sites</p>
                            <h4>{{ $totalSites }}</h4>
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Sites réservés</p>
                            <h4>{{ $reservedSites }}</h4>
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
                            <span>({{ $totalSitesReviews }} Avis)</span>
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
                            <span class="p-2 br-10 bg-secondary border border-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle-check fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Sites Actifs</p>
                            <h4>{{ $activeSites }}</h4>
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
                            <a href="{{ route('admin.sites', ['status' => 'all']) }}" class="dropdown-item rounded-1">Tous les sites</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sites', ['status' => 'active']) }}" class="dropdown-item rounded-1">Sites Actifs</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sites', ['status' => 'inactive']) }}" class="dropdown-item rounded-1">Sites Inactifs</a>
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
                            <a href="{{ route('admin.sites', ['period' => 'recently_added']) }}" class="dropdown-item rounded-1">Récemment ajoutés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sites', ['period' => 'last_month']) }}" class="dropdown-item rounded-1">Dernier mois</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sites', ['period' => 'last_7_days']) }}" class="dropdown-item rounded-1">Derniers 7 jours</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_site" class="btn btn-primary d-flex align-items-center text-center"><i class="ti ti-circle-plus me-2"></i>Ajouter un site</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div>
                    @if($sites->isEmpty())
                        @include('partials.empty')
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Site</th>
                                {{-- <th>Catégorie</th> --}}
                                <th>Emplacement</th>
                                <th>Réservé</th>
                                <th>Avis</th>
                                <th>Vues</th>
                                {{-- <th>Statut</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sites as $site)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $site->name ?? 'N/A' }}</td>
                                    {{-- <td>{{ $site->category ? $site->category->name : 'N/A' }}</td> --}}
                                    <td>
                                        {{ $site->city ?? 'N/A' }} - {{ $site->country->name ?? 'N/A' }}
                                    </td>
                                    <td> {{ $site->reservations_count }} fois </td>
                                    <td>
                                        <span class="text-warning">
                                            @if ($site->reviews_count > 0)
                                            <i class="fas fa-star"></i>
                                            @else
                                            <i class="far fa-star"></i>
                                            @endif
                                        </span>
                                        {{ number_format($site->average_rating ?? 0, 1) }} ({{ $site->reviews_count }})
                                    </td>
                                    <td> {{ $site->views_count }} fois </td>

                                    <td>
                                        <div class="form-check form-switch">
                                            <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                            <input type="hidden" name="status[{{ $site->id }}]" value="0">
                                            <!-- Case à cocher avec la valeur '1' si cochée -->
                                            <input class="form-check-input me-2" type="checkbox" role="switch"
                                                name="status[{{ $site->id }}]" value="1" {{ $site->status ? 'checked' : '' }}
                                                id="status-switch-{{ $site->id }}">
                                        </div>
                                        <a href="{{ route('admin.site.details', $site->id) }}"
                                            class="btn btn-sm btn-info" title="Voir"> <i class="ti ti-eye"></i>
                                         </a>

                                        <a href="{{ route('admin.site.edit', $site->id) }}" class="btn btn-sm btn-secondary" title="Modifier">
                                            <i class="ti ti-edit"></i>
                                        </a>

                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $site->id }})">
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

<!-- Add Site -->
<div class="modal fade" id="add_site">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un nouveau site touristique</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.site.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du site <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Grotte sacrée de Kouankan" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="location" class="form-label">Emplacement <span class="text-danger">*</span></label>
                                <input type="text" id="location" name="location" class="form-control" placeholder="Ex: Route de Macenta, km 15" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="city" class="form-label">Ville <span class="text-danger">*</span></label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="Ex: N'zérékoré" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="district" class="form-label">Quartier / District / Village  <span class="text-danger">*</span></label>
                                <input type="text" id="district" name="district" required class="form-control" placeholder="Ex: Kouankan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="country_id" class="form-label">Pays <span class="text-danger">*</span></label>
                                <select name="country_id" id="country_id" class="form-control" required>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ $country->id == 1 ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
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
                                <label for="accessibility" class="form-label">Accessibilité  <span class="text-danger">*</span></label>
                                <textarea name="accessibility" id="accessibility" required class="form-control" rows="3" placeholder="Description de l’accès, distance, moyens de transport..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="history" class="form-label">Histoire (facultatif)</label>
                                <textarea name="history" id="history" class="form-control" rows="3" placeholder="Brève histoire ou contexte du site"></textarea>
                            </div>
                        </div>

                         <!-- Champ pour la vidéo -->
                         <div class="col-md-6">
                            <div class="mb-3">
                                <label for="video" class="form-label">Vidéo (optionnel)</label>
                                <input type="file" name="video" id="video" class="form-control" accept="video/*">
                                <small class="form-text text-muted text-info">Téléchargez une vidéo</small>
                            </div>
                        </div>

                        <!-- OU champ pour l'URL de la vidéo -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="video_url" class="form-label">Lien vers la vidéo (optionnel)</label>
                                <input type="url" name="video_url" id="video_url" class="form-control" placeholder="Lien vers la vidéo">
                                <small class="form-text text-muted">Si vous préférez ajouter un lien vidéo (YouTube, Vimeo, etc.), entrez-le ici</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="map_url" class="form-label">Lien vers la carte (Google Maps)</label>
                                <input type="url" id="map_url" name="map_url" class="form-control" placeholder="https://maps.google.com/...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="info" class="form-label">Info sur le prix</label>
                                <input type="text" id="info" name="info" class="form-control" placeholder="Ex: 10€/Individu">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-control" placeholder="************">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-control" placeholder="************">
                            </div>
                        </div>
                        {{-- <div id="map" class="h-64 w-full rounded-xl shadow mb-3" ></div> --}}

                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary mb-3">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add Site -->

<!-- Edit Site -->
@if($sites->isNotEmpty())
    <div class="modal fade" id="edit_site">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier le site touristique</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('admin.site.update', $site->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Cette méthode permet de simuler une requête PUT -->
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom du site <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Grotte sacrée de Kouankan" value="{{ old('name', $site->name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="location" class="form-label">Emplacement <span class="text-danger">*</span></label>
                                    <input type="text" id="location" name="location" class="form-control" placeholder="Ex: Route de Macenta, km 15" value="{{ old('location', $site->location) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="city" class="form-label">Ville <span class="text-danger">*</span></label>
                                    <input type="text" id="city" name="city" class="form-control" placeholder="Ex: N'zérékoré" value="{{ old('city', $site->city) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="district" class="form-label">Quartier / District / Village  <span class="text-danger">*</span></label>
                                    <input type="text" id="district" name="district" required class="form-control" placeholder="Ex: Kouankan" value="{{ old('district', $site->district) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="country_id" class="form-label">Pays <span class="text-danger">*</span></label>
                                    <select name="country_id" id="country_id" class="form-control" required>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ $country->id == $site->country_id ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Catégorie</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">-- Sélectionner une catégorie --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $site->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="language_id" class="form-label">Langue <span class="text-danger">*</span></label>
                                    <select name="language_id" id="language_id" class="form-control" required>
                                        @foreach($languages as $lang)
                                            <option value="{{ $lang->id }}" {{ $lang->id == $site->language_id ? 'selected' : '' }}>{{ $lang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image principale  <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    <small>Vous pouvez laissez ce champ vide.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="accessibility" class="form-label">Accessibilité  <span class="text-danger">*</span></label>
                                    <textarea name="accessibility" id="accessibility" required class="form-control" rows="3" placeholder="Description de l’accès, distance, moyens de transport...">{{ old('accessibility', $site->accessibility) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="history" class="form-label">Histoire (facultatif)</label>
                                    <textarea name="history" id="history" class="form-control" rows="3" placeholder="Brève histoire ou contexte du site">{{ old('history', $site->history) }}</textarea>
                                </div>
                            </div>

                             <!-- Champ pour la vidéo -->
                             <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="video" class="form-label">Vidéo (optionnel)</label>
                                    <input type="file" name="video" id="video" class="form-control" accept="video/*">
                                    <small class="form-text text-muted text-info">Téléchargez une vidéo</small>
                                </div>
                            </div>

                            <!-- OU champ pour l'URL de la vidéo -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="video_url" class="form-label">Lien vers la vidéo (optionnel)</label>
                                    <input type="url" name="video_url" id="video_url" class="form-control" placeholder="Lien vers la vidéo" value="{{ old('video_url', $site->video_url) }}">
                                    <small class="form-text text-muted">Si vous préférez ajouter un lien vidéo (YouTube, Vimeo, etc.), entrez-le ici</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="map_url" class="form-label">Lien vers la carte (Google Maps)</label>
                                    <input type="url" id="map_url" name="map_url" class="form-control" placeholder="https://maps.google.com/..." value="{{ old('map_url', $site->map_url) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="info" class="form-label">Info sur le prix</label>
                                    <input type="text" id="info" name="info" class="form-control" placeholder="Ex: 10€/Individu" value="{{ old('info', $site->info) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control" placeholder="************" value="{{ old('latitude', $site->latitude) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control" placeholder="************" value="{{ old('longitude', $site->longitude) }}">
                                </div>
                            </div>
                            {{-- <div id="map" class="h-64 w-full rounded-xl shadow mb-3" ></div> --}}


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
<!-- /Edit Site -->

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
                    Attention : En supprimant ce site, toutes les informations associées, y compris les avis, les réservations et toutes les données relatives à ce site, seront définitivement perdues.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Annuler</a>

                    <!-- Formulaire de suppression dynamique -->
                    <form id="deleteForm" action="{{ route('admin.site.delete', ':id') }}" method="POST" style="display: inline;">
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
            var siteId = this.name.match(/\[(\d+)\]/)[1];
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/zpanel/site/status-update/${siteId}`, {
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
    function setDeleteLink(siteId) {
        var formAction = document.getElementById('deleteForm');
        formAction.action = formAction.action.replace(':id', siteId);
    }
</script>

<script>
    function showMessage(message, type) {
        toastr[type](message);
    }
</script>
@endsection
