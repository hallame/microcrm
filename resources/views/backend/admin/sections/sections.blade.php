@extends('backend.admin.layout.master')
@section('title') Gestion des Sections @endsection
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Total Sections</p>
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
                            <a href="{{ route('admin.sections', ['status' => 'all']) }}" class="dropdown-item rounded-1">Tout</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sections', ['status' => 'active']) }}" class="dropdown-item rounded-1">Actives</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sections', ['status' => 'inactive']) }}" class="dropdown-item rounded-1">Inactives</a>
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
                            <a href="{{ route('admin.sections', ['period' => 'recently_added']) }}" class="dropdown-item rounded-1">Récemment ajoutées</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sections', ['period' => 'last_month']) }}" class="dropdown-item rounded-1">Dernier mois</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sections', ['period' => 'last_7_days']) }}" class="dropdown-item rounded-1">Derniers 7 jours</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_section" class="btn btn-primary d-flex align-items-center text-center"><i class="ti ti-circle-plus me-2"></i>Nouvelle section</a>
                {{-- <a href="{{ route('admin.pages') }}" class="btn btn-primary"><i class="ti ti-book me-1"></i>Toutes les pages</a> --}}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div>
                    @if($sections->isEmpty())
                        @include('partials.empty')
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Section</th>
                                {{-- <th>Type</th> --}}
                                <th>Page</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $section->title ?? 'N/A' }}</td>
                                    {{-- <td>{{ $section->type ?? 'N/A' }}</td> --}}
                                    <td>{{ $section->page ?? 'N/A' }}</td>
                                    <td>
                                        @if ($section->page != 'home')
                                            <div class="form-check form-switch">
                                                <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                                <input type="hidden" name="status[{{ $section->id }}]" value="0">
                                                <!-- Case à cocher avec la valeur '1' si cochée -->
                                                <input class="form-check-input me-2" type="checkbox" role="switch"
                                                    name="status[{{ $section->id }}]" value="1" {{ $section->status ? 'checked' : '' }}
                                                    id="status-switch-{{ $section->id }}">
                                            </div>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $section->id }})">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.section.edit', $section->id) }}" class="btn btn-sm btn-secondary" title="Modifier">
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

<!-- Add section -->
<div class="modal fade" id="add_section">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nouvelle section</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.section.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        {{-- Titre --}}
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" required placeholder="Ex : À propos de la Guinée Forestière">
                        </div>

                        {{-- Sous-titre --}}
                        <div class="col-md-6 mb-3">
                            <label for="subtitle" class="form-label">Sous-titre</label>
                            <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Ex : Découvrez nos merveilles naturelles">
                        </div>

                        {{-- Type --}}
                        <div class="col-md-3 mb-3">
                            <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="" disabled>Selectionner</option>
                                <option value="home">Page d'accueil</option>
                                <option value="women">Femmes et Culture</option>
                            </select>
                        </div>

                        {{-- Langue --}}
                        <div class="col-md-6 mb-3">
                            <label for="language_id" class="form-label">Langue</label>
                            <select name="language_id" id="language_id" class="form-control" required>
                                @foreach($languages as $lang)
                                    <option value="{{ $lang->id }}" {{ $lang->id == 1 ? 'selected' : '' }}>{{ $lang->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Contenu --}}
                        <div class="col-md-12 mb-3">
                            <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                            <textarea name="content" id="omizixEditor" class="form-control" rows="5" required placeholder="Entrez le texte détaillé pour cette section..."></textarea>
                        </div>

                        {{-- Texte du bouton --}}
                        <div class="col-md-6 mb-3">
                            <label for="btn_text" class="form-label">Texte du bouton</label>
                            <input type="text" name="btn_text" id="btn_text" class="form-control" placeholder="Ex : En savoir plus">
                        </div>

                        {{-- Lien du bouton --}}
                        <div class="col-md-6 mb-3">
                            <label for="btn_link" class="form-label">Lien du bouton</label>
                            <input type="url" name="btn_link" id="btn_link" class="form-control" placeholder="Ex : https://zalymerveille.com/....">
                        </div>

                        {{-- Image --}}
                        <div class="col-md-4 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>

                        {{-- Vidéo (upload) --}}
                        {{-- <div class="col-md-4 mb-3">
                            <label for="video" class="form-label">Vidéo (upload)</label>
                            <input type="file" name="video" id="video" class="form-control" accept="video/*">
                        </div> --}}

                        {{-- URL de la vidéo --}}
                        {{-- <div class="col-md-4 mb-3">
                            <label for="video_url" class="form-label">URL de la vidéo</label>
                            <input type="url" name="video_url" id="video_url" class="form-control" placeholder="Ex : https://youtube.com/...">
                        </div> --}}

                        {{-- Submit --}}
                        <div class="col-md-12 text-end mb-3">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add section -->

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
                    <form id="deleteForm" action="{{ route('admin.section.delete', ':id') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    document.getElementById("image").addEventListener("change", function(e) {
        const [file] = e.target.files;
        if (file) {
            document.getElementById("previewImage").src = URL.createObjectURL(file);
            document.getElementById("previewImage").style.display = "block";
        }
    });
</script> --}}

<script>
    document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var sectionId = this.name.match(/\[(\d+)\]/)[1];
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/zpanel/section/status-update/${sectionId}`, {
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
    function setDeleteLink(sectionId) {
        var formAction = document.getElementById('deleteForm');
        formAction.action = formAction.action.replace(':id', sectionId);
    }
</script>

<script>
    function showMessage(message, type) {
        toastr[type](message);
    }
</script>
@endsection
