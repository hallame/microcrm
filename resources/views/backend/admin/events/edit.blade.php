@extends('backend.admin.layout.master')
@section('title') Modifier Événement @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.events') }}">
                <i class="ti ti-arrow-left me-2"></i>Retour</a>
            </h6>
            <div class="d-flex">
                <div class="text-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_site"><i class="ti ti-circle-arrow-up me-1"></i>Tableau de board</a>
                </div>
                <div class="head-icons ms-2 text-end">
                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                        <i class="ti ti-chevrons-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Pour indiquer que c'est une mise à jour -->
        <div class="modal-body pb-0">
            <div class="row">
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="name" class="form-label">Titre de l’événement <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Festival des arts de la forêt" value="{{ old('name', $event->name) }}" required>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="location" class="form-label">Lieu <span class="text-danger">*</span></label>
                        <input type="text" id="location" name="location" class="form-control" placeholder="Ex: Place publique de Lola" value="{{ old('location', $event->location) }}" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="language_id" class="form-label">Langue <span class="text-danger">*</span></label>
                        <select name="language_id" id="language_id" class="form-control" required>
                            @foreach($languages as $lang)
                                <option value="{{ $lang->id }}" {{ old('language_id', $event->language_id) == $lang->id ? 'selected' : '' }}>{{ $lang->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Catégorie</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="image" class="form-label">Affiche ou image <span class="text-danger">*</span></label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>
                </div>

                <!-- Dates -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Date de début <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i') : '') }}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Date de fin <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') : '') }}" required>
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
                        <input type="url" name="video_url" id="video_url" class="form-control" placeholder="Lien vers la vidéo" value="{{ old('video_url', $event->video_url) }}">
                        <small class="form-text text-muted text-info">Si vous préférez ajouter un lien vidéo (YouTube, Vimeo, etc.), entrez-le ici</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Détails sur l’événement, programme, intervenants, etc." required>{{ old('description', $event->description) }}</textarea>
                    </div>
                </div>
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary mb-3">Mettre à jour</button>
                </div>
            </div>
        </div>
    </form>



@endsection
