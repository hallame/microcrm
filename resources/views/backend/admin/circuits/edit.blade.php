@extends('backend.admin.layout.master')
@section('title') Éditer le Circuit @endsection

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1">Éditer le Circuit</h2>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="{{ route('admin.circuits') }}" class="btn btn-primary d-flex align-items-center">
                <i class="ti ti-arrow-left me-2"></i>Retour aux circuits
            </a>
        </div>
        <div class="ms-2 head-icons">
            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                <i class="ti ti-chevrons-up"></i>
            </a>
        </div>
    </div>
</div>

<!-- Edit Circuit -->
<form action="{{ route('admin.circuit.update', $circuit->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="modal-body">
        <div class="row">
            <!-- Nom du circuit -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom du circuit <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name"
                        id="name"
                        value="{{ old('name', $circuit->name) }}"
                        placeholder="Entrer le nom du circuit"
                        required
                    >
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Aperçu + upload de la nouvelle image -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="image" class="form-label">Image du circuit</label>
                    @if($circuit->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $circuit->image) }}"
                                 alt="Aperçu image {{ $circuit->name }}"
                                 class="img-thumbnail"
                                 style="max-height: 120px;">
                        </div>
                    @endif
                    <input
                        type="file"
                        class="form-control @error('image') is-invalid @enderror"
                        name="image"
                        id="image"
                        accept="image/*"
                    >
                    <small class="text-muted">Formats acceptés : jpg, png, gif, max 2 Mo. Laisser vide pour conserver l’image actuelle.</small>
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Catégorie du circuit -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Catégorie<span class="text-danger">*</span></label>
                    <select
                        class="form-select @error('category_id') is-invalid @enderror"
                        name="category_id"
                        id="category_id"
                        required
                    >
                        <option value="">Sélectionner une catégorie</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id', $circuit->category_id) == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <!-- Info sur le prix / note -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="note" class="form-label">Info sur le prix</label>
                    <input
                        type="text"
                        id="note"
                        name="note"
                        class="form-control @error('note') is-invalid @enderror"
                        value="{{ old('note', $circuit->note) }}"
                        placeholder="Ex : À partir de ...">
                    @error('note')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Sélection des sites -->
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="sites" class="form-label">Sites du circuit <span class="text-danger">*</span></label>
                    <select
                        class="form-select select2 @error('sites') is-invalid @enderror"
                        name="sites[]"
                        id="sites"
                        multiple
                        required
                        data-placeholder="Sélectionnez les sites"
                    >
                        @foreach ($sites as $site)
                            <option
                                value="{{ $site->id }}"
                                {{ collect(old('sites', $circuit->sites->pluck('id')->toArray()))
                                    ->contains($site->id) ? 'selected' : '' }}
                            >
                                {{ $site->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted text-info">Sélectionnez plusieurs sites (Ctrl/Cmd + clic)</small>
                    @error('sites')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Description du circuit -->
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        cols="30"
                        rows="4"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Entrez une brève description"
                    >{{ old('description', $circuit->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Boutons -->
    <div class="modal-footer">
        <button class="btn btn-outline-light border me-2" type="button" data-bs-dismiss="modal">Annuler</button>
        <button class="btn btn-primary" type="submit">Mettre à jour</button>
    </div>
</form>

{{-- Script pour initialiser Select2 --}}
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            allowClear: true,
            placeholder: $(this).data('placeholder')
        });
    });
</script>
@endsection
