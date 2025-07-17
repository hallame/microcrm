<!-- Add Client -->
<div class="modal fade" id="add_client">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un nouveau client</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.client.create') }}" method="POST">
                @csrf
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Prénom <span class="text-danger">*</span></label>
                                        <input type="text" id="firstname" name="firstname" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Nom <span class="text-danger">*</span></label>
                                        <input type="text" id="lastname" name="lastname" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                        <div class="pass-group">
                                            <input type="password" id="password" name="password" class="pass-input form-control" required>
                                            <span class="ti toggle-password ti-eye-off"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                                        <div class="pass-group">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="pass-inputs form-control" required>
                                            <span class="ti toggle-passwords ti-eye-off"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Numéro de téléphone <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" id="phone" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Pays de résidence</label>
                                        <input type="text" name="country" id="country" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">Ville</label>
                                        <input type="text" name="city" id="city" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Adresse</label>
                                        <input type="text" name="address" id="address" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="company" class="form-label">Entreprise</label>
                                        <input type="text" name="company" id="company" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Rôle dans l'Entreprise</label>
                                        <input type="text" name="position" id="position" class="form-control">
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
<!-- /Add Client -->

<!-- Add Partner -->
<div class="modal fade" id="add_partner">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un nouveau partenaire</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.partner.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company" class="form-label">Entreprise <span class="text-danger">*</span></label>
                                        <input type="text" name="company" id="company" class="form-control" required placeholder="Entrez le nom de l'entreprise">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Adresse Complète<span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="address" class="form-control" required placeholder="Entrez l'adresse Complète">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control" required placeholder="Entrez l'email de l'entreprise">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Numéro de téléphone <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" id="phone" class="form-control" required placeholder="Entrez le numéro de téléphone">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="logo" class="form-label">Logo de l'entreprise  <span class="text-danger">*</span></label>
                                        <input type="file" name="logo" id="logo" class="form-control" accept="image/*" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                     <div class="mb-3">
                                        <label for="website" class="form-label">Site web de l'entreprise</label>
                                        <input type="url" name="website" id="website" class="form-control" placeholder="Entrez l’URL du site web">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact" class="form-label">Contact</label>
                                        <textarea name="contact" id="contact" cols="30" rows="2" class="form-control" placeholder="Précisez la personne à contacter"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="2" class="form-control" placeholder="Entrez une brève description"></textarea>
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
<!-- /Add Partner -->

<!-- Add Country -->
<div class="modal fade" id="add_country">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un pays</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.country.add') }}" method="POST">
                @csrf
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom du pays <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Ex : Bénin" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="iso_code" class="form-label">Code ISO <span class="text-danger">*</span></label>
                                        <input type="text" id="iso_code" name="iso_code" maxlength="3" class="form-control" placeholder="Ex : BJ" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="country_code" class="form-label">Indicatif Pays <span class="text-danger">*</span></label>
                                        <input type="tel" id="country_code" name="country_code" maxlength="5" class="form-control" placeholder="Ex : +229" required>
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
<!-- /Add Country -->

<!-- Add category -->
<div class="modal fade" id="add_category">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une Catégorie</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.category.add') }}" method="POST">
                @csrf
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom de la Catégorie <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Ex : Moyenne Guinée" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                        <input type="text" id="description" name="description" class="form-control" placeholder="Ex : description....." required>
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
<!-- /Add category -->

<!-- Add Location -->
<div class="modal fade" id="add_location">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un emplacement</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.location.add') }}" method="POST">
                @csrf
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom de l'emplacement <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Entrez le nom de l'emplacement" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Adresse <span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Entrez l'adresse" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Numéro de téléphone <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="phone" class="form-control" required placeholder="Entrez le numéro de téléphone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control" required placeholder="Entrez l'email">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="map_link" class="form-label">Lien Google Maps</label>
                                        <input type="text" name="map_link" id="map_link" class="form-control" placeholder="Entrez le lien Google Maps">
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="details" class="form-label">Détails supplémentaires <span class="text-danger">*</span></label>
                                        <textarea name="details" id="details" rows="3" class="form-control" placeholder="Ajoutez des informations supplémentaires"></textarea>
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
<!-- /Add Location -->





