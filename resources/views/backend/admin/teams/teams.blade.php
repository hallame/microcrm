@extends('backend.admin.layout.master')
@section('title') Équipes @endsection
@section('content')

<div class="row">
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-pink-transparent border border-pink d-flex align-items-center justify-content-center">
                                <i class="ti ti-users-group text-pink fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Équipes</p>
                            <h4>{{ $totalTeams }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-success-transparent border border-success d-flex align-items-center justify-content-center">
                                <i class="ti ti-briefcase fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Projets d'équipes</p>
                            <h4>{{ array_sum(array_column($teamsData['projects']['teams']->toArray(), 'total')) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-info-transparent border border-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-star fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Note Moyenne</p>
                            <h4>{{ number_format($teamsData['projects']['teams']->pluck('averageReview')->avg(), 2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_team" class="btn btn-primary d-flex align-items-center text-center"><i class="ti ti-circle-plus me-2"></i>Former une équipe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@if($teams->count())
    @foreach($teams as $team)
        <div class="row">
            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <h5>Membres de {{ $team->name }}
                                <span class="badge {{ $team->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $team->status == 1 ? 'Actif' : 'Inactif' }}
                                </span>
                                <span class="fs-10 fw-medium badge {{ $team->randomColor }}">
                                    <i class="ti ti-point-filled"></i> {{ $team->category ?? 'Catégorie non définie' }}
                                </span>
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($team->experts->count())
                            @foreach ($team->experts as $expert)
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                            <img src="{{ asset('assets/images/dev.png') }}" class="rounded-circle border border-2" alt="img">
                                        </a>
                                        <div class="ms-2">
                                            <h6 class="fs-14 fw-medium text-truncate mb-1">
                                                <a href="#">{{ $expert->firstname }} {{ $expert->lastname }}</a>
                                            </h6>
                                            <p class="fs-13">
                                                {{ $expert->profession ?? 'Non défini' }} -
                                                {{ $team->leader_id == $expert->id ? 'Chef d\'équipe' : 'Membre' }} -
                                                <span class="badge {{ $expert->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $expert->status == 1 ? 'Actif' : 'Inactif' }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="tel:{{ $expert->phone }}" class="btn btn-light btn-icon btn-sm me-2">
                                            <i class="ti ti-phone fs-16"></i>
                                        </a>
                                        <a href="mailto:{{ $expert->email }}" class="btn btn-light btn-icon btn-sm me-2">
                                            <i class="ti ti-mail-bolt fs-16"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center text-muted">Aucun membre dans cette équipe.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5>Statistiques {{ $team->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <h6 class="mb-3">Total Projets: {{ $teamsData['projects']['teams'][$team->id]['total'] ?? 0 }}</h6>
                            @if(isset($teamsData['projects']['teams'][$team->id]))
                                <div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <p class="f-13 mb-0"><i class="ti ti-circle-filled text-secondary me-1"></i>En Attente</p>
                                        <p class="f-13 fw-medium text-gray-9">{{ $teamsData['projects']['teams'][$team->id]['pendingProjectsPercent'] ?? 0 }}%</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <p class="f-13 mb-0"><i class="ti ti-circle-filled text-warning me-1"></i>En Cours</p>
                                        <p class="f-13 fw-medium text-gray-9">{{ $teamsData['projects']['teams'][$team->id]['inProgressProjectsPercent'] ?? 0 }}%</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <p class="f-13 mb-0"><i class="ti ti-circle-filled text-success me-1"></i>Terminés</p>
                                        <p class="f-13 fw-medium text-gray-9">{{ $teamsData['projects']['teams'][$team->id]['completedProjectsPercent'] ?? 0 }}%</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <p class="f-13 mb-0"><i class="ti ti-circle-filled text-purple me-1"></i>En Retard</p>
                                        <p class="f-13 fw-medium text-gray-9">{{ $teamsData['projects']['teams'][$team->id]['overdueProjectsPercent'] ?? 0 }}%</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="f-13 mb-0"><i class="ti ti-circle-filled text-danger me-1"></i>Rejetés</p>
                                        <p class="f-13 fw-medium text-gray-9">{{ $teamsData['projects']['teams'][$team->id]['rejectedProjectsPercent'] ?? 0 }}%</p>
                                    </div>
                                </div>
                            @else
                                <p>Aucune donnée pour cette équipe</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="text-center p-4">
        <img src="{{ asset('assets/images/empty.png') }}" alt="Pas d'équipe" width="150">
        <p class="text-muted mt-3">Vous n'appartenez à aucune équipe.</p>
    </div>
@endif


<!-- Add Team -->
<div class="modal fade" id="add_team" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header header-border align-items-center justify-content-between">
				<div class="d-flex align-items-center">
					<h5 class="modal-title me-2">Former une equipe </h5>
				</div>
				<button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
					<i class="ti ti-x"></i>
				</button>
			</div>
			<div class="add-info-fieldset ">
				<div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-tab" tabindex="0">
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
                                                <option value="">Sélectionner le leader</option>
                                                <!-- Options dynamiques en fonction des experts choisis -->
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Catégorie de l'équipe -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Catégorie</label>
                                            <select class="select" name="category_id" required>
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
                                <button type="button" class="btn btn-outline-light border me-2" data-bs-dismiss="modal">Annuler</button>
                                <button class="btn btn-primary" type="submit">Enregistrer</button>
                            </div>
                        </form>
                    </div>
			    </div>
		    </div>
	    </div>
	</div>
</div>
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





{{-- @extends('backend.admin.layout.master')
@section('title') Équipes @endsection
@section('content')
    <!-- Équipes Grid -->
    <div class="row">
        @if ($totalTeams > 0)
            @foreach($teams as $team)
                <div class="col-xxl-3 col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center flex-shrink-0">
                                    <a class="avatar avatar-lg avatar rounded-circle me-2" data-bs-toggle="offcanvas" data-bs-target="#candidate_details">
                                        <img src="{{ asset('assets/images/team.png') }}" class="img-fluid h-auto w-auto" alt="img">
                                    </a>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-wrap mb-1">
                                            <h6 class="fs-16 fw-semibold me-1">
                                                <a data-bs-toggle="offcanvas" data-bs-target="#candidate_details">
                                                    {{ $team->name }}
                                                </a>
                                            </h6>
                                            <span class="badge {{ $team->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $team->status == 1 ? 'Actif' : 'Inactif' }}
                                            </span>
                                        </div>
                                        @if($team->leader)
                                            <p class="text-gray fs-13 fw-normal">{{ $team->leader->email }}</p>
                                        @else
                                            <p class="text-gray fs-13 fw-normal text-muted">Aucun leader assigné</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="bg-light rounded p-2">
                                <div class="d-flex align-items-center justify-content-between mt-2 mb-2">
                                    <h6 class="text-gray fs-14 fw-normal">Catégorie</h6>
                                    <span class="fs-10 fw-medium badge {{ $team->randomColor }}">
                                        <i class="ti ti-point-filled"></i> {{ $team->category ?? 'Catégorie non définie' }}
                                    </span>
                                </div>
                                @if($team->experts->isNotEmpty())
                                    @foreach($team->experts as $expert)
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <h6 class="text-gray fs-14 fw-normal">
                                                {{ $expert->firstname }} {{ $expert->lastname }}
                                            </h6>
                                            <span class="text-dark fs-14 fw-medium">
                                                {{ $expert->pivot->role ?? 'Membre' }}
                                            </span>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-gray fs-14 fw-normal text-muted">Aucun expert dans cette équipe</p>
                                @endif

                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h6 class="text-gray fs-14 fw-normal">
                                        Projets ({{ $team->projects->count() }})
                                    </h6>
                                    <span class="text-dark fs-12 fw-medium d-flex align-items-center">
                                        @if($team->projects_stats && $team->projects_stats->isNotEmpty())
                                            @foreach($team->projects_stats as $status)
                                            <span class="{{ $status['color'] }}">
                                                <i class="{{ $status['icon'] }} p-1 rounded-circle"></i>
                                                {{ $status['count'] }}
                                            </span>
                                        @endforeach
                                        @endif
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center p-4">
                <img src="{{ asset('assets/images/empty.png') }}" alt="Pas d'équipe" width="150">
                <p class="text-muted mt-3">Vous n'avez encore formé aucune équipe.</p>
            </div>
        @endif
    </div>
    <!-- /Équipes Grid -->
@endsection --}}
