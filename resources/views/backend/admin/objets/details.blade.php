@extends('backend.admin.layout.master')
@section('title') Détails Objet @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.objects') }}">
                <i class="ti ti-arrow-left me-2"></i>Retour</a>
            </h6>
            <div class="d-flex">
                <div class="text-end">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_object"><i class="ti ti-edit me-1"></i>Modifier</a>
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
                        <img src="{{ $object->image ? asset('storage/' . $object->image) : asset('assets/images/object.png') }}" alt="Image">
                    </span>
                    <span class="avatar avatar-xl candidate-img flex-shrink-0 me-3">
                        {!! QrCode::size(70)->generate(route('object.details', $object->id)) !!}
                     </span>
                    <div class="flex-fill border rounded p-2 pb-0">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Nom  </p>
                                    <h6 class="fw-normal"> {{ $object->name }} </h6>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Musée</p>
                                    <h6 class="fw-normal">{{ $object->museum->name }}</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Status</p>
                                    <h6 class="fw-normal">
                                        @if($object->status == 1)
                                            <span class="badge bg-success">Actif</span> <!-- Vert pour Actif -->
                                        @else
                                            <span class="badge bg-danger">Inactif</span> <!-- Rouge pour Inactif -->
                                        @endif
                                    </h6>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <p class="mb-1">Catégorie</p>
                                    <span class="badge badge-purple d-inline-flex align-items-center">{{ $object->category->name ?? '---' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <p class="mb-1">Nom local</p>
                                    <h6 class="fw-normal">{{ $object->local_name ?? '---' }}</h6>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <p class="mb-1">Ethnie</p>
                                    <h6 class="fw-normal">{{ $object->ethnic ?? '---' }}</h6>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <p class="mb-1">Localité</p>
                                    <h6 class="fw-normal">{{ $object->locality ?? '---' }}</h6>
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
                <li class="nav-item" role="presentation">
                  <button class="nav-link pt-0" id="address-tab2" data-bs-toggle="tab" data-bs-target="#address2" type="button" role="tab" aria-selected="false">Usage / Fonction</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link pt-0" id="address-tab2" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-selected="false">
                        {{ $object->reviews->count() ?? 0 }} Avis Clients
                        @if ($object->average_rating)
                        <span class="text-warning">
                            @if ($object->reviews->count() > 0)
                            <i class="fas fa-star"></i>
                            @else
                            <i class="far fa-star"></i>
                            @endif
                        </span>
                        ({{ number_format($object->average_rating, 1) }}/5)
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
                                    <h6 class="fw-normal">{{ $object->description }}</h6>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="mb-3">
                                    <p class="mb-1">Vu</p>
                                    <h6 class="fw-normal"> {{ $object->views()->count() }} fois</h6>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <p class="mb-1">Ajouté le:</p>
                                    <h6 class="fw-normal">{{ \Carbon\Carbon::parse($object->created_at)->format('d/m/Y') }}</h6>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <p class="mb-1">Ajouté le:</p>
                                    <h6 class="fw-normal">{{ \Carbon\Carbon::parse($object->created_at)->format('d/m/Y') }}</h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="address2" role="tabpanel" aria-labelledby="address-tab2" tabindex="0">
                <div class="card">
                    <div class="card-body">
                        <p>{{ $object->function }}</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="address-tab2" tabindex="0">
                <div class="card">
                    <div class="card-body row align-items-center">
                        @if ($object->reviews && $object->reviews->count())
                            @foreach ($object->reviews as $review)
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



    <!-- Edit object -->
    <div class="modal fade" id="edit_object">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier</h4>
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
                                    <input type="text" name="local_name"  required class="form-control" placeholder="Nom local ou nom traditionnel" value="{{ old('local_name', $object->local_name) }}">
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
                                    <input type="text" name="ethnic" class="form-control" required  placeholder="Ex: Kpèlè, Manon, Kissi..." value="{{ old('ethnic', $object->ethnic) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="locality" class="form-label">Localité <span class="text-danger">*</span></label>
                                    <input type="text" name="locality" required  class="form-control" placeholder="Ex: Kouankan, Lola, Beyla..." value="{{ old('locality', $object->locality) }}">
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
    <!-- /Edit object -->

@endsection
