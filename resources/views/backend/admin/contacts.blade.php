@extends('backend.admin.layout.master')
@section('title') Informations de contact @endsection
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
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_contact" class="btn btn-primary d-flex align-items-center">
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
                        @if($contacts->isEmpty())
                            @include('partials.empty')
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Contact</th>
                                        {{-- <th>QR Code</th> --}}
                                        <th>Ajouté le</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $contact->name ?? 'N/A' }}</td>
                                            <td>{{ $contact->value }}</td>
                                            {{-- <td>
                                                @if($contact->url)
                                                    {!! QrCode::size(40)->generate($contact->url) !!}
                                                @else
                                                    -
                                                @endif
                                            </td> --}}
                                            <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input type="hidden" name="status[{{ $contact->id }}]" value="0">
                                                    <input class="form-check-input me-2" type="checkbox" role="switch"
                                                           name="status[{{ $contact->id }}]" value="1" {{ $contact->status ? 'checked' : '' }}
                                                           id="status-switch-{{ $contact->id }}">
                                                </div>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $contact->id }})">
                                                    <i class="ti ti-trash"></i> Supprimer
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

<!-- Modal d'ajout -->
<div class="modal fade" id="add_contact">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un contact</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.contact.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Type de contact <span class="text-danger">*</span></label>
                            <select name="name" id="name" class="form-control" required onchange="changeInputType()">
                                <option value="">-- Sélectionner --</option>
                                <option value="phone">Téléphone</option>
                                <option value="email">Email</option>
                                <option value="address">Adresse</option>
                                <option value="title">Titre</option>
                                <option value="subtitle">Sous Titre</option>
                                <option value="whatsapp">WhatsApp</option>
                                <option value="image">Image de Bannière</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="value-container">
                            <label for="value" class="form-label">Valeur <span class="text-danger">*</span></label>
                            <input type="text" name="value" id="value" class="form-control" placeholder="...." required>
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

<script>
    function changeInputType() {
        const select = document.getElementById('name');
        const valueContainer = document.getElementById('value-container');

        // Supprimer l'ancien input
        valueContainer.innerHTML = '';

        // Ajouter label
        const label = document.createElement('label');
        label.setAttribute('for', 'value');
        label.classList.add('form-label');
        label.innerHTML = 'Valeur <span class="text-danger">*</span>';
        valueContainer.appendChild(label);

        // Créer nouvel input selon sélection
        let input;
        if (select.value === 'image') {
            input = document.createElement('input');
            input.type = 'file';
        } else {
            input = document.createElement('input');
            input.type = 'text';
            input.placeholder = '....';
        }
        input.name = 'value';
        input.id = 'value';
        input.className = 'form-control';
        input.required = true;

        valueContainer.appendChild(input);
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
                    <form id="deleteForm" action="{{ route('admin.contact.delete', ':id') }}" method="POST" style="display: inline;">
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
            var contactId = this.name.match(/\[(\d+)\]/)[1];
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/zpanel/contact/status-update/${contactId}`, {
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
    function setDeleteLink(contactId) {
        var formAction = document.getElementById('deleteForm');
        formAction.action = formAction.action.replace(':id', contactId);
    }
</script>

<script>
    function showMessage(message, type) {
        toastr[type](message);
    }
</script>
@endsection
