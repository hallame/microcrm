@extends('backend.admin.layout.master')
@section('title') Emplacements @endsection
@section('content')

<div class="row">
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-info-transparent border border-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-map text-info fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Emplacements</p>
                            <h4>{{ $totalLocations }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-success-transparent border border-success d-flex align-items-center justify-content-center">
                                <i class="ti ti-chart-line fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Fermes</p>
                            <h4>{{ $closedLocations }}</h4>
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
                            <span class="p-2 br-10 bg-info-transparent border border-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-certificate fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Ouverts</p>
                            <h4>{{ $openedLocations }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-danger-transparent border border-danger d-flex align-items-center justify-content-center">
                                <i class="ti ti-lock fs-18"></i> <!-- Icône de fermeture -->
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Fermés</p>
                            <h4>{{ $closedLocations }}</h4>
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
                                <i class="ti ti ti-building fs-18"></i> <!-- Icône d'ouverture -->
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Ouverts</p>
                            <h4>{{ $openedLocations }}</h4>
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
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_location" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Nouveau Local</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($locations->count() > 0)
    <div class="card">
        <div class="card-body p-0">
            <div class="custom-datatable-filter table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Détails</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $index => $location)
                            <tr class=" border-5 " >
                                <td>{{ $index + 1 }}</td>
                                <td style="max-width: 200px; word-wrap: break-word; white-space: normal; font-weight: bold; color:black">{{ $location->name }}</td>
                                <td style="max-width: 200px; word-wrap: break-word; white-space: normal; ">{{ $location->address }}</td>
                                <td style="max-width: 200px; word-wrap: break-word; white-space: normal; ">{{ $location->email }}</td>
                                <td style="max-width: 200px; word-wrap: break-word; white-space: normal; ">{{ $location->phone }}</td>
                                <td style="max-width: 200px; word-wrap: break-word; white-space: normal; ">{{ $location->details }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                        <input type="hidden" name="status[{{ $location->id }}]" value="0">
                                        <!-- Case à cocher avec la valeur '1' si cochée -->
                                        <input class="form-check-input me-2" type="checkbox" role="switch"
                                            name="status[{{ $location->id }}]" value="1" {{ $location->status ? 'checked' : '' }}
                                            id="status-switch-{{ $location->id }}">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $location->id }})">
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
                <p class="mb-3">Vous voulez supprimer cet emplacement, cela est irréversible</p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Annuler</a>

                    <!-- Formulaire de suppression dynamique -->
                    <form id="deleteForm" action="{{ route('admin.location.delete', ':id') }}" method="POST" style="display: inline;">
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
    function setDeleteLink(locationId) {
        var deleteUrl = '{{ route("admin.location.delete", ":id") }}';
        deleteUrl = deleteUrl.replace(':id', locationId);

        // Mettre à jour l'URL du formulaire de suppression
        document.getElementById("deleteForm").setAttribute("action", deleteUrl);
    }
</script>

<script>
    document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var locationId = this.name.match(/\[(\d+)\]/)[1];
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/admin/location/status/${locationId}`, {
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
</script>



@endsection

