@extends('backend.admin.layout.master')
@section('title') Professionnels @endsection
@section('content')


    <div class="row">
        <!-- Total Plans -->
        <div class="col-lg-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center overflow-hidden">
                        <div>
                            <span class="avatar avatar-lg bg-dark rounded-circle"><i class="ti ti-users"></i></span>
                        </div>
                        <div class="ms-2 overflow-hidden">
                            <p class="fs-12 fw-medium mb-1 text-truncate">Total des Experts</p>
                            <h4>{{ $totalExperts }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Total Plans -->

        <!-- Total Plans -->
        <div class="col-lg-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center overflow-hidden">
                        <div>
                            <span class="avatar avatar-lg bg-success rounded-circle"><i class="ti ti-user-share"></i></span>
                        </div>
                        <div class="ms-2 overflow-hidden">
                            <p class="fs-12 fw-medium mb-1 text-truncate">Experts Actifs</p>
                            <h4>{{ $activeExperts }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Total Plans -->

        <!-- Inactive Plans -->
        <div class="col-lg-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center overflow-hidden">
                        <div>
                            <span class="avatar avatar-lg bg-danger rounded-circle"><i class="ti ti-user-pause"></i></span>
                        </div>
                        <div class="ms-2 overflow-hidden">
                            <p class="fs-12 fw-medium mb-1 text-truncate">Experts Inactifs</p>
                            <h4>{{ $inactiveExperts }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Inactive Companies -->

        <!-- No of Plans  -->
        <div class="col-lg-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center overflow-hidden">
                        {{-- <div>
                            <span class="avatar avatar-lg bg-info rounded-circle"><i class="ti ti-user-plus"></i></span>
                        </div> --}}
                        <div class="ms-2 overflow-hidden">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_employee" class="btn btn-primary d-flex align-items-center text-center"><i class="ti ti-circle-plus me-2"></i>Ajouter un expert</a>
                            {{-- <p class="fs-12 fw-medium mb-1 text-truncate">Nouveaux Inscrits</p>
                            <h4>{{ $latestExperts }}</h4> --}}
                        </div>
                        {{-- <span class="badge badge-soft-secondary badge-sm fw-normal">
                            <i class="ti {{ $growthRate >= 0 ? 'ti-arrow-wave-right-up' : 'ti-arrow-wave-right-down' }}"></i>
                            {{ $growthRate >= 0 ? '+' : '' }}{{ $growthRate }}%
                        </span> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /No of Plans -->
    </div>
    <!-- Breadcrumb -->
    {{-- <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Tous les experts</h2>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
            <div class="mb-2">
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_employee" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Ajouter un expert</a>
            </div>
            <div class="head-icons ms-2">
                <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Réduire" id="collapse-header">
                    <i class="ti ti-chevrons-up"></i>
                </a>
            </div>
        </div>
    </div> --}}
    <!-- /Breadcrumb -->

    <!-- Clients Grid -->
    @if ($experts->count() > 0)
        <div class="row">
            @foreach ($experts as $expert)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="form-check form-check-md">
                                    {{-- <input class="form-check-input" type="checkbox"> --}}
                                </div>
                                <div>
                                    <a href="{{ route('admin.expert.details', ['expert' => $expert]) }}" class="avatar avatar-xl avatar-rounded online border p-1 {{ strtolower($expert->level) === 'junior' ? 'border-secondary' : 'border-primary' }} rounded-circle">
                                        <img src="{{ asset(strtolower($expert->level) === 'junior' ? '/assets/images/dev.png' : '/assets/images/senior.png') }}" class="img-fluid h-auto w-auto" alt="img">
                                    </a>
                                </div>
                                <div class="dropdown">
                                    {{-- <button class="btn btn-icon btn-sm rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end p-3">
                                        <li>
                                            <a class="dropdown-item rounded-1" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit_employee">
                                                <i class="ti ti-edit me-1"></i>Editer
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item rounded-1" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Supprimer</a>
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <h6 class="mb-1"><a href="{{ route('admin.expert.details', ['expert' => $expert]) }}">
                                    {{ $expert->firstname }} {{ $expert->lastname }}</a>
                                </h6>
                                <span class="badge {{ strtolower($expert->level) === 'junior' ? 'badge-secondary-transparent' : 'bg-pink-transparent' }} fs-10 fw-medium">{{ $expert->profession }}</span>
                            </div>
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <h6 class="fw-medium">{{ $expert->projects_count += $expert->team_projects_count }}</h6>
                                        <span class="fs-10">Projets</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <h6 class="fw-medium">{{ $expert->teams_count }}</h6>
                                        <span class="fs-10">Équipes</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <h6 class="fw-medium">{{ $expert->articles_count }}</h6>
                                        <span class="fs-10">Articles</span>
                                    </div>
                                </div>
                            </div>
                            <p class="mb-2 text-center">Productivité :
                                <span class="{{ strtolower($expert->level) === 'junior' ? 'text-info' : 'text-purple' }}">
                                    {{ $expert->productivity }}%</span>
                            </p>
                            <div class="progress progress-xs mb-2">
                                <div class="progress-bar {{ strtolower($expert->level) === 'junior' ? 'bg-info' : 'bg-purple' }}" role="progressbar" style="width: {{ $expert->productivity }}%"></div>
                            </div>
                            {{-- <div class="d-flex align-items-center justify-content-between border-top pt-3 mt-3">
                                <div>
                                    <p class="mb-1 fs-12">Company</p>
                                    <h6 class="fw-normal text-truncate">Stellar Dynamics</h6>
                                </div>
                                <div class="icons-social d-flex align-items-center">
                                    <a href="#" class="avatar avatar-rounded avatar-sm bg-light me-2"><i class="ti ti-message"></i></a>
                                    <a href="#" class="avatar avatar-rounded avatar-sm bg-light"><i class="ti ti-phone"></i></a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center p-4">
            <img src="{{ asset('assets/images/empty.png') }}" alt="Aucun Expert" width="150">
            <p class="text-muted mt-3">Aucun expert inscrit pour l'instant.</p>
        </div>
    @endif
    <!-- /Clients Grid -->



    <!-- Add Expert -->
<div class="modal fade" id="add_employee">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <h4 class="modal-title me-2">Ajouter un nouveau expert</h4>
                </div>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.expert.add') }}" method="POST">
                @csrf
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Prénom <span class="text-danger">*</span></label>
                                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Entrez le prénom">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Nom <span class="text-danger">*</span></label>
                                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Entrez le nom">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Nom d'utilisateur</label>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Choisissez un nom d'utilisateur">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre adresse email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                        <div class="pass-group">
                                            <input type="password" id="password" name="password" class="pass-input form-control" placeholder="Choisissez un mot de passe">
                                            <span class="ti toggle-password ti-eye-off"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                                        <div class="pass-group">
                                            <input type="password" id="confirm_password" name="confirm_password" class="pass-inputs form-control" placeholder="Répétez le mot de passe">
                                            <span class="ti toggle-passwords ti-eye-off"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Pays de résidence <span class="text-danger">*</span></label>
                                        <select name="country" id="country" class="select">
                                            <option value="">Sélectionnez un pays</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->code }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="level" class="form-label">Niveau</label>
                                        <select name="level" id="level" class="select">
                                            <option value="" disabled selected>Sélectionner</option>
                                            <option value="junior">Junior</option>
                                            <option value="senior">Senior</option>
                                            <option value="expert">Expert</option>
                                            <option value="other">Autre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Genre <span class="text-danger">*</span></label>
                                        <select name="gender" id="gender" class="select">
                                            <option value="" disabled selected>Sélectionner</option>
                                            <option value="male">Homme</option>
                                            <option value="female">Femme</option>
                                            <option value="other">Autre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
                                        <input type="text" id="profession" name="profession" class="form-control" placeholder="Entrez votre profession">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Numéro de téléphone <span class="text-danger">*</span></label>
                                        <input type="tel" id="phone" name="phone" class="form-control" value="+229" pattern="\+[0-9]{8,}" placeholder="Ex: +229 0112345678">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="bio" class="form-label">Présentation </label>
                                        <textarea id="bio" name="bio" class="form-control summernote" required placeholder="Présentation de l'expert en quelques mots ..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-light border me-2" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add Expert -->
@endsection
