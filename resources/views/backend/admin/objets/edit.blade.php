@extends('backend.admin.layout.master')
@section('title') Modifier cet objet @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.objects') }}">
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
                        <input type="text" name="ethnic"  required class="form-control" placeholder="Ex: Kpèlè, Manon, Kissi..." value="{{ old('ethnic', $object->ethnic) }}">
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
@endsection
