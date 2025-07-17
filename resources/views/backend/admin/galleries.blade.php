@extends('backend.admin.layout.master')
@section('title') Galeries @endsection
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Galeries</p>
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
                            <span class="p-2 br-10 bg-info-transparent border border-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-certificate fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Catégories</p>
                            <h4>{{ $categories->count() }}</h4>
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
                            <span class="p-2 br-10 bg-secondary border border-pink d-flex align-items-center justify-content-center">
                                <i class="ti ti-map-pin text-white fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Sites</p>
                            <h4>{{ $sitesTotal }}</h4>
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
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_gallery" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Nouvelle Galerie</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card">
    <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="d-flex align-items-center flex-wrap row-gap-3">
                <!-- Filtre par statut -->
                <div class="dropdown me-3">
                    <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                        Sélectionner le statut
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3" id="status-dropdown">
                        <li>
                            <a href="{{ route('admin.galleries', ['status' => 'Site']) }}" class="dropdown-item rounded-1">Sites</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.galleries', ['status' => 'Circuit']) }}" class="dropdown-item rounded-1">Circuits</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.galleries', ['status' => 'Hotel']) }}" class="dropdown-item rounded-1">Hôtels</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.galleries', ['status' => 'Monument']) }}" class="dropdown-item rounded-1">Monuments</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.galleries', ['status' => 'Museum']) }}" class="dropdown-item rounded-1">Musées</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.galleries', ['status' => 'Event']) }}" class="dropdown-item rounded-1">Événements</a>
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
                            <a href="{{ route('admin.galleries', ['period' => 'recently_added']) }}" class="dropdown-item rounded-1">Récemment ajoutés</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.galleries', ['period' => 'last_month']) }}" class="dropdown-item rounded-1">Dernier mois</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.galleries', ['period' => 'last_7_days']) }}" class="dropdown-item rounded-1">Derniers 7 jours</a>
                        </li>
                    </ul>
                </div>

            </div>
            <div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_gallery" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Nouvelle Galerie</a>
            </div>
        </div>
    </div>
</div> --}}
@if ($total > 0)
    <div class="card">
        <div class="card-body p-0">
            <div class="custom-datatable-filter table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>QR Code</th>

                            {{-- <th>Type</th> --}}
                            <th>Élément</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $index => $gallery)
                            <tr class="border-5">
                                <td>{{ $index + 1 }}</td>
                                {{-- <td>
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="Image" width="50" height="50">
                                </td> --}}

                                <td>
                                    <a href="{{ asset('storage/' . $gallery->image) }}" target="_blank" class=" btn btn-secondary">
                                        Voir l'image
                                    </a>
                                </td>


                                {{-- <td>
                                    {{ class_basename($gallery->galleryable_type) }}
                                </td> --}}
                                <td>
                                    {!! QrCode::size(50)->generate(asset('storage/' . $gallery->image)) !!}
                                </td>


                                <td>
                                    @if ($gallery->galleryable)
                                        {{ $gallery->galleryable->name ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check form-switch d-inline-block">
                                        <input type="hidden" name="status[{{ $gallery->id }}]" value="0">
                                        <input class="form-check-input me-2" type="checkbox" role="switch"
                                            name="status[{{ $gallery->id }}]" value="1" {{ $gallery->status ? 'checked' : '' }}
                                            id="status-switch-{{ $gallery->id }}">
                                    </div>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $gallery->id }})" class="ms-2">
                                        <i class="ti ti-trash fs-20 text-danger"></i>
                                    </a>
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



<!-- Add gallery -->
<div class="modal fade" id="add_gallery" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header header-border align-items-center justify-content-between">
				<div class="d-flex align-items-center">
					<h5 class="modal-title me-2">Ajouter </h5>
				</div>
				<button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
					<i class="ti ti-x"></i>
				</button>
			</div>
			<div class="add-info-fieldset ">
				<div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-tab" tabindex="0">
                        <form action="{{ route('admin.gallery.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Type d'élément -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="galleryable_type" class="form-label">Type d'élément</label>
                                            <select class="form-select" name="galleryable_type" id="galleryable_type" required>
                                                <option value="">-- Sélectionner un type --</option>
                                                <option value="App\Models\Site">Site</option>
                                                <option value="App\Models\Event">Événement</option>
                                                {{-- <option value="App\Models\Circuit">Circuit</option>
                                                <option value="App\Models\Hotel">Hôtel</option>
                                                <option value="App\Models\Monument">Monument</option>
                                                <option value="App\Models\Museum">Musée</option>
                                                <option value="App\Models\Event">Événement</option> --}}
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Élément spécifique -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="galleryable_id" class="form-label">Élément</label>
                                            <select class="form-select" name="galleryable_id" id="galleryable_id" required>
                                                <option value="">-- Sélectionner un élément --</option>
                                            </select>
                                            <small class="text-muted text-info">Sélectionnez l'élément lié</small>
                                        </div>
                                    </div>

                                    <!-- Upload Image -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="images" class="form-label">Images</label>
                                            <input type="file" name="images[]" id="images" class="form-control" multiple required onchange="previewSelectedFiles()">
                                            <small class="text-muted  text-info">Vous pouvez sélectionner plusieurs images</small>
                                            <div id="selected-images" class="mt-2" style="font-size: 14px; color: #084F6B;"></div>
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
<!-- /Add gallery -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const galleryableType = document.getElementById('galleryable_type');
        const galleryableId = document.getElementById('galleryable_id');

        galleryableType.addEventListener('change', function () {
            const selectedType = this.value;

            galleryableId.innerHTML = '<option value="">Chargement...</option>';

            if (selectedType) {
                fetch('/zpanel/gallery/elements?type=' + encodeURIComponent(selectedType))
                    .then(response => response.json())
                    .then(data => {
                        let options = '<option value="">-- Sélectionner un élément --</option>';
                        data.forEach(item => {
                            options += `<option value="${item.id}">${item.name}</option>`;
                        });
                        galleryableId.innerHTML = options;
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des éléments:', error);
                        galleryableId.innerHTML = '<option value="">Erreur de chargement</option>';
                    });
            } else {
                galleryableId.innerHTML = '<option value="">-- Sélectionner un élément --</option>';
            }
        });
    });

</script>

<script>
    function previewSelectedFiles() {
    const files = document.getElementById('images').files;
        const selectedImagesContainer = document.getElementById('selected-images');

        // On vide d'abord la zone d'aperçu pour éviter la duplication
        selectedImagesContainer.innerHTML = '';

        // Pour chaque fichier sélectionné, crée un aperçu
        Array.from(files).forEach(file => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imageElement = document.createElement('img');
                imageElement.src = e.target.result;
                imageElement.classList.add('preview-image');
                imageElement.style.maxWidth = '100px';  // Limite la taille de l'image
                imageElement.style.margin = '5px';
                selectedImagesContainer.appendChild(imageElement);
            };

            // Lire chaque fichier
            reader.readAsDataURL(file);
        });
    }

</script>
<style>
    .preview-image {
    max-width: 100px;
    margin: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

</style>

<!-- Modal pour confirmation de suppression -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirmer la suppression</h4>
                <p class="mb-3">Vous voulez supprimer cette galerie, cela est irréversible</p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Annuler</a>

                    <!-- Formulaire de suppression dynamique -->
                    <form id="deleteForm" action="{{ route('admin.gallery.delete', ':id') }}" method="POST" style="display: inline;">
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
    function setDeleteLink(galleryId) {
        // Dynamiser l'URL de suppression avec l'ID
        var deleteUrl = '{{ route("admin.gallery.delete", ":id") }}';
        deleteUrl = deleteUrl.replace(':id', galleryId);
        // Mettre à jour l'URL du formulaire de suppression
        document.getElementById("deleteForm").setAttribute("action", deleteUrl);
    }
</script>

<script>
    document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var galleryId = this.name.match(/\[(\d+)\]/)[1]; // Extract gallery ID
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/zpanel/gallery/status-update/${galleryId}`, {
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


@endsection

