@extends('backend.admin.layout.master')
@section('title') Ajouter Reservation @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.sites.reservations') }}">
                <i class="ti ti-arrow-left me-2"></i>Retour</a>
            </h6>
            <div class="d-flex">
                <div class="text-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" ><i class="ti ti-circle-arrow-up me-1"></i>Tableau de board</a>
                </div>
                <div class="head-icons ms-2 text-end">
                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                        <i class="ti ti-chevrons-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- <form action="{{ route('admin.sites.reservation.add') }}" method="POST">
        @csrf
        <div class="modal-body pb-0">
            <div class="row">
                <!-- Client -->
                <div class="col-md-4">
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

                <!-- Site touristique -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="site_id" class="form-label">Site touristique <span class="text-danger">*</span></label>
                        <select id="site_id" name="site_id" class="form-control" required>
                            <option value="">Sélectionner un site</option>
                            @foreach ($sites as $site)
                                <option value="{{ $site->id }}">{{ $site->name }}</option>
                            @endforeach
                        </select>
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

                <!-- Nombre de personnes -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="number_of_people" class="form-label">Nombre de personnes <span class="text-danger">*</span></label>
                        <input type="number" name="number_of_people" id="number_of_people" class="form-control" min="1" required>
                    </div>
                </div>

                <!-- Statut paiement -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="payment_status" class="form-label">Paiement</label>
                        <select name="payment_status" id="payment_status" class="form-control">
                            <option value="0">Non payé</option>
                            <option value="1">Payé</option>
                        </select>
                    </div>
                </div>

               <!-- Note -->
               <div class="col-md-12">
                    <div class="mb-3">
                        <label for="note" class="form-label">Informations Additionnelles</label>
                        <textarea name="note" id="note" class="form-control" rows="3" placeholder="Demandes spéciales du client (par exemple, des préférences de visite)"></textarea>
                    </div>
                </div>

                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary mb-3">Enregistrer la réservation</button>
                </div>
            </div>
        </div>
    </form> --}}

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

@endsection
