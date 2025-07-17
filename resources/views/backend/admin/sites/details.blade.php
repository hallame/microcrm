@extends('backend.admin.layout.master')
@section('title') Détails Site @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.sites') }}">
                <i class="ti ti-arrow-left me-2"></i>Retour</a>
            </h6>
            <div class="d-flex">
                <div class="text-end">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_site"><i class="ti ti-edit me-1"></i>Modifier</a>
                </div>
                <div class="head-icons ms-2 text-end">
                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                        <i class="ti ti-chevrons-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>




    <div class="offcanvas-body">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center flex-wrap flex-md-nowrap row-gap-3">
                    <span class="avatar avatar-xxxl candidate-img flex-shrink-0 me-3">
                        <img src="{{ $site->image ? asset('storage/' . $site->image) : asset('assets/images/site.png') }}" alt="Image du site">
                    </span>
                    <span class="avatar avatar-xxl candidate-img flex-shrink-0 me-3">
                        {!! QrCode::size(70)->generate(route('site.details', $site->id)) !!}
                     </span>
                    <div class="flex-fill border rounded p-3 pb-0">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="mb-6">
                                    <p class="mb-1">Nom du Site </p>
                                    <h6 class="fw-normal"> {{ $site->name }} </h6>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <p class="mb-1">Localisation</p>
                                    <h6 class="fw-normal">{{ $site->location }}</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Status</p>
                                    <h6 class="fw-normal">
                                        @if($site->status == 1)
                                            <span class="badge bg-success">Actif</span> <!-- Vert pour Actif -->
                                        @else
                                            <span class="badge bg-danger">Inactif</span> <!-- Rouge pour Inactif -->
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Quartier/District/Village</p>
                                    <h6 class="fw-normal">{{ $site->district }}</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Ville & Pays</p>
                                    <h6 class="fw-normal">{{ $site->city }} {{ $site->country->name}}</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Catégorie</p>
                                    <span class="badge badge-purple d-inline-flex align-items-center">{{ $site->category->name ?? '---' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-grids-tab p-0 mb-3">
            <ul class="nav nav-underline" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active pt-0" id="info-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button" role="tab" aria-selected="true">Informations du site</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link pt-0" id="address-tab2" data-bs-toggle="tab" data-bs-target="#address2" type="button" role="tab" aria-selected="false">Histoire</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link pt-0" id="address-tab2" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-selected="false">
                        {{ $site->reviews->count() ?? 0 }} Avis Clients
                        @if ($site->average_rating)
                        <span class="text-warning">
                            @if ($site->reviews->count() > 0)
                            <i class="fas fa-star"></i>
                            @else
                            <i class="far fa-star"></i>
                            @endif
                        </span>
                        ({{ number_format($site->average_rating, 1) }}/5)
                    @endif
                    </button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                <div class="card">
                    {{-- <div class="card-header">
                        <h5>Informations du site</h5>
                    </div> --}}
                    <div class="card-body pb-0">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Description</p>
                                    <h6 class="fw-normal">{{ $site->description }}</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Accessibilité</p>
                                    <h6 class="fw-normal">{{ $site->accessibility }}</h6>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="mb-3">
                                    <p class="mb-1">Réservé</p>
                                    <h6 class="fw-normal"> {{ $site->reservations()->count() }} fois</h6>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="mb-3">
                                    <p class="mb-1">Vu</p>
                                    <h6 class="fw-normal"> {{ $site->views()->count() }} fois</h6>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <p class="mb-1">Ajouté le:</p>
                                    <h6 class="fw-normal">{{ \Carbon\Carbon::parse($site->created_at)->format('d/m/Y') }}</h6>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <p class="mb-1">Prix:</p>
                                    <h6 class="fw-normal">{{ $site->info }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="address2" role="tabpanel" aria-labelledby="address-tab2" tabindex="0">
                <div class="card">
                    {{-- <div class="card-header">
                        <h5>Histoire</h5>
                    </div> --}}
                    <div class="card-body">
                        <p>{{ $site->history }}</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="address-tab2" tabindex="0">
                <div class="card">
                    <div class="card-body row align-items-center">
                        @if ($site->reviews && $site->reviews->count())
                            @foreach ($site->reviews as $review)
                                <div class="mb-4 border-bottom pb-2 col-md-4">
                                    <h6 class="mb-1">
                                        {{ $review->client?->lastname . ' ' . $review->client?->firstname ?? 'Utilisateur inconnu' }}
                                        {{-- Affichage étoiles --}}
                                        <span class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($review->rating))
                                                    <i class="fas fa-star"></i>
                                                @elseif ($i - $review->rating < 1)
                                                    <i class="fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </span>
                                        ({{ $review->rating }}/5)
                                    </h6>

                                    <small class="text-muted">{{ $review->created_at->format('d/m/Y à H:i') }}</small>
                                    <p class="mt-2">{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        @else
                            @include('partials.empty')
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>



    <!-- Edit Site -->
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
                                    <label for="location" class="form-label">Localisation <span class="text-danger">*</span></label>
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
                                    <label for="district" class="form-label">Quartier/District/Village <span class="text-danger">*</span></label>
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
                                    <small class="form-text text-muted text-info">Si vous préférez ajouter un lien vidéo (YouTube, Vimeo, etc.), entrez-le ici</small>
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
                            <div id="map" class="h-64 w-full rounded-xl shadow mb-3" ></div>

                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary mb-3">Mettre à jour</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Edit Site -->

@endsection
