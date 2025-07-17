@extends('backend.admin.layout.master')
@section('title') Réseaux Sociaux @endsection
@section('content')


    <div class="row">
        <!-- Total réseaux sociaux -->
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <span class="p-2 br-10 bg-primary-transparent border border-primary d-flex align-items-center justify-content-center">
                                    <i class="ti ti-world text-primary fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Total</p>
                                <h4>{{ $total }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Réseaux activés -->
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <span class="p-2 br-10 bg-success-transparent border border-success d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle-check text-success fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Activés</p>
                                <h4>{{ $active }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Réseaux désactivés -->
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <span class="p-2 br-10 bg-danger-transparent border border-danger d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle-x text-danger fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Désactivés</p>
                                <h4>{{ $inactive }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bouton d'ajout -->
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_social" class="btn btn-primary d-flex align-items-center">
                                <i class="ti ti-circle-plus me-2"></i>Ajouter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div>
                        @if($socials->isEmpty())
                            @include('partials.empty')
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Réseau</th>
                                        <th>Lien</th>
                                        <th>QR Code</th>
                                        <th>Ajouté le</th>
                                        {{-- <th>Statut</th> --}}
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($socials as $social)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $social->name ?? 'N/A' }}</td>
                                            <td>
                                                @if($social->name == 'text')
                                                    {{ Str::limit($social->url, 50) }}
                                                @else
                                                    <a href="{{ $social->url }}" target="_blank">{{ Str::limit($social->url, 50) }}</a>
                                                @endif
                                            </td>

                                            <td>
                                                @if($social->name != 'text')
                                                    {!! QrCode::size(40)->generate($social->url) !!}
                                                @endif
                                            </td>

                                            <td>{{ \Carbon\Carbon::parse($social->created_at)->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                                    <input type="hidden" name="status[{{ $social->id }}]" value="0">
                                                    <!-- Case à cocher avec la valeur '1' si cochée -->
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="status[{{ $social->id }}]" value="1" {{ $social->status ? 'checked' : '' }}
                                                        id="status-switch-{{ $social->id }}">
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $social->id }})">
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                                </div>

                                                {{-- <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $social->id }})">
                                                    <i class="ti ti-trash"></i>
                                                </a> --}}
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

<!-- Modal d'ajout -->
<div class="modal fade" id="add_social">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un réseau social</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.social.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nom du réseau social <span class="text-danger">*</span></label>
                            <select name="name" id="name" class="form-control" required onchange="updateInputType()">
                                <option value="">-- Sélectionner --</option>
                                <option value="facebook">Facebook</option>
                                <option value="twitter">Twitter</option>
                                <option value="tiktok">TikTok</option>
                                <option value="instagram">Instagram</option>
                                <option value="youtube">YouTube</option>
                                <option value="linkedin">LinkedIn</option>
                                <option value="text">Texte Footer</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="url" class="form-label">Lien <span class="text-danger">*</span></label>
                            <input type="url" name="url" id="url" class="form-control" placeholder="https://facebook.com/..." required>
                        </div>

                        <div class="col-md-12 text-end mt-4 mb-4">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </form>



        </div>
    </div>
</div>
 <!-- Petit script juste en bas -->
 <script>
    function updateInputType() {
        var select = document.getElementById('name');
        var input = document.getElementById('url');

        if (select.value === 'text') {
            input.type = 'text';
            input.placeholder = 'Entrez votre texte ici...';
        } else {
            input.type = 'url';
            input.placeholder = 'https://facebook.com/...';
        }
    }
</script>

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
                    <form id="deleteForm" action="{{ route('admin.social.delete', ':id') }}" method="POST" style="display: inline;">
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
            var socialId = this.name.match(/\[(\d+)\]/)[1];
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/zpanel/social/status-update/${socialId}`, {
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
    function setDeleteLink(socialId) {
        var formAction = document.getElementById('deleteForm');
        formAction.action = formAction.action.replace(':id', socialId);
    }
</script>

<script>
    function showMessage(message, type) {
        toastr[type](message);
    }
</script>
@endsection
