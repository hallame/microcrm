@extends('backend.admin.layout.master')
@section('title') Détails Hôtel @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.hotels') }}">
                <i class="ti ti-arrow-left me-2"></i>Retour</a>
            </h6>
            <div class="d-flex">
                <div class="text-end">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_hotel"><i class="ti ti-edit me-1"></i>Modifier</a>
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
                        <img src="{{ $hotel->image ? asset('storage/' . $hotel->image) : asset('assets/images/hotel.png') }}" alt="Image">
                    </span>
                    {{-- <span class="avatar avatar-xxl candidate-img flex-shrink-0 me-3">
                        {!! QrCode::size(70)->generate(route('hotel.details', $hotel->id)) !!}
                     </span> --}}
                    <div class="flex-fill border rounded p-3 pb-0">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <p class="mb-1">Nom </p>
                                    <h6 class="fw-normal"> {{ $hotel->name }} </h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <p class="mb-1">Ville & Pays</p>
                                    <h6 class="fw-normal">{{ $hotel->city }} {{ $hotel->country->name}}</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <p class="mb-1">Localisation</p>
                                    <h6 class="fw-normal">{{ $hotel->location }}</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <p class="mb-1">Status</p>
                                    <h6 class="fw-normal">
                                        @if($hotel->status == 1)
                                            <span class="badge bg-success">Actif</span> <!-- Vert pour Actif -->
                                        @else
                                            <span class="badge bg-danger">Inactif</span> <!-- Rouge pour Inactif -->
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="mb-3">
                                    <p class="mb-1">Quartier/District/Village</p>
                                    <h6 class="fw-normal">{{ $hotel->district }}</h6>
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <p class="mb-1">Catégorie</p>
                                    <span class="badge badge-purple d-inline-flex align-items-center">{{ $hotel->category->name ?? '---' }}</span>
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
                  <button class="nav-link active pt-0" id="info-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button" role="tab" aria-selected="true">Informations</button>
                </li>
                {{-- <li class="nav-item" role="presentation">
                  <button class="nav-link pt-0" id="address-tab2" data-bs-toggle="tab" data-bs-target="#address2" type="button" role="tab" aria-selected="false">Histoire</button>
                </li> --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link pt-0" id="address-tab2" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-selected="false">
                        {{ $hotel->reviews->count() ?? 0 }} Avis Clients
                        @if ($hotel->average_rating)
                        <span class="text-warning">
                            @if ($hotel->reviews->count() > 0)
                            <i class="fas fa-star"></i>
                            @else
                            <i class="far fa-star"></i>
                            @endif
                        </span>
                        ({{ number_format($hotel->average_rating, 1) }}/5)
                    @endif
                    </button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                <div class="card">

                    <div class="card-body pb-0">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Description</p>
                                    <h6 class="fw-normal">{{ $hotel->description }}</h6>
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Accessibilité</p>
                                    <h6 class="fw-normal">{{ $hotel->accessibility }}</h6>
                                </div>
                            </div> --}}

                            <div class="col-md-1">
                                <div class="mb-3">
                                    <p class="mb-1">Réservé</p>
                                    {{-- <h6 class="fw-normal"> {{ $hotel->reservations()->count() }} fois</h6> --}}
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="mb-3">
                                    <p class="mb-1">Vu</p>
                                    <h6 class="fw-normal"> {{ $hotel->views()->count() }} fois</h6>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <p class="mb-1">Ajouté le:</p>
                                    <h6 class="fw-normal">{{ \Carbon\Carbon::parse($hotel->created_at)->format('d/m/Y') }}</h6>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <p class="mb-1">Ajouté le:</p>
                                    <h6 class="fw-normal">{{ \Carbon\Carbon::parse($hotel->created_at)->format('d/m/Y') }}</h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="tab-pane fade" id="address2" role="tabpanel" aria-labelledby="address-tab2" tabindex="0">
                <div class="card">

                    <div class="card-body">
                        <p>{{ $hotel->history }}</p>
                    </div>
                </div>
            </div> --}}
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="address-tab2" tabindex="0">
                <div class="card">
                    <div class="card-body row align-items-center">
                        @if ($hotel->reviews && $hotel->reviews->count())
                            @foreach ($hotel->reviews as $review)
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



    <!-- Edit hotel -->
    <div class="modal fade" id="edit_hotel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('admin.hotel.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body pb-0">
                        <div class="row">

                            {{-- Nom de l'hôtel --}}
                            <div class="col-md-4">
                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $hotel->name }}" required>
                            </div>

                            {{-- Ville --}}
                            <div class="col-md-4">
                                <label for="city" class="form-label">Ville <span class="text-danger">*</span></label>
                                <input type="text" name="city" id="city" class="form-control" value="{{ $hotel->city }}" required>
                            </div>

                            {{-- Emplacement --}}
                            <div class="col-md-4">
                                <label for="location" class="form-label">Emplacement</label>
                                <input type="text" name="location" id="location" class="form-control" value="{{ $hotel->location }}">
                            </div>

                            {{-- Adresse --}}
                            <div class="col-md-4">
                                <label for="address" class="form-label">Adresse</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $hotel->address }}">
                            </div>

                            {{-- Téléphone --}}
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $hotel->phone }}">
                            </div>

                            {{-- Email --}}
                            <div class="col-md-4">
                                <label for="email" class="form-label">Adresse email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $hotel->email }}">
                            </div>

                            {{-- Pays --}}
                            <div class="col-md-4">
                                <label for="country_id" class="form-label">Pays</label>
                                <select name="country_id" id="country_id" class="form-control">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ $hotel->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Catégorie --}}
                            <div class="col-md-4">
                                <label for="category_id" class="form-label">Catégorie</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">-- Sélectionner une catégorie --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $hotel->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Langue --}}
                            <div class="col-md-4">
                                <label for="language_id" class="form-label">Langue</label>
                                <select name="language_id" id="language_id" class="form-control">
                                    @foreach($languages as $lang)
                                        <option value="{{ $lang->id }}" {{ $hotel->language_id == $lang->id ? 'selected' : '' }}>{{ $lang->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Chambres disponibles --}}
                            <div class="col-md-4">
                                <label for="rooms_available" class="form-label">Chambres disponibles</label>
                                <input type="number" name="rooms_available" id="rooms_available" class="form-control" value="{{ $hotel->rooms_available }}">
                            </div>

                            {{-- Total chambres --}}
                            <div class="col-md-4">
                                <label for="total_rooms" class="form-label">Nombre total de chambres</label>
                                <input type="number" name="total_rooms" id="total_rooms" class="form-control" value="{{ $hotel->total_rooms }}">
                            </div>

                            {{-- Prix par nuit --}}
                            <div class="col-md-4">
                                <label for="price_per_night" class="form-label">Prix par nuit</label>
                                <input type="number" step="0.01" name="price_per_night" id="price_per_night" class="form-control" value="{{ $hotel->price_per_night }}">
                            </div>

                            {{-- Installations --}}
                            <div class="col-md-8">
                                <label for="facilities" class="form-label">Installations</label>
                                <input type="text" name="facilities" id="facilities" class="form-control" value="{{ $hotel->facilities }}">
                            </div>



                            {{-- Statut --}}
                            <div class="col-md-4">
                                <label for="status" class="form-label">Statut</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $hotel->status == 1 ? 'selected' : '' }}>Actif</option>
                                    <option value="0" {{ $hotel->status == 0 ? 'selected' : '' }}>Inactif</option>
                                </select>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-8">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="5">{{ $hotel->description }}</textarea>
                            </div>
                             {{-- Image --}}
                             <div class="col-md-4">
                                <label for="image" class="form-label">Image principale</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                @if($hotel->image)
                                    <small class="d-block mt-1">Image actuelle : <br><img src="{{ asset('storage/'.$hotel->image) }}" alt="Image de l'hôtel" style="max-width: 100px;"></small>
                                @endif
                            </div>

                            {{-- Bouton de soumission --}}
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-success mt-3">Mettre à jour</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Edit hotel -->

@endsection
