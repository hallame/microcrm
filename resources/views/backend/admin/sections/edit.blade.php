@extends('backend.admin.layout.master')
@section('title') Modifier Section @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.sections') }}">
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
    <form action="{{ route('admin.section.update', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body pb-0">
            <div class="row">

                {{-- Titre --}}
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $section->title) }}" required>
                </div>

                {{-- Sous-titre --}}
                <div class="col-md-6 mb-3">
                    <label for="subtitle" class="form-label">Sous-titre</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control"
                        value="{{ old('subtitle', $section->subtitle) }}">
                </div>

                <div class="col-md-6 mb-3">
                    {{-- <label for="language_id" class="form-label">Langue</label>
                    <select name="language_id" id="language_id" class="form-control" required>
                        @foreach($languages as $lang)
                            <option value="{{ $lang->id }}" {{ old('language_id', $section->language_id) == $lang->id ? 'selected' : '' }}>
                                {{ $lang->name }}
                            </option>
                        @endforeach
                    </select> --}}
                    <input type="hidden" name="language_id" value="{{ old('language_id', $section->language_id) }}">
                </div>

                {{-- Contenu --}}
                <div class="col-md-12 mb-3">
                    <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                    <textarea name="content" id="omizixEditor" class="form-control" rows="8" required>{{ old('content', $section->content) }}</textarea>
                </div>

                {{-- Texte du bouton --}}
                <div class="col-md-6 mb-3">
                    <label for="btn_text" class="form-label">Texte du bouton</label>
                    <input type="text" name="btn_text" id="btn_text" class="form-control"
                        value="{{ old('btn_text', $section->btn_text) }}" placeholder="Ex : En savoir plus">
                </div>

                {{-- Lien du bouton --}}
                <div class="col-md-6 mb-3">
                    <label for="btn_link" class="form-label">Lien du bouton</label>
                    <input type="url" name="btn_link" id="btn_link" class="form-control"
                        value="{{ old('btn_link', $section->btn_link) }}" placeholder="Ex : https://zalymerveille.com/....">
                </div>

                {{-- Image --}}
                <div class="col-md-4 mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @if($section->image)
                        <small class="d-block mt-1 text-muted">Image actuelle : {{ basename($section->image) }}</small>
                    @endif
                </div>

                {{-- Vidéo (upload) --}}
                {{-- <div class="col-md-4 mb-3">
                    <label for="video" class="form-label">Vidéo (upload)</label>
                    <input type="file" name="video" id="video" class="form-control" accept="video/*">
                    @if($section->video)
                        <small class="d-block mt-1 text-muted">Vidéo actuelle : {{ basename($section->video) }}</small>
                    @endif
                </div> --}}

                {{-- URL de la vidéo --}}
                {{-- <div class="col-md-4 mb-3">
                    <label for="video_url" class="form-label">URL de la vidéo</label>
                    <input type="url" name="video_url" id="video_url" class="form-control"
                        value="{{ old('video_url', $section->video_url) }}">
                </div> --}}

                {{-- Submit --}}
                <div class="col-md-12 text-end mb-3">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>

            </div>
        </div>
    </form>
@endsection
