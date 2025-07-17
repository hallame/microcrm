@extends('backend.admin.layout.master')
@section('title')  Détails Réservation @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.sites.reservations') }}">
                <i class="ti ti-arrow-left me-2"></i>Retour</a>
            </h6>
            <div class="d-flex">
                <div class="text-end">
                    {{-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_project"><i class="ti ti-edit me-1"></i>Modifier</a> --}}
                </div>
                <div class="head-icons ms-2 text-end">
                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                        <i class="ti ti-chevrons-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3 col-xl-4 theiaStickySidebar">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Détails de la réservation</h5>
                    <div class="list-group details-list-group mb-4">
                        <div class="list-group-item">
                            <span>Nom du Client: </span>
                            <p class="text-gray-9">
                                {{ $reservation->client ? $reservation->client->firstname . ' ' . $reservation->client->lastname : 'Créé par Admin' }}
                            </p>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center justify-content-between">
                                <span>Réservé le:</span>
                                <p class="text-gray-9">{{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center justify-content-between">
                                <span>Commence le: </span>
                                <p class="text-gray-9">{{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center justify-content-between">
                                <span>Termine le:</span>
                                <div class="d-flex align-items-center">
                                    <p class="text-gray-9 mb-0">{{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y à H:i') }} </p>
                                    {{-- <span class="badge badge-danger d-inline-flex align-items-center ms-2"><i class="ti ti-clock-stop"></i></span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center justify-content-between">
                                <span>Nombre de personnes: </span>
                                <p class="text-gray-9">{{ $reservation->number_of_people }}</p>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center justify-content-between">
                                <span>Langue: </span>
                                <p class="text-gray-9">{{ $reservation->language->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-9 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="bg-light rounded p-3 mb-3">
                        <div class="d-flex align-items-center bg-secondary-transparent">
                            <a class="flex-shrink-0 me-2"><i class="ti ti-map-pin text-primary fs-30"></i></a>
                            <div>
                                <h6 class="mb-1">
                                    @if ($reservation->site)
                                        Site : {{ $reservation->site->name }}
                                    @elseif ($reservation->circuit)
                                        Circuit : {{ $reservation->circuit->name }}
                                    @else
                                        Lieu : N/A
                                    @endif
                                </h6>

                                <p>Identifiant : <span class="text-primary"> {{ $reservation->identifier }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-sm-3">
                            <p class="d-flex align-items-center mb-3"><i class="ti ti-square-rounded me-2"></i>Status</p>
                        </div>
                        <div class="col-sm-9">
                            <span class="badge {{ $reservation->status_label['class'] }} d-inline-flex align-items-center mb-3">
                                <i class="{{ $reservation->status_label['icon'] }} me-1"></i>
                                {{ $reservation->status_label['text'] }}
                            </span>
                        </div>

                        <div class="col-sm-3">
                            <p class="d-flex align-items-center mb-3"><i class="ti ti-bookmark me-2"></i>Catégorie</p>
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex align-items-center mb-3">
                                {{-- <a href="#" class="badge task-tag bg-pink rounded-pill me-2">{{ $reservation->category->name }}</a> --}}
                                <a class="badge task-tag badge-info rounded-pill">{{ $reservation->site->category->name ?? "Non définie" }}</a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="bg-soft-secondary p-3 rounded d-flex align-items-center justify-content-between">
                                <p class="text-secondary mb-0">Note: </p>
                                <span class="text-secondary fs-16">{!! $reservation->note ?? 'Pas d\'info supplémentaire' !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
