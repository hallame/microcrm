@extends('backend.admin.layout.master')
@section('title') Attribuer un Projet @endsection
@section('content')
<!-- Breadcrumb -->
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1">Attribuer un Projet</h2>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="#" data-bs-toggle="modal" data-bs-target="#add_project" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Ajouter un projet</a>
        </div>
        <div class="ms-2 head-icons">
            <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                <i class="ti ti-chevrons-up"></i>
            </a>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Assign Project -->
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
                    <textarea class="form-control" id="comment" placeholder="Laisser une note sur le projet ..." name="comment" required></textarea>
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
        <button class="btn btn-primary" type="submit">Enregistrer</button>
    </div>
</form>
<!-- Assign Project -->



<!-- Add Project -->
<div class="modal fade" id="add_project" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header header-border align-items-center justify-content-between">
				<div class="d-flex align-items-center">
					<h5 class="modal-title me-2">Ajouter un nouveau projet </h5>
				</div>
				<button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
					<i class="ti ti-x"></i>
				</button>
			</div>
			<div class="add-info-fieldset ">
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
                </div>
		    </div>
	    </div>
	</div>
</div>
<!-- Add Project -->

@endsection
