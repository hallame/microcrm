@extends('backend.admin.layout.master')
@section('title') Mon Profil @endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="border-bottom mb-3 pb-3">
                <h4>Mon Profil</h4>
            </div>
            <form action="{{ route('admin.myprofile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="border-bottom mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <h6 class="mb-3">Informations générales</h6>
                                <div class="d-flex align-items-center flex-wrap row-gap-3 bg-light w-100 rounded p-3 mb-4">
                                    {{-- <div class="d-flex align-items-center justify-content-center avatar avatar-xxl rounded-circle border border-dashed me-2 flex-shrink-0 text-dark frames">
                                        <i class="ti ti-photo text-gray-3 fs-16"></i>
                                    </div> --}}
                                    {{-- <div class="mb-2">
                                        <h6 class="mb-1">Photo Profil</h6>
                                        <p class="fs-12">Taille recommandée: 40x40</p>
                                    </div> --}}
                                    <div class="d-flex align-items-center">
                                        <div class="btn btn-sm btn-primary me-2">
                                            Photo Profil
                                            <input type="file" class="form-control" name="profile_picture">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label mb-md-0">Prénom</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="firstname" value="{{ $admin->firstname }}" placeholder="Entrez votre prénom">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label mb-md-0">Nom</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="lastname" value="{{ $admin->lastname }}" placeholder="Entrez votre nom">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label mb-md-0">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" name="email" value="{{ $admin->email }}" placeholder="Entrez votre email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label mb-md-0">Téléphone</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="phone" value="{{ $admin->phone }}" placeholder="Entrez votre numéro de téléphone">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom mb-3">
                    <h6 class="mb-3">Informations Complémentaires</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label mb-md-0">Adresse</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="address" value="{{ $admin->address }}" placeholder="Entrez votre adresse">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label mb-md-0">Pays</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="country" value="{{ $admin->country }}" placeholder="Entrez votre pays">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label mb-md-0">Ville</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="city" value="{{ $admin->city }}" placeholder="Entrez votre ville">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <label class="form-label mb-md-0">Code Postal</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="postal_code" value="{{ $admin->postal_code }}" placeholder="Entrez votre code postal">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom mb-3">
                    <h6 class="mb-3">Changer le mot de passe</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-6">
                                    <label class="form-label mb-md-0">Mot de passe actuel</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="pass-group">
                                        <input type="password" class="pass-input form-control" name="current_password" placeholder="Entrez votre mot de passe actuel">
                                        <span class="ti toggle-password ti-eye-off"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-6">
                                    <label for="new_password" class="form-label mb-md-0">Nouveau mot de passe</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="pass-group">
                                        <input type="password" class="pass-input form-control" id="new_password" name="new_password" placeholder="Entrez un nouveau mot de passe">
                                        <span class="ti toggle-password ti-eye-off"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row align-items-center mb-3">
                                <div class="col-md-6">
                                    <label class="form-label mb-md-0">Confirmer le mot de passe</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="pass-group">
                                        <input type="password" class="pass-input form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirmez votre nouveau mot de passe">
                                        <span class="ti toggle-password ti-eye-off"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    {{-- <button type="button" class="btn btn-outline-light border me-3">Annuler</button> --}}
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
@endsection
