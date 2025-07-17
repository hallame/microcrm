@extends('backend.admin.layout.master')
@section('title') Réservations @endsection
@section('content')
    <div class="row">
        <!-- Total des Réservations -->
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <span class="p-2 br-10 bg-primary-transparent border border-primary d-flex align-items-center justify-content-center">
                                    <i class="ti ti-calendar-stats text-primary fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-12 fw-medium mb-1 text-gray-5">Total Réservations</p>
                                <h4>{{ $totalReservations }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Réservations Confirmées -->
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <span class="p-2 br-10 bg-success-transparent border border-success d-flex align-items-center justify-content-center">
                                    <i class="ti ti-check text-success fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-12 fw-medium mb-1 text-gray-5">Confirmées</p>
                                <h4>{{ $confirmed }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Réservations en Attente -->
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <span class="p-2 br-10 bg-warning-transparent border border-warning d-flex align-items-center justify-content-center">
                                    <i class="ti ti-clock text-warning fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-12 fw-medium mb-1 text-gray-5">En attente</p>
                                <h4>{{ $pending }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Réservations Annulées -->
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <span class="p-2 br-10 bg-danger-transparent border border-danger d-flex align-items-center justify-content-center">
                                    <i class="ti ti-ban text-danger fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-12 fw-medium mb-1 text-gray-5">Annulées</p>
                                <h4>{{ $cancelled }}</h4>
                            </div>
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
                            Sélectionner le statut
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3" id="status-dropdown">
                            <li>
                                <a href="{{ route('admin.sites.reservations', ['status' => 'all']) }}" class="dropdown-item rounded-1">Toutes les réservations</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sites.reservations', ['status' => 'confirmed']) }}" class="dropdown-item rounded-1">Réservations Confirmées</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sites.reservations', ['status' => 'pending']) }}" class="dropdown-item rounded-1">Réservations en Attente</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sites.reservations', ['status' => 'cancelled']) }}" class="dropdown-item rounded-1">Réservations Annulées</a>
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
                                <a href="{{ route('admin.sites.reservations', ['period' => 'recently_added']) }}" class="dropdown-item rounded-1">Récemment ajoutées</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sites.reservations', ['period' => 'last_month']) }}" class="dropdown-item rounded-1">Dernier mois</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sites.reservations', ['period' => 'last_7_days']) }}" class="dropdown-item rounded-1">Derniers 7 jours</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_reservation" class="btn btn-primary d-flex align-items-center text-center"><i class="ti ti-circle-plus me-2"></i>Ajouter une réservation</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-xl-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div>
                                @if($reservations->isEmpty())
                                    @include('partials.empty')
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom du client</th>
                                                <th>Réservation</th>
                                                <th>Date du Début</th>
                                                {{-- <th>Date de la Fin</th> --}}
                                                {{-- <th>Participants</th> --}}
                                                {{-- <th>Payement</th> --}}
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.client.details', ['client' => $reservation->client]) }}">
                                                            {{ $reservation->client->firstname }} {{ $reservation->client->lastname }}
                                                        </a>
                                                    <td>
                                                        @if ($reservation->site)
                                                            {{ $reservation->site->name }} (Site)
                                                        @elseif ($reservation->circuit)
                                                            {{ $reservation->circuit->name }} (Circuit)
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y à H:i') }}</td>
                                                    {{-- <td>{{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y à H:i') }}</td> --}}

                                                    {{-- <td>
                                                        @if($reservation->payment_status == 1)
                                                            <span class="badge bg-success">Payé</span>
                                                        @else
                                                            <span class="badge bg-warning">Non Payé</span>
                                                        @endif
                                                    </td> --}}
                                                    {{-- <td>{{  $reservation->number_of_people  }}</td> --}}
                                                    <td>
                                                        @if($reservation->status == 1)
                                                            <span class="badge bg-success">Confirmée</span>
                                                        @elseif($reservation->status == 2)
                                                            <span class="badge bg-danger">Annulée</span>
                                                        @elseif($reservation->status == 3)
                                                            <span class="badge bg-secondary">Terminée</span>
                                                        @else
                                                            <span class="badge bg-warning">En attente</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.sites.reservation.details', ['reservation' => $reservation]) }}" class="btn btn-sm btn-info"><i class="ti ti-eye"></i></a>
                                                        {{-- <a href="{{ route('admin.sites.reservation.details', $reservation->id) }}" class="btn btn-sm btn-info">Détails</a> --}}
                                                        <a href="{{ route('admin.sites.reservation.edit', $reservation->id) }}" class="btn btn-sm bg-pink"><i class="ti ti-edit text-white fs-20"></i></a>
                                                        @switch($reservation->status ?? null)
                                                            @case(0) <!-- En Attente -->
                                                                <a href="javascript:void(0);" class="btn btn-md btn-success shadow-lg hover:bg-green-600"
                                                                title="Confirmer" onclick="showCommentModal('confirmer', '{{ route('admin.sites.reservation.confirm', ['reservation' => $reservation]) }}')">
                                                                    <i class="ti ti-check text-white fs-20"></i> <!-- Icone "check" -->
                                                                </a>
                                                                <a href="javascript:void(0);" class="btn btn-md btn-danger shadow-lg hover:bg-red-600"
                                                                title="Annuler" onclick="showCommentModal('annuler', '{{ route('admin.sites.reservation.cancel', ['reservation' => $reservation]) }}')">
                                                                    <i class="ti ti-x text-white fs-20"></i> <!-- Icone "x" -->
                                                                </a>
                                                                @break
                                                            @case(1) <!-- En Cours -->
                                                                <a href="javascript:void(0);" class="btn btn-md btn-secondary shadow-lg hover:bg-blue-600"
                                                                title="Terminer" onclick="showCommentModal('terminer', '{{ route('admin.sites.reservation.complete', ['reservation' => $reservation]) }}')">
                                                                    <i class="ti ti-circle-check text-white fs-20"></i> <!-- Icone "check-circle" -->
                                                                    Terminer
                                                                </a>
                                                                @break
                                                            @case(2)
                                                                <i class="ti ti-ban"></i> Visite Annulée.
                                                            @break
                                                            @case(3)
                                                                <i class="ti ti-lock"></i> Visite Terminée.
                                                                @break
                                                        @endswitch
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
        </div>
    </div>

    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">Confirmer l'action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="confirmationMessage">Êtes-vous sûr de vouloir confirmer ? <br> Veuillez laisser un commentaire au client:</p>
                    <form method="POST" class="comment-form">
                        @csrf
                        <textarea name="note" class="form-control" rows="1" placeholder="Entrez votre message..." required></textarea>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary m-1">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCommentModal(action, route) {
        var modal = $('#commentModal');
        // Définir le message de confirmation dynamiquement
        var confirmationMessage = '';
        if (action === 'confirmer') {
            confirmationMessage = 'Êtes-vous sûr de vouloir confirmer ? <br> Veuillez entrer le code de confirmation:';
        } else if (action === 'annuler') {
            confirmationMessage = 'Êtes-vous sûr de vouloir annuler ? <br> Veuillez écrire la raison de l\'annulation:';
        } else if (action === 'terminer') {
            confirmationMessage = 'Êtes-vous sûr de vouloir terminer ? <br> Veuillez laisser un commentaire :';
        }
        // Mettre à jour le message de confirmation dans le modal
        document.getElementById('confirmationMessage').innerHTML = confirmationMessage;
        // Mettre à jour l'action du formulaire avec la route correspondante
        modal.find('.comment-form').attr('action', route);
        // Afficher le modal
        modal.modal('show');
        }

    </script>



    <!-- Add Reservation -->
    <div class="modal fade" id="add_reservation">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ajouter une réservation</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('admin.sites.reservation.add') }}" method="POST">
                    @csrf
                    <div class="modal-body pb-0">
                        <div class="row">

                             <!-- Client -->
                             <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="client_id" class="form-label">Client <span class="text-danger">*</span></label>
                                    <select id="client_id" name="client_id" class="form-control" required>
                                        <option value="">Sélectionner un client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->firstname }} {{ $client->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Type de réservation -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="booking_type" class="form-label">Type de réservation <span class="text-danger">*</span></label>
                                    <select id="booking_type" name="booking_type" class="form-control" onchange="toggleVisitType()" required>
                                        <option value="site">Site Touristique</option>
                                        <option value="circuit">Circuit</option>
                                    </select>
                                </div>
                            </div>



                            <!-- Lieu de visite -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="site_id" class="form-label">Lieu de visite <span class="text-danger">*</span></label>
                                    <!-- Sites -->
                                    <select id="site_id" name="site_id" class="form-control">
                                        <option value="">Sélectionner un site</option>
                                        @foreach ($sites as $site)
                                            <option value="{{ $site->id }}">[{{ $site->city }}] {{ $site->name }}</option>
                                        @endforeach
                                    </select>

                                    <!-- Circuits -->
                                    <select id="circuit_id" name="circuit_id" class="form-control d-none">
                                        <option value="">Sélectionner un circuit</option>
                                        @foreach ($circuits as $circuit)
                                            @php
                                                $contenants = $circuit->sites->pluck('name')->implode(', ');
                                            @endphp
                                            <option value="{{ $circuit->id }}">{{ $circuit->name }} [{{ $contenants }}]</option>
                                        @endforeach
                                    </select>

                                    {{-- <select id="circuit_select" name="location_id" class="form-control d-none">
                                        <option value="">Sélectionner un circuit</option>
                                        @foreach ($circuits as $circuit)
                                            <option value="{{ $circuit->id }}">[{{ $circuit->contenants }}] {{ $circuit->name }}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                            </div>

                            <!-- Langue -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="language_id" class="form-label">Langue</label>
                                    <select name="language_id" id="language_id" class="form-control">
                                        @foreach ($languages as $lang)
                                            <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <!-- Nombre de personnes -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="number_of_people" class="form-label">Nombre de personnes <span class="text-danger">*</span></label>
                                    <input type="number" name="number_of_people" id="number_of_people" class="form-control" min="1" required>
                                </div>
                            </div>

                            <!-- Paiement -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="payment_status" class="form-label">Paiement</label>
                                    <select name="payment_status" id="payment_status" class="form-control">
                                        <option value="0">Non payé</option>
                                        <option value="1">Payé</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Date de début <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Date de fin <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
                                </div>
                            </div>

                            <!-- Note -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="note" class="form-label">Informations Additionnelles</label>
                                    <textarea name="note" id="note" class="form-control" rows="3" placeholder="Demandes spéciales du client (par exemple, des préférences de visite)"></textarea>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary mb-3">Enregistrer la réservation</button>
                            </div>
                        </div>
                    </div>
                </form>
                <script>
                    function toggleVisitType() {
                        const bookingType = document.getElementById('booking_type').value;
                        const siteSelect = document.getElementById('site_id');
                        const circuitSelect = document.getElementById('circuit_id');

                        siteSelect.classList.toggle('d-none', bookingType !== 'site');
                        circuitSelect.classList.toggle('d-none', bookingType !== 'circuit');

                        if (bookingType === 'site') {
                            circuitSelect.value = ""; // on réinitialise
                        } else {
                            siteSelect.value = ""; // on réinitialise
                        }
                    }
                </script>
            </div>
        </div>
    </div>
    <!-- /Add Reservation -->
@endsection
