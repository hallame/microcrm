@extends('backend.admin.layout.master')
@section('title') Ajouter une page @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.pages') }}">
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

     <form action="{{ route('admin.page.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body pb-0">
            <div class="row">

                {{-- Titre de la page --}}
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Ex : À propos de nous" required>
                </div>

                {{-- Sous-titre --}}
                <div class="col-md-6 mb-3">
                    <label for="subtitle" class="form-label">Sous-titre</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Ex : Bienvenue sur notre site">
                </div>

                {{-- Meta Title --}}
                <div class="col-md-6 mb-3">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Meta Title pour SEO">
                </div>

                {{-- Meta Description --}}
                <div class="col-md-6 mb-3">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <input type="text" name="meta_description" id="meta_description" class="form-control" placeholder="Description pour SEO">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" placeholder="Ex: tourisme, culture, Guinée">
                    <small class="form-text text-info">Tapez un mot-clé et appuyez sur Entrée ou une virgule.</small>
                </div>


                {{-- Langue --}}
                <div class="col-md-3 mb-3">
                    <label for="language_id" class="form-label">Langue <span class="text-danger">*</span></label>
                    <select name="language_id" id="language_id" class="form-control" required>
                        @foreach($languages as $lang)
                            <option value="{{ $lang->id }}" {{ $lang->id == 1 ? 'selected' : '' }}>{{ $lang->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Type --}}
                <div class="col-md-3 mb-3">
                    <label for="type" class="form-label">Type de page <span class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="" disabled>Selectionner</option>
                        <option value="people">Communautés: Peuples</option>
                        <option value="merveille">Merveilles de Guinée</option>
                        {{-- <option value="women">Femmes et Culture</option> --}}
                        <option value="other">Autre</option>
                    </select>
                </div>

                {{-- Image --}}
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    <img id="previewImage" style="max-width: 100px; display: none;" />
                </div>

                {{-- Bannière --}}
                <div class="col-md-6 mb-3">
                    <label for="banner" class="form-label">Bannière</label>
                    <input type="file" name="banner" id="banner" class="form-control" accept="image/*">
                </div>

                {{-- Vidéo --}}
                <div class="col-md-6 mb-3">
                    <label for="video_url" class="form-label">URL de la vidéo (optionnelle)</label>
                    <input type="url" name="video_url" id="video_url" class="form-control" placeholder="Ex : https://www.youtube.com/...">
                </div>

                {{-- Vidéo téléchargée --}}
                <div class="col-md-6 mb-3">
                    <label for="video" class="form-label">Vidéo (optionnelle)</label>
                    <input type="file" name="video" id="video" class="form-control" accept="video/*">
                </div>


                <div class="col-md-12 mb-3">
                    <label for="info" class="form-label">Citation </label>
                    <textarea name="info" id="info" class="form-control" rows="2" placeholder="**********"></textarea>
                </div>
                {{-- Contenu --}}
                <div class="col-md-12 mb-3">
                    <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                    <textarea name="content" id="omizixEditor" class="form-control" rows="5" placeholder="Contenu de la page..." required></textarea>
                </div>


                {{-- Bouton de soumission --}}
                <div class="col-md-12 text-end mb-3">
                   <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>

            </div>
        </div>
    </form>

@endsection
