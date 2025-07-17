@extends('backend.admin.layout.master')
@section('title') Événements @endsection
@section('content')

<div class="row">
    <!-- Total Events -->
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-pink-transparent border border-pink d-flex align-items-center justify-content-center">
                                <i class="ti ti-users-group text-pink fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Total Événements</p>
                            <h4>{{ $totalEvents }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Events Upcoming -->
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-info-transparent border border-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-calendar-plus fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Événements à Venir</p>
                            <h4>{{ $upcomingEvents }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Events Passed -->
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-warning-transparent border border-warning d-flex align-items-center justify-content-center">
                                <i class="ti ti-calendar-check fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Événements Passés</p>
                            <h4>{{ $pastEvents }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Event Button -->
    <div class="col-xl-3 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_event" class="btn btn-primary d-flex align-items-center">
                                <i class="ti ti-circle-plus"></i> Nouvel Événement
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@if ($events->count() > 0)
    <div class="card">
        <div class="card-body p-0">
            <div class="custom-datatable-filter table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Catégorie/Événement</th>
                            <th>Durée</th>
                            {{-- <th>Description</th> --}}
                            <th>Localisation</th>
                            <th>Vues</th>
                            {{-- <th>Statut</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($events as $index => $event)
                            <tr class=" border-5 " >
                                <td>{{ $index + 1 }}</td>
                                <td style=" font-weight: bold; color:black">{{ $event->category->name }}: {{ $event->name }}</td>

                                <td>
                                   {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }} -
                                    {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}
                                </td>
                                {{-- <td style="max-width: 300px; word-wrap: break-word; white-space: normal;">
                                        {{ Str::limit($event->description, 20) }}
                                </td> --}}
                                <td >
                                        {{ $event->location }}
                                </td>
                                {{-- <td style="max-width: 150px; word-wrap: break-word; white-space: normal;">
                                    <span class=" "><i class="ti ti-user-check"></i> {{ $event->reservations->count() }} </span>
                                </td> --}}

                                <td>
                                    <span class=" "><i class="ti ti-eye"></i> {{ $event->views()->count() }} </span>
                                </td>

                                <td>
                                    <div class="form-check form-switch">
                                        <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                        <input type="hidden" name="status[{{ $event->id }}]" value="0">
                                        <!-- Case à cocher avec la valeur '1' si cochée -->
                                        <input class="form-check-input me-2" type="checkbox" role="switch"
                                            name="status[{{ $event->id }}]" value="1" {{ $event->status ? 'checked' : '' }}
                                            id="status-switch-{{ $event->id }}">
                                    </div>
                                    <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>

                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $event->id }})">
                                        <i class="ti ti-trash fs-20 text-danger"></i> <!-- Icône de suppression -->
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
                <p class="mb-3">Cette action est irréversible</p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Annuler</a>

                    <!-- Formulaire de suppression dynamique -->
                    <form id="deleteForm" action="{{ route('admin.event.delete', ':id') }}" method="POST" style="display: inline;">
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
    function setDeleteLink(eventId) {
        // Dynamiser l'URL de suppression avec l'ID du event
        var deleteUrl = '{{ route("admin.event.delete", ":id") }}';
        deleteUrl = deleteUrl.replace(':id', eventId);

        // Mettre à jour l'URL du formulaire de suppression
        document.getElementById("deleteForm").setAttribute("action", deleteUrl);
    }
</script>

<script>
    document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var eventId = this.name.match(/\[(\d+)\]/)[1]; // Extract event ID
            var status = this.checked ? 1 : 0;

            // Send the update request via AJAX
            fetch(`/admin/event/status-update/${eventId}`, {
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


<!-- Add Event -->
<div class="modal fade" id="add_event">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un nouvel événement</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.event.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="name" class="form-label">Titre de l’événement <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Festival des arts de la forêt" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="location" class="form-label">Lieu <span class="text-danger">*</span></label>
                                <input type="text" id="location" name="location" class="form-control" placeholder="Ex: Place publique de Lola" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="language_id" class="form-label">Langue <span class="text-danger">*</span></label>
                                <select name="language_id" id="language_id" class="form-control" required>
                                    @foreach($languages as $lang)
                                        <option value="{{ $lang->id }}" {{ $lang->id == 1 ? 'selected' : '' }}>{{ $lang->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Catégorie</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="image" class="form-label">Affiche ou image <span class="text-danger">*</span></label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                            </div>
                        </div>
                                <!-- Dates -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Date de début <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Date de fin <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
                            </div>
                        </div>

                         <!-- Champ pour la vidéo -->
                         <div class="col-md-6">
                            <div class="mb-3">
                                <label for="video" class="form-label">Vidéo (optionnel)</label>
                                <input type="file" name="video" id="video" class="form-control" accept="video/*">
                                <small class="form-text text-muted text-info">Téléchargez une vidéo</small>
                            </div>
                        </div>

                        <!-- OU champ pour l'URL de la vidéo -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="video_url" class="form-label">Lien vers la vidéo (optionnel)</label>
                                <input type="url" name="video_url" id="video_url" class="form-control" placeholder="Lien vers la vidéo" >
                                <small class="form-text text-muted text-info">Si vous préférez ajouter un lien vidéo (YouTube, Vimeo, etc.), entrez-le ici</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Détails sur l’événement, programme, intervenants, etc." required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary mb-3">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add Event -->


@endsection
