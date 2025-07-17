@extends('backend.admin.layout.master')
@section('title') Gestion des Pages @endsection
@section('content')


<div class="row">
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-pink-transparent border border-pink d-flex align-items-center justify-content-center">
                                <i class="ti ti-world text-pink fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Total Pages</p>
                            <h4>{{ $total }}</h4>
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
                                <i class="ti ti-checkbox  fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Actives</p>
                            <h4>{{ $active }}</h4>
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
                            <span class="p-2 br-10 bg-danger border border-pink d-flex align-items-center justify-content-center">
                                <i class="ti ti-x fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Inactives</p>
                            <h4>{{ $inactive }}</h4>
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
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary"><i class="ti ti-circle-arrow-up me-1"></i>Tableau de board</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="d-flex align-items-center flex-wrap row-gap-3">
                <!-- Filtre par statut -->
                <div class="dropdown me-3">
                    <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                        Sélectionner
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3" id="status-dropdown">
                        <li>
                            <a href="{{ route('admin.pages', ['status' => 'all']) }}" class="dropdown-item rounded-1">Tout</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.pages', ['status' => 'active']) }}" class="dropdown-item rounded-1">Actives</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.pages', ['status' => 'inactive']) }}" class="dropdown-item rounded-1">Inactives</a>
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
                            <a href="{{ route('admin.pages', ['period' => 'recently_added']) }}" class="dropdown-item rounded-1">Récemment ajoutés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.pages', ['period' => 'last_month']) }}" class="dropdown-item rounded-1">Dernier mois</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.pages', ['period' => 'last_7_days']) }}" class="dropdown-item rounded-1">Derniers 7 jours</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_page" class="btn btn-primary d-flex align-items-center text-center"><i class="ti ti-circle-plus me-2"></i>Ajouter une page</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div>
                    @if($pages->isEmpty())
                        @include('partials.empty')
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre Page</th>
                                <th>Sous titre</th>
                                {{-- <th>Type</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $page->title ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($page->subtitle, 40) ?? 'N/A' }}</td>

                                    {{-- <td>{{ $page->type ?? 'N/A' }}</td> --}}
                                    <td>
                                       @if (!in_array($page->type, ['about', 'community', 'home']))
                                            <div class="form-check form-switch">
                                                <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                                <input type="hidden" name="status[{{ $page->id }}]" value="0">
                                                <!-- Case à cocher avec la valeur '1' si cochée -->
                                                <input class="form-check-input me-2" type="checkbox" role="switch"
                                                    name="status[{{ $page->id }}]" value="1" {{ $page->status ? 'checked' : '' }}
                                                    id="status-switch-{{ $page->id }}">
                                            </div>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $page->id }})">
                                                <i class="ti ti-trash"></i>
                                            </a>

                                        @endif
                                        <a href="{{ route('admin.page.edit', $page->id) }}" class="btn btn-sm btn-secondary" title="Modifier">
                                            <i class="ti ti-edit"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add page -->
<div class="modal fade" id="add_page">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nouvelle Page</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
             <form action="{{ route('admin.page.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">

                        {{-- Titre de la page --}}
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Ex : À propos de nous" required>
                        </div>

                        {{-- Sous-titre --}}
                        <div class="col-md-6 mb-3">
                            <label for="subtitle" class="form-label">Sous-titre</label>
                            <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Ex : Bienvenue sur notre site">
                        </div>

                        {{-- Meta Title --}}
                        <div class="col-md-6 mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Meta Title pour SEO">
                        </div>

                        {{-- Meta Description --}}
                        <div class="col-md-6 mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <input type="text" name="meta_description" id="meta_description" class="form-control" placeholder="Description pour SEO">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" placeholder="Ex: tourisme, culture, Guinée">
                            <small class="form-text text-info">Tapez un mot-clé et appuyez sur Entrée ou une virgule.</small>
                        </div>


                        {{-- Langue --}}
                        <div class="col-md-3 mb-3">
                            <label for="language_id" class="form-label">Langue <span class="text-danger">*</span></label>
                            <select name="language_id" id="language_id" class="form-control" required>
                                @foreach($languages as $lang)
                                    <option value="{{ $lang->id }}" {{ $lang->id == 1 ? 'selected' : '' }}>{{ $lang->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Type --}}
                        <div class="col-md-3 mb-3">
                            <label for="type" class="form-label">Type de page <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="" disabled>Selectionner</option>
                                <option value="people">Communautés: Peuples</option>
                                <option value="merveille">Merveilles de Guinée</option>
                                {{-- <option value="women">Femmes et Culture</option> --}}
                                <option value="other">Autre</option>
                            </select>
                        </div>

                        {{-- Image --}}
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <img id="previewImage" style="max-width: 100px; display: none;" />

                        </div>

                        {{-- Bannière --}}
                        <div class="col-md-6 mb-3">
                            <label for="banner" class="form-label">Bannière</label>
                            <input type="file" name="banner" id="banner" class="form-control" accept="image/*">
                            {{-- <img id="previewImage" style="max-width: 100px; display: none;" /> --}}
                        </div>

                        {{-- Vidéo --}}
                        <div class="col-md-6 mb-3">
                            <label for="video_url" class="form-label">URL de la vidéo (optionnelle)</label>
                            <input type="url" name="video_url" id="video_url" class="form-control" placeholder="Ex : https://www.youtube.com/...">
                        </div>

                        {{-- Vidéo téléchargée --}}
                        <div class="col-md-6 mb-3">
                            <label for="video" class="form-label">Vidéo (optionnelle)</label>
                            <input type="file" name="video" id="video" class="form-control" accept="video/*">
                        </div>


                        <div class="col-md-12 mb-3">
                            <label for="info" class="form-label">Citation </label>
                            <textarea name="info" id="info" class="form-control" rows="2" placeholder="**********"></textarea>
                        </div>
                        {{-- Contenu --}}
                        <div class="col-md-12 mb-3">
                            <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                            <textarea name="content" id="omizixEditor" class="form-control" rows="5" placeholder="Contenu de la page..." required></textarea>
                        </div>


                        {{-- Bouton de soumission --}}
                        <div class="col-md-12 text-end mb-3">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add page -->

<!-- Modal pour confirmation de suppression -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirmer la suppression</h4>
                <p class="mb-3 text-danger">
                    Attention : En confirmant la suppression, toutes les informations associées seront définitivement perdues.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Annuler</a>

                    <!-- Formulaire de suppression dynamique -->
                    <form id="deleteForm" action="{{ route('admin.page.delete', ':id') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var pageId = this.name.match(/\[(\d+)\]/)[1];
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/zpanel/page/status-update/${pageId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success('Statut mis à jour avec succès !');
                } else {
                    toastr.error('Échec de la mise à jour du statut.');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                toastr.error('Erreur lors de la mise à jour du statut.');
            });

        });
    });
</script>

<script>
    function setDeleteLink(pageId) {
        var formAction = document.getElementById('deleteForm');
        formAction.action = formAction.action.replace(':id', pageId);
    }
</script>

<script>
    function showMessage(message, type) {
        toastr[type](message);
    }
</script>
@endsection
