@extends('backend.admin.layout.master')
@section('title') Modifier site @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.sites') }}">
                <i class="ti ti-arrow-left me-2"></i>Retour</a>
            </h6>
            <div class="d-flex">
                <div class="text-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" ><i class="ti ti-circle-arrow-up me-1"></i>Tableau de board</a>
                </div>
                <div class="head-icons ms-2 text-end">
                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                        <i class="ti ti-chevrons-up"></i>
                    </a>
                </div>
            </div>
        </div>
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
                {{-- <div id="map" class="h-64 w-full rounded-xl shadow mb-3" ></div> --}}

                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary mb-3">Mettre à jour</button>
                </div>
            </div>
        </div>
    </form>


@endsection
