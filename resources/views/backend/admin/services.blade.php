@extends('backend.admin.layout.master')
@section('title') Domaines d'activité @endsection
@section('content')

<div class="row">
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-info-transparent border border-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-world text-info fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Domaines</p>
                            <h4>{{ $totalServices }}</h4>
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
                                <i class="ti ti-circle-check fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Activés</p>
                            <h4>{{ $totalActive }}</h4>
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
                            <span class="p-2 br-10 bg-danger-transparent border border-danger d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle-x fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Désactivés</p>
                            <h4>{{ $totalInactive }}</h4>
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
                    <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_service" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Nouveau service</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($services->count() > 0)
    <div class="card">
        <div class="card-body p-0">
            <div class="custom-datatable-filter table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Services</th>
                            <th>Description</th>
                            <th>Pour les</th>
                            <th>Domaines</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $index => $service)
                            <tr class=" border-5 " >
                                <td>{{ $index + 1 }}</td>
                                <td style="max-width: 150px; word-wrap: break-word; white-space: normal; font-weight: bold; color:black">{{ $service->name }}</td>
                                <td style="max-width: 400px; word-wrap: break-word; white-space: normal;">{{ $service->description }}</td>
                                <td style="max-width: 150px; word-wrap: break-word; white-space: normal;" >{{ $service->type }}</td>
                                <td style="max-width: 300px; word-wrap: break-word; white-space: normal;">
                                    @if ($service->domains->isEmpty())
                                        <span><i class="ti ti-circle-x"></i> Pas de domaine associé</span>
                                    @else
                                        @foreach ($service->domains as $domain)
                                            <span><i class="ti ti-layout-grid"></i> {{ $domain->name }}</span> <br>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                        <input type="hidden" name="status[{{ $service->id }}]" value="0">
                                        <!-- Case à cocher avec la valeur '1' si cochée -->
                                        <input class="form-check-input me-2" type="checkbox" role="switch"
                                            name="status[{{ $service->id }}]" value="1" {{ $service->status ? 'checked' : '' }}
                                            id="status-switch-{{ $service->id }}">
                                        <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $service->id }})">
                                            <i class="ti ti-trash fs-20 text-danger"></i> <!-- Icône de suppression -->
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@else
    <div class="text-center p-4">
        <img src="{{ asset('assets/images/empty.png') }}" alt="Aucun client" width="150">
        <p class="text-muted mt-3">Aucun client pour l'instant.</p>
    </div>
@endif

<!-- Modal pour confirmation de suppression -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirmer la suppression</h4>
                <p class="mb-3">Vous voulez supprimer ce service, cela est irréversible.</p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Annuler</a>

                    <!-- Formulaire de suppression dynamique -->
                    <form id="deleteForm" action="{{ route('admin.service.delete', ':id') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_service">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un service</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.service.add') }}" method="POST">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <!-- Nom du service -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du Service <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Entrer le nom du service" required>
                            </div>
                        </div>

                        <!-- Type de service -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Type de Service <span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="Experts">Experts</option>
                                    <option value="Commanditaires">Commanditaires</option>
                                </select>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                                <textarea name="description" id="description" required placeholder="Entrer la description du service" class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Domaines liés -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="domains" class="form-label">Domaines associés <span class="text-danger">*</span></label>
                                <select name="domains[]" id="domains" class="form-select select2" multiple required>
                                    @foreach ($domains as $domain)
                                        <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light border me-2" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>

    function setDeleteLink(serviceId) {
        // Dynamiser l'URL de suppression avec l'ID du service
        var deleteUrl = '{{ route("admin.service.delete", ":id") }}';
        deleteUrl = deleteUrl.replace(':id', serviceId);

        // Mettre à jour l'URL du formulaire de suppression
        document.getElementById("deleteForm").setAttribute("action", deleteUrl);
    }


    document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var serviceId = this.name.match(/\[(\d+)\]/)[1]; // Extract service ID
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/admin/service/status/${serviceId}`, {
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
                    console.log('Status updated successfully!');
                } else {
                    console.log('Failed to update status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%', // Ajuste la largeur
            allowClear: true, // Ajoute une option pour effacer la sélection
            placeholder: $(this).data('placeholder') // Utilise le placeholder défini dans l’attribut data-placeholder
        });
    });
</script>

{{-- <script>
    document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var serviceId = this.name.match(/\[(\d+)\]/)[1]; // Extract service ID
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/admin/service/status/${serviceId}`, {
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
                    console.log('Status updated successfully!');
                } else {
                    console.log('Failed to update status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script> --}}


@endsection

