@extends('backend.admin.layout.master')
@section('title') Projets @endsection
@section('content')

<div class="card">
    <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="d-flex align-items-center flex-wrap row-gap-3">
                <!-- Filtre par statut -->
                <div class="dropdown me-3">
                    <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                        Sélectionner le statut
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3" id="status-dropdown">
                        <li>
                            <a href="{{ route('admin.projects', ['status' => 'all']) }}" class="dropdown-item rounded-1">Tous les projets</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.projects', ['status' => 'pending']) }}" class="dropdown-item rounded-1">Projets En Attente</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.projects', ['status' => 'in_progress']) }}" class="dropdown-item rounded-1">Projets En Cours</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.projects', ['status' => 'completed']) }}" class="dropdown-item rounded-1">Projets Terminés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.projects', ['status' => 'rejected']) }}" class="dropdown-item rounded-1">Projets Rejetés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.projects', ['status' => 'overdue']) }}" class="dropdown-item rounded-1">Projets En Retard</a>
                        </li>
                    </ul>

                </div>

                <!-- Filtre par période -->
                <div class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                        Trier par : Derniers 7 jours
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3" id="period-dropdown">
                        <li>
                            <a href="{{ route('admin.projects', ['period' => 'recently_added']) }}" class="dropdown-item rounded-1">Récemment ajoutés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.projects', ['period' => 'last_month']) }}" class="dropdown-item rounded-1">Dernier mois</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.projects', ['period' => 'last_7_days']) }}" class="dropdown-item rounded-1">Derniers 7 jours</a>
                        </li>
                    </ul>
                </div>
            </div>
            <h5>
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_project" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Ajouter ou Attribuer</a>
            </h5>
        </div>
    </div>
</div>


<!-- Project Grid -->
<div class="row">
    @if ($projects->count() > 0)
        @foreach ($projects as $project)
            <div class="col-xxl-3 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="pb-3 border-bottom"><a href="{{ route('admin.project.details', ['project' => $project]) }}">{{ Str::limit($project->title, 30, '...') }}</a></h6>
                            <div class="dropdown">
                                {{-- <a href="javascript:void(0);" class="d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end p-3">
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item rounded-1" data-bs-toggle="modal" data-bs-target="#edit_project"><i class="ti ti-edit me-2"></i>Modifier</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item rounded-1" data-bs-toggle="modal" data-bs-target="#delete_modal" ><i class="ti ti-trash me-1"></i>Supprimer</a>
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center file-name-icon">
                                    @if ($project->leader)
                                        <a href="{{ route('admin.expert.details', ['expert' => $project->leader]) }}" class="avatar avatar-sm avatar-rounded flex-shrink-0">
                                            <img src="{{ asset('assets/images/dev.png') }}" class="img-fluid" alt="img">
                                        </a>
                                        <div class="ms-2">
                                            <h6 class="fw-normal fs-12">
                                                <a href="{{ route('admin.expert.details', ['expert' => $project->leader]) }}">
                                                    {{ $project->leader->firstname }} {{ substr($project->leader->lastname, 0, 1) }}.
                                                </a>
                                            </h6>
                                            <span class="fs-12 fw-normal ">Chef Projet</span>
                                        </div>
                                    @else
                                        <span class="fs-12 fw-normal">Projet Non Assigné</span>
                                    @endif
                                </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <span class="fs-12 fw-normal ">Délai</span>
                                    <p class="mb-0 fs-12">{{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <p>
                                    <small>Status: </small>
                                    <span class="avatar avatar-sm avatar-rounded {{ $project->statusLabel['class'] }} flex-shrink-0">
                                        <i class="{{ $project->statusLabel['icon'] }} text-{{ str_replace('badge-', '', $project->statusLabel['class']) }} fs-16"></i>
                                    </span>
                                    <span class="text-dark">{{ $project->statusLabel['text'] }}</span>
                                </p>
                            </div>

                            @if ($project->teams->isNotEmpty())
                                <div class="avatar-list-stacked avatar-group-sm">
                                    @foreach ($project->teams as $team)
                                        <span class="fs-12 fw-normal">{{ $team->name }}</span>
                                    @endforeach
                                </div>
                            @elseif ($project->teams->isEmpty() && $project->leader)
                                <div class="avatar-list-stacked avatar-group-sm">
                                    <span class="fs-12 fw-normal">{{ $project->leader->firstname }} {{ substr($project->leader->lastname, 0, 1) }}.</span>
                                </div>
                            @else
                                <span class="text-muted">Nouveau Projet</span>
                            @endif
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div  class="d-flex align-items-center">
                                <span class="avatar avatar-sm avatar-rounded bg-primary flex-shrink-0 me-2">
                                    <i class="ti ti-user text-white fs-16 fw-bold"></i>
                                </span>
                                <p>
                                    <span>Porteur de projet: </span>
                                    <span class="text-dark">
                                        {{ $project->client ? $project->client->firstname . ' ' . $project->client->lastname : 'Créé par Admin' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @else
        <div class="text-center p-4">
            <img src="{{ asset('assets/images/empty.png') }}" alt="Pas d'équipe" width="150">
            <p class="text-muted mt-3">Aucun projet pour l'instant. C'est le moment idéal pour en lancer de nouveaux!</p>
        </div>
        @endif
</div>
<!-- / Project Grid -->



<!-- Add or Assign Project -->
<div class="modal fade" id="add_project" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header header-border align-items-center justify-content-between">
				<div class="d-flex align-items-center">
					<h5 class="modal-title me-2">Ajouter un projet </h5>
				</div>
				<button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
					<i class="ti ti-x"></i>
				</button>
			</div>
			<div class="add-info-fieldset ">
				<div class="contact-grids-tab p-3 pb-0">
					<ul class="nav nav-underline" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button" role="tab" aria-selected="true">Détails du projet</button>
						  </li>
						  <li class="nav-item" role="presentation">
							<button class="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" type="button" role="tab" aria-selected="false">Attribuer le projet</button>
						  </li>
					</ul>
				</div>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-tab" tabindex="0">
                            <form action="{{ route('admin.project.create') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Nom du Projet</label>
                                                <input type="text" class="form-control" name="title" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <!-- Sélection du client -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="client_id" class="form-label">Associer à un Client (Optionnel)</label>
                                                        <select class="form-select" name="client_id">
                                                            <option value="">Sélectionner</option>
                                                            @foreach ($clients as $client)
                                                                <option value="{{ $client->id }}">{{ $client->firstname }} {{ $client->lastname }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Date limite -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="deadline" class="form-label">Délai</label>
                                                        <input type="date" class="form-control" name="deadline" required>
                                                    </div>
                                                </div>

                                                <!-- Priorité -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="priority" class="form-label">Priorité</label>
                                                        <select class="form-select" name="priority" required>
                                                            <option value="">Sélectionner</option>
                                                            <option value="high">Élevée</option>
                                                            <option value="medium">Moyenne</option>
                                                            <option value="low">Faible</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control summernote" name="description" required></textarea>
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
					<div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab" tabindex="0">
                        <form action="{{ route('admin.project.assign') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="alert alert-info d-flex align-items-center">
                                    <i class="ti ti-info-circle me-2"></i>
                                    <span>NB : Assigner le projet à un expert ou à une équipe !</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="project_id" class="form-label">Projet</label>
                                            <select id="project_id" name="project_id" class="form-control select" required>
                                                <option value="">Sélectionner un projet</option>
                                                @foreach ($notAssignedProjects as $project)
                                                    <option value="{{ $project->id }}">
                                                        {{ $project->title }} |
                                                        {{ $project->client ? $project->client->firstname . ' ' . $project->client->lastname : 'Créé par Admin' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="comment" class="form-label">Commentaire</label>
                                            <textarea class="form-control" id="comment" name="comment" placeholder="Laisser une note sur le projet ..." required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="team_id" class="form-label">Équipe</label>
                                            <select id="team_id" name="team_id" class="form-control select">
                                                <option value="">Sélectionner une équipe</option>
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}">{{ $team->name }} | {{ $team->leader->firstname }} {{ $team->leader->lastname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="expert_id" class="form-label">Expert</label>
                                            <select id="expert_id" name="expert_id" class="form-control select">
                                                <option value="">Sélectionner un expert</option>
                                                @foreach ($experts as $expert)
                                                    <option value="{{ $expert->id }}">{{ $expert->firstname }} {{ $expert->lastname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                                <button class="btn btn-primary" type="submit">Enregistrer</button>
                            </div>
                        </form>
				    </div>
			    </div>
		    </div>
	    </div>
	</div>
</div>
<!-- /Add or Assign Project -->
@endsection
