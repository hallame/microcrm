@extends('backend.admin.layout.master')
@section('title') Nouvelle Équipe @endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1">Nouvelle Equipe</h2>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="{{ route('admin.teams') }}" class="btn btn-primary d-flex align-items-center"><i class="ti ti-arrow-left me-2"></i>Retour aux equipes</a>
        </div>
        <div class="ms-2 head-icons">
            <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                <i class="ti ti-chevrons-up"></i>
            </a>
        </div>
    </div>
</div>
<!-- Add Team -->
<form action="{{ route('admin.team.add') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="row">
            <!-- Nom de l'équipe -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de l'équipe</label>
                    <input type="text" class="form-control" name="name" placeholder="Entrer le nom de l'équipe" required>
                </div>
            </div>

            <!-- Sélection des experts -->
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="experts" class="form-label">Membres de l'équipe</label>
                    <select class="form-select select2" name="experts[]" id="experts" multiple required onchange="updateLeaderOptions()" data-placeholder="Sélectionnez les experts">
                        @foreach ($experts as $expert)
                            <option value="{{ $expert->id }}">{{ $expert->firstname }} {{ $expert->lastname }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Sélectionnez plusieurs experts</small>
                </div>

            </div>

            <!-- Sélection du chef d'équipe -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="leader_id" class="form-label">Chef d'équipe</label>
                    <select class="select" name="leader_id" id="leader_id" required>
                        <option value="">Sélectionner le  leader</option>
                        <!-- Options dynamiques en fonction des experts choisis -->
                    </select>
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

            <!-- Statut -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select class="form-select" name="status">
                        <option value="1" selected>Actif</option>
                        <option value="0">Inactif</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Boutons -->
    <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Enregistrer</button>
    </div>
</form>
<!-- /Add Team -->

<script>
    function updateLeaderOptions() {
        let selectedExperts = document.getElementById('experts').selectedOptions;
        let leaderSelect = document.getElementById('leader_id');
        leaderSelect.innerHTML = '<option value="">Sélectionner un leader</option>';

        for (let i = 0; i < selectedExperts.length; i++) {
            let option = document.createElement('option');
            option.value = selectedExperts[i].value;
            option.text = selectedExperts[i].text;
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

