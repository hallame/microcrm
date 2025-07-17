@extends('backend.admin.layout.master')
@section('title') Nouveau Circuit @endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1">Nouveau Circuit</h2>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="{{ route('admin.circuits') }}" class="btn btn-primary d-flex align-items-center"><i class="ti ti-arrow-left me-2"></i>Retour aux circuits</a>
        </div>
        <div class="ms-2 head-icons">
            <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                <i class="ti ti-chevrons-up"></i>
            </a>
        </div>
    </div>
</div>
<!-- Add Circuit -->


<form action="{{ route('admin.circuit.add') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="row">
            <!-- Nom du circuit -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom du circuit <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        placeholder="Entrer le nom du circuit"
                        required
                    >
                </div>
            </div>
            <!-- Image du circuit -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="image" class="form-label">Image du circuit<span class="text-danger">*</span></label>
                    <input
                        type="file"
                        class="form-control"
                        name="image"
                        id="image"
                        accept="image/*"
                    >
                    <small class="text-muted">Formats acceptés : jpg, png, gif, max 2 Mo</small>
                </div>
            </div>


            <!-- Catégorie du circuit -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Catégorie<span class="text-danger">*</span></label>
                    <select class="form-select" name="category_id" id="category_id">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-3">

            <div class="col-md-4">
                    <div class="mb-3">
                        <label for="note" class="form-label">Info sur le prix</label>
                        <input type="text" id="note" name="note" class="form-control" placeholder="Ex: A partir de ...">
                    </div>
                </div>

             <!-- Sélection des sites -->
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="sites" class="form-label">Sites du circuit <span class="text-danger">*</span></label>
                    <select
                        class="form-select select2"
                        name="sites[]"
                        id="sites"
                        multiple
                        required
                        onchange="updateLeaderOptions()"
                        data-placeholder="Sélectionnez les sites"
                    >
                        @foreach ($sites as $site)
                            <option value="{{ $site->id }}">{{ $site->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted text-info">Sélectionnez plusieurs sites</small>
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
                        rows="3"
                        class="form-control"
                        placeholder="Entrez une brève description"
                    ></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Boutons -->
    <div class="modal-footer">
        <button class="btn btn-outline-light border me-2" type="button" data-bs-dismiss="modal">Annuler</button>
        <button class="btn btn-primary" type="submit">Enregistrer</button>
    </div>
</form>

{{-- <form action="{{ route('admin.circuit.add') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="row">
            <!-- Nom de l'équipe -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom du circuit</label>
                    <input type="text" class="form-control" name="name" placeholder="Entrer le nom du circuit" required>
                </div>
            </div>

            <!-- Sélection des circuits -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="sites" class="form-label">Sites du circuit</label>
                    <select class="form-select select2" name="sites[]" id="sites" multiple required onchange="updateLeaderOptions()" data-placeholder="Sélectionnez les sites">
                        @foreach ($sites as $site)
                            <option value="{{ $site->id }}">{{ $site->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted text-info">Sélectionnez plusieurs sites</small>
                </div>

            </div>


            <!-- Catégorie de l'équipe -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Catégorie</label>
                    <select class="select" name="category_id">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


        </div>
    </div>

    <!-- Boutons -->
    <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Enregistrer</button>
    </div>
</form> --}}
<!-- /Add Circuit -->
<script>
    function updateLeaderOptions() {
        let selectedCircuits = document.getElementById('circuits').selectedOptions;
        let leaderSelect = document.getElementById('leader_id');
        leaderSelect.innerHTML = '<option value="">Sélectionner le circuit principal</option>';

        for (let i = 0; i < selectedCircuits.length; i++) {
            let option = document.createElement('option');
            option.value = selectedCircuits[i].value;
            option.text = selectedCircuits[i].text;
            leaderSelect.appendChild(option);
        }
    }

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%', // Ajuste la largeur
            allowClear: true, // Ajoute une option pour effacer la sélection
            placeholder: $(this).data('placeholder') // Utilise le placeholder défini dans l’attribut data-placeholder
        });
    });
</script>
@endsection

