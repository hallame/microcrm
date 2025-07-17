@extends('backend.admin.layout.master')
@section('title') Client Détails @endsection
@section('content')
<div class="row justify-content-between align-items-center mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.clients') }}">
                <i class="ti ti-arrow-left me-2"></i>Clients</a>
            </h6>


            <a href="#" data-bs-toggle="modal" data-bs-target="#add_client" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Ajouter un client</a>

        </div>
    </div>

</div>
<div class="row">
    <div class="col-xl-4">
        <div class="card card-bg-3">
            <div class="card-body p-0">
                <span class="avatar avatar-xl avatar-rounded border border-2 border-white m-auto d-flex mb-2">
                    <img src="{{ asset('assets/images/client1.png') }}" class="w-auto h-auto" alt="Img">
                </span>
                <div class="text-center px-3 pb-3 border-bottom">
                    <div class="mb-3">
                        <h5 class="d-flex align-items-center justify-content-center mb-1">
                            {{ $client->firstname }} {{ $client->lastname }}
                            <i class="ti ti-discount-check-filled text-success ms-1"></i>
                        </h5>
                        <p class="text-dark mb-1">{{ $client->company ?? 'Entreprise non spécifiée' }}</p>
                        <span class="badge badge-soft-secondary fw-medium">{{ $client->position ?? 'Poste Non spécifié' }}</span>
                    </div>
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="d-inline-flex align-items-center">
                                <i class="ti ti-id me-2"></i>
                                Client ID
                            </span>
                            <p class="text-dark">CLT{{ str_pad($client->id, 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="d-inline-flex align-items-center"><i class="ti ti-calendar-check me-2"></i>
                                Inscrit le:
                            </span>
                            <p class="text-dark">{{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}</p>
                        </div>
                        <div class="row gx-2 mt-3">
                            @if (!empty($client->phone))
                                <div class="col-6">
                                    <div>
                                        <a href="tel:{{ $client->phone }}" class="btn btn-dark w-100">
                                            <i class="ti ti-phone-call me-1"></i> Appeler
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="{{ empty($client->phone) ? 'col-12' : 'col-6' }}">
                                <div>
                                    <a href="mailto:{{ $client->email }}" class="btn btn-primary w-100">
                                        <i class="ti ti-message-heart me-1"></i> Écrire
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 border-bottom">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6>Information Personnelles</h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="d-inline-flex align-items-center">
                            <i class="ti ti-phone me-2"></i>
                            Téléphone
                        </span>
                        <p class="text-dark">{{ $client->phone }}</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="d-inline-flex align-items-center">
                            <i class="ti ti-mail-check me-2"></i>
                            Email
                        </span>
                        <a href="mailto:{{ $client->email }}" class="text-info d-inline-flex align-items-center">
                            {{ $client->email }}
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="d-inline-flex align-items-center">
                            <i class="ti ti-map-pin-check me-2"></i>
                            Adresse
                        </span>
                        <p class="text-dark text-end fs-10">{{ $client->address ?? 'Adresse non renseignée' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div>
            <div class="bg-white rounded">
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active fw-medium d-flex align-items-center justify-content-center" href="#bottom-justified-tab1" data-bs-toggle="tab" aria-selected="false" role="tab">
                            <i class="ti ti-folder-open me-1"></i>
                            Aperçu
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link fw-medium d-flex align-items-center justify-content-center" href="#bottom-justified-tab2" data-bs-toggle="tab" aria-selected="false" role="tab">
                            <i class="ti ti-calendar me-1"></i>
                            Réservations({{ $totalReservations }})
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link fw-medium d-flex align-items-center justify-content-center" href="#bottom-justified-tab6" data-bs-toggle="tab" aria-selected="true" role="tab">
                            <i class="ti ti-star me-1"></i>
                            Avis Laissés ({{ $totalReviews }})
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content custom-accordion-items client-accordion">
                <div class="tab-pane active show" id="bottom-justified-tab1" role="tabpanel">
                    <div class="accordion accordions-items-seperate" id="accordionExample">

                        <div class="accordion-item">
                            <div class="accordion-header" id="headingOne">
                                <div class="accordion-button bg-white" data-bs-toggle="collapse" data-bs-target="#primaryBorderOne" aria-expanded="true" aria-controls="primaryBorderOne" role="button">
                                    <h5>Réservations</h5>
                                </div>
                            </div>
                            <div id="primaryBorderOne" class="accordion-collapse collapse show border-top" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body pb-0">
                                    <div class="row">
                                        @if ($totalReservations > 0)
                                            @foreach ($client->reservations as $reservation)
                                                <div class="col-xxl-6 col-lg-12 col-md-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center pb-3 mb-3 border-bottom">
                                                                <a class="flex-shrink-0 me-2">
                                                                    <img src="{{ asset('assets/images/booking.png') }}" style="width: 35px; height: 35px" alt="Img">
                                                                </a>
                                                                <div>
                                                                    <h6 class="mb-1">
                                                                        <a >
                                                                            {{ $reservation->identifier }} |
                                                                            @if ($reservation->site)
                                                                            Site: {{ $reservation->site->name }}
                                                                            @elseif ($reservation->event)
                                                                            Événement: {{ $reservation->event->name }}
                                                                            @elseif ($reservation->hotel)
                                                                            Hôtel: {{ $reservation->hotel->name }}
                                                                            @endif
                                                                        </a>
                                                                        @if($reservation->status == 1)
                                                                            <span class="badge bg-success">Confirmée</span>
                                                                        @elseif($reservation->status == 2)
                                                                            <span class="badge bg-danger">Annulée</span>
                                                                        @elseif($reservation->status == 3)
                                                                            <span class="badge bg-secondary">Terminée</span>
                                                                        @else
                                                                            <span class="badge bg-warning">En attente</span>
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                            <div class="row border-bottom">
                                                                <div class="col-sm-6">
                                                                    <div class="mb-3">
                                                                        <span class="mb-1 d-block">📅 Durée de la réservation</span>
                                                                        <p class="text-dark">Du {{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') }}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-4">
                                                                    <div class="mb-3">
                                                                        <span class="fw-medium d-flex align-items-center">
                                                                            <i class="ti ti-calendar me-2"></i> Date de réservation
                                                                        </span>
                                                                        <p class="text-dark">{{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y') }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-2">
                                                                    <div class="mb-3">
                                                                        <span class="fw-medium d-flex align-items-center">
                                                                            <i class="ti ti-star me-2"></i> Note
                                                                        </span>
                                                                        <p class="text-dark">
                                                                            {{ optional($reservation->reviews->where('client_id', $client->id)->first())->rating ?? 'Non noté' }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @include('partials.empty')
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="headingFive">
                                <div class="accordion-button collapsed" data-bs-toggle="collapse" role="button" data-bs-target="#primaryBorderFive" aria-expanded="false" aria-controls="primaryBorderFive">
                                    <h5>Avis Laissés</h5>
                                </div>
                            </div>
                            <div id="primaryBorderFive" class="accordion-collapse collapse border-top" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    @if($client->reviews->isEmpty())
                                        @include('partials.empty')
                                    @else
                                        <div class="custom-datatable-filter table-responsive no-datatable-length border">
                                            <table class="table datatable">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Réservation</th>
                                                        <th>Note</th>
                                                        <th>Commentaire</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($client->reviews as $review)
                                                        <tr>
                                                            <td>
                                                                {{ class_basename($review->reviewable_type) }} {{-- Type : Site, etc. --}}
                                                                <small class="d-block text-muted">
                                                                    {{-- {{ $review->reviewable->identifier ?? '-' }} --}}
                                                                    {{ $review->reviewable->name ?? '-' }}
                                                                </small>
                                                            </td>

                                                            <td>{{ number_format($review->rating, 1) }}/5</td>
                                                            <td>{{ $review->comment ?? '—' }}</td>
                                                            <td>
                                                                <p class="text-title mb-0">{{ $review->created_at->format('d/m/Y') }}</p>
                                                                <span>{{ $review->created_at->format('H:i') }}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="bottom-justified-tab2" role="tabpanel">
                    <div class="accordion accordions-items-seperate">
                        <div class="accordion-item">
                            <div class="accordion-header" id="headingOne2">
                                <div class="accordion-button bg-white" data-bs-toggle="collapse" data-bs-target="#primaryBorderOne2" aria-expanded="true" aria-controls="primaryBorderOne2" role="button">
                                    <h5>Réservations ({{ $totalReservations }})</h5>
                                </div>
                            </div>
                            <div id="primaryBorderOne2" class="accordion-collapse collapse show border-top" aria-labelledby="headingOne2">
                                <div class="accordion-body pb-0">
                                    <div class="row">
                                        @if ($totalReservations > 0)
                                            @foreach ($client->reservations as $reservation)
                                                <div class="col-xxl-6 col-lg-12 col-md-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center pb-3 mb-3 border-bottom">
                                                                <a class="flex-shrink-0 me-2">
                                                                    <img src="{{ asset('assets/images/booking.png') }}" style="width: 35px; height: 35px" alt="Img">
                                                                </a>
                                                                <div>
                                                                    <h6 class="mb-1">
                                                                        <a >
                                                                            {{ $reservation->identifier }} |
                                                                            @if ($reservation->site)
                                                                            Site: {{ $reservation->site->name }}
                                                                            @elseif ($reservation->event)
                                                                            Événement: {{ $reservation->event->name }}
                                                                            @elseif ($reservation->hotel)
                                                                            Hôtel: {{ $reservation->hotel->name }}
                                                                            @endif
                                                                        </a>
                                                                        @if($reservation->status == 1)
                                                                            <span class="badge bg-success">Confirmée</span>
                                                                        @elseif($reservation->status == 2)
                                                                            <span class="badge bg-danger">Annulée</span>
                                                                        @elseif($reservation->status == 3)
                                                                            <span class="badge bg-secondary">Terminée</span>
                                                                        @else
                                                                            <span class="badge bg-warning">En attente</span>
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                            <div class="row border-bottom">
                                                                <div class="col-sm-6">
                                                                    <div class="mb-3">
                                                                        <span class="mb-1 d-block">📅 Durée de la réservation</span>
                                                                        <p class="text-dark">Du {{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') }}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-4">
                                                                    <div class="mb-3">
                                                                        <span class="fw-medium d-flex align-items-center">
                                                                            <i class="ti ti-calendar me-2"></i> Date de réservation
                                                                        </span>
                                                                        <p class="text-dark">{{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y') }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-2">
                                                                    <div class="mb-3">
                                                                        <span class="fw-medium d-flex align-items-center">
                                                                            <i class="ti ti-star me-2"></i> Note
                                                                        </span>
                                                                        <p class="text-dark">
                                                                            {{ optional($reservation->reviews->where('client_id', $client->id)->first())->rating ?? 'Non noté' }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @include('partials.empty')
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="bottom-justified-tab6" role="tabpanel">
                    <div class="accordion accordions-items-seperate">
                        <div class="accordion-item">
                            <div class="accordion-header" id="headingFive2">
                                <div class="accordion-button collapsed" data-bs-toggle="collapse" role="button" data-bs-target="#primaryBorderFive2" aria-expanded="true" aria-controls="primaryBorderFive2">
                                    <h5>Avis Laissés</h5>
                                </div>
                            </div>
                            <div id="primaryBorderFive2" class="accordion-collapse collapse show border-top" aria-labelledby="headingFive2">
                                {{-- <div class="accordion-body">
                                    @if($client->reviews->isEmpty())
                                        @include('partials.empty')
                                    @else
                                        <div class="custom-datatable-filter table-responsive no-datatable-length border">
                                            <table class="table datatable">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Réservation</th>
                                                        <th>Note</th>
                                                        <th>Commentaire</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($client->reviews as $review)
                                                        <tr>
                                                            <td>
                                                                {{ $review->reviewable->identifier ?? '-' }}
                                                                <small class="d-block text-muted">
                                                                    {{ class_basename($review->reviewable_type) }}
                                                                </small>
                                                            </td>
                                                            <td>{{ number_format($review->rating, 1) }}/5</td>
                                                            <td>{{ $review->comment ?? '—' }}</td>
                                                            <td>
                                                                <p class="text-title mb-0">{{ $review->created_at->format('d M Y') }}</p>
                                                                <span>{{ $review->created_at->format('H:i') }}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .col-xl-4 {
            position: sticky;
            top: 10px; /* Ajuste selon l’espace nécessaire */
            height: fit-content;
        }
     </style>

</div>
@endsection
