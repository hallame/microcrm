@extends('backend.admin.layout.master')
@section('title') Modifier Slider @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.sliders') }}">
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
    <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body pb-0">
            <div class="row">
                {{-- Titre --}}
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $slider->title) }}" placeholder="Ex : Bienvenue à Zaly Merveille">
                </div>

                {{-- Sous-titre --}}
                <div class="col-md-6 mb-3">
                    <label for="subtitle" class="form-label">Sous-titre</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control"
                        value="{{ old('subtitle', $slider->subtitle) }}" placeholder="Ex : Explorez les trésors cachés">
                </div>

                {{-- Type --}}
                {{-- <div class="col-md-6 mb-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" name="type" id="type" class="form-control"
                        value="{{ old('type', $slider->type) }}" placeholder="Ex : intro, promo, guinee">
                </div> --}}

                {{-- Langue --}}
                <div class="col-md-6 mb-3">
                    <label for="language_id" class="form-label">Langue</label>
                    <select name="language_id" id="language_id" class="form-control" required>
                        @foreach($languages as $lang)
                            <option value="{{ $lang->id }}" {{ old('language_id', $slider->language_id) == $lang->id ? 'selected' : '' }}>
                                {{ $lang->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Page --}}
                {{-- <div class="col-md-6 mb-3">
                    <label for="page" class="form-label">Page</label>
                    <input type="text" name="page" id="page" class="form-control"
                        value="{{ old('page', $slider->page) }}" placeholder="Ex : accueil, guinee-forestiere">
                </div> --}}

                {{-- Page liée --}}
                {{-- <div class="col-md-6 mb-3">
                    <label for="page_id" class="form-label">Page liée</label>
                    <select name="page_id" id="page_id" class="form-control">
                        <option value="">-- Aucune --</option>
                        @foreach($pages as $page)
                            <option value="{{ $page->id }}" {{ old('page_id', $slider->page_id) == $page->id ? 'selected' : '' }}>
                                {{ $page->title }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                {{-- Image --}}
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @if($slider->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $slider->image) }}" alt="Image actuelle" class="img-thumbnail" width="120">
                        </div>
                    @endif
                </div>

                {{-- Submit --}}
                <div class="col-md-12 text-end mb-3">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </div>
        </div>
    </form>

@endsection
