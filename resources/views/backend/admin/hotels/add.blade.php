@extends('backend.admin.layout.master')
@section('title') Ajouter un Hôtel @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.hotels') }}">
                <i class="ti ti-arrow-left me-2"></i>Retour</a>
            </h6>
            <div class="d-flex">
                <div class="text-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary"><i class="ti ti-circle-arrow-up me-1"></i>Tableau de board</a>
                </div>
                <div class="head-icons ms-2 text-end">
                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                        <i class="ti ti-chevrons-up"></i>
                    </a>
                </div>
            </div>
        </div>
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
@endsection
