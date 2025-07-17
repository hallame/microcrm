@extends('backend.admin.layout.master')
@section('title') Ajouter un expert @endsection
@section('content')
<!-- Breadcrumb -->
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1">Ajouter un membre</h2>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="{{ route('admin.experts') }}" class="d-flex align-items-center"><i class="ti ti-arrow-left me-2"></i>Retour</a>
        </div>
        <div class="ms-2 head-icons">
            <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Réduire" id="collapse-header">
                <i class="ti ti-chevrons-up"></i>
            </a>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Add Expert -->

<div>
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
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                                <div class="pass-group">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="pass-inputs form-control" placeholder="Répétez le mot de passe">
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
                                <input type="tel" id="phone" name="phone" class="form-control" pattern="\+[0-9]{8,}" placeholder="Ex: +229 0112345678">
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
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Add Expert -->
@endsection
