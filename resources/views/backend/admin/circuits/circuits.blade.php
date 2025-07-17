@extends('backend.admin.layout.master')
@section('title') Circuits @endsection
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Circuits</p>
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
                                <i class="ti ti-map-pin fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Sites</p>
                            <h4>{{ $totalSites }}</h4>
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Catégories</p>
                            <h4>{{ $circuitsCategories }}</h4>
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
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_circuit" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Nouveau circuit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($total > 0)
    <div class="card">
        <div class="card-body p-0">
            <div class="custom-datatable-filter table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Circuits</th>
                            <th>Catégories</th>
                            <th>Sites</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($circuits as $index => $circuit)
                            <tr class=" border-5 " >
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $circuit->name }}</td>
                                <td>{{ $circuit->category->name ?? '--' }}</td>
                                <td>
                                    @foreach ($circuit->sites as $site)
                                        <span><i class="ti ti-map-pin"></i> {{ $site->name }}</span> <br>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                        <input type="hidden" name="status[{{ $circuit->id }}]" value="0">
                                        <!-- Case à cocher avec la valeur '1' si cochée -->
                                        <input class="form-check-input me-2" type="checkbox" role="switch"
                                            name="status[{{ $circuit->id }}]" value="1" {{ $circuit->status ? 'checked' : '' }}
                                            id="status-switch-{{ $circuit->id }}">
                                        <a href="{{ route('admin.circuit.edit', $circuit->id) }}" class="btn btn-sm btn-outline-secondary me-2"
                                            title="Éditer" > <i class="ti ti-edit fs-16"></i>
                                        </a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $circuit->id }})">
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
    @include('partials.empty')
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
                <p class="mb-3">Vous voulez supprimer ce circuit, cela est irréversible</p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Annuler</a>

                    <!-- Formulaire de suppression dynamique -->
                    <form id="deleteForm" action="{{ route('admin.circuit.delete', ':id') }}" method="POST" style="display: inline;">
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
    function setDeleteLink(circuitId) {
        // Dynamiser l'URL de suppression avec l'ID
        var deleteUrl = '{{ route("admin.circuit.delete", ":id") }}';
        deleteUrl = deleteUrl.replace(':id', circuitId);

        // Mettre à jour l'URL du formulaire de suppression
        document.getElementById("deleteForm").setAttribute("action", deleteUrl);
    }
</script>

<script>
    document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var circuitId = this.name.match(/\[(\d+)\]/)[1]; // Extract circuit ID
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/zpanel/circuit/status-update/${circuitId}`, {
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


<!-- Add Circuit -->
<div class="modal fade" id="add_circuit" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header header-border align-items-center justify-content-between">
				<div class="d-flex align-items-center">
					<h5 class="modal-title me-2">Ajouter un nouveau circuit </h5>
				</div>
				<button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
					<i class="ti ti-x"></i>
				</button>
			</div>
			<div class="add-info-fieldset ">
				<div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-tab" tabindex="0">
                        <form action="{{ route('admin.circuit.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                             <div class="modal-body">
                                <div class="row">
                                    <!-- Nom du circuit -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom du circuit <span class="text-danger">*</span></label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="name"
                                                id="name"
                                                placeholder="Entrer le nom du circuit"
                                                required
                                            >
                                        </div>
                                    </div>
                                    <!-- Image du circuit -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image du circuit<span class="text-danger">*</span></label>
                                            <input
                                                type="file"
                                                class="form-control"
                                                name="image"
                                                id="image"
                                                accept="image/*"
                                            >
                                            <small class="text-muted">Formats acceptés : jpg, png, gif, max 2 Mo</small>
                                        </div>
                                    </div>


                                    <!-- Catégorie du circuit -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Catégorie<span class="text-danger">*</span></label>
                                            <select class="form-select" name="category_id" id="category_id">
                                                <option value="">Sélectionner une catégorie</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">

                                    <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="note" class="form-label">Info sur le prix</label>
                                                <input type="text" id="note" name="note" class="form-control" placeholder="Ex: A partir de ...">
                                            </div>
                                        </div>

                                    <!-- Sélection des sites -->
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="sites" class="form-label">Sites du circuit <span class="text-danger">*</span></label>
                                            <select
                                                class="form-select select2"
                                                name="sites[]"
                                                id="sites"
                                                multiple
                                                required
                                                onchange="updateLeaderOptions()"
                                                data-placeholder="Sélectionnez les sites"
                                            >
                                                @foreach ($sites as $site)
                                                    <option value="{{ $site->id }}">{{ $site->name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted text-info">Sélectionnez plusieurs sites</small>
                                        </div>
                                    </div>

                                    <!-- Description du circuit -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea
                                                name="description"
                                                id="description"
                                                cols="30"
                                                rows="3"
                                                class="form-control"
                                                placeholder="Entrez une brève description"
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Boutons -->
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Enregistrer</button>
                            </div>
                        </form>
                    </div>
			    </div>
		    </div>
	    </div>
	</div>
</div>
<!-- /Add Circuit -->


@endsection

