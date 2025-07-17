@extends('backend.admin.layout.master')
@section('title') Tableau de bord @endsection
@section('content')

    <!-- Welcome Wrap -->
    <div class="welcome-wrap mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div class="mb-3">
                <h2 class="mb-1 text-white">Bienvenue à bord, {{ session('admin.username') }} !</h2>
            </div>
            <div class="d-flex align-items-center flex-wrap mb-1">
                <!-- Bouton Ajouter un Site -->
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_site" class="btn btn-dark btn-md me-2 mb-2">
                    <i class="ti ti-circle-plus me-2"></i>Ajouter un Site
                </a>
                <!-- Bouton Ajouter une Réservation -->
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_reservation" class="btn btn-light btn-md mb-2">
                    <i class="ti ti-calendar me-2"></i>Ajouter une Réservation
                </a>
            </div>
        </div>
        <div class="welcome-bg">
            <img src="{{ asset('assets/back/img/bg/welcome-bg-02.svg') }}" alt="img" class="welcome-bg-01">
            <img src="{{ asset('assets/back/img/bg/welcome-bg-03.svg') }}" alt="img" class="welcome-bg-02">
            <img src="{{ asset('assets/back/img/bg/welcome-bg-01.svg') }}" alt="img" class="welcome-bg-03">
        </div>
    </div>
    <!-- /Welcome Wrap -->
    <div class="row">
        <!-- Total des Sites -->
        <div class="col-xl-3 col-md-6">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-md br-10 icon-rotate bg-primary flex-shrink-0">
                            <span class="d-flex align-items-center"><i class="ti ti-map-pin text-white fs-16"></i></span>
                        </div>
                        <div class="ms-3">
                            <p class="fw-medium text-truncate mb-1">Sites</p>
                            <h5>{{ $totalSites }}</h5>
                        </div>
                    </div>
                    {{-- <div class="progress progress-xs mb-2">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $totalSitesPercent }}%"></div>
                    </div> --}}
                    <span class="position-absolute top-0 end-0"><img src="{{ asset('assets/back/img/bg/card-bg-04.png') }}" alt="Img"></span>
                </div>
            </div>
        </div>

        <!-- Total des Réservations -->
        <div class="col-xl-3 col-md-6">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-md br-10 icon-rotate bg-secondary flex-shrink-0">
                            <span class="d-flex align-items-center"><i class="ti ti-calendar-check text-white fs-16"></i></span>
                        </div>
                        <div class="ms-3">
                            <p class="fw-medium text-truncate mb-1">Réservations</p>
                            <h5>{{ $totalReservations }}</h5>
                        </div>
                    </div>
                    {{-- <div class="progress progress-xs mb-2">
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $totalReservationsPercent }}%"></div>
                    </div> --}}
                    <span class="position-absolute top-0 end-0"><img src="{{ asset('assets/back/img/bg/card-bg-04.png') }}" alt="Img"></span>
                </div>
            </div>
        </div>

        <!-- Total des Clients -->
        <div class="col-xl-3 col-md-6">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-md br-10 icon-rotate bg-danger flex-shrink-0">
                            <span class="d-flex align-items-center"><i class="ti ti-users-group text-white fs-16"></i></span>
                        </div>
                        <div class="ms-3">
                            <p class="fw-medium text-truncate mb-1">Clients</p>
                            <h5>{{ $totalClients }}</h5>
                        </div>
                    </div>
                    {{-- <div class="progress progress-xs mb-2">
                        <div class="progress-bar bg-pink" role="progressbar" style="width: {{ $totalClientsPercent }}%"></div>
                    </div> --}}
                    <span class="position-absolute top-0 end-0"><img src="{{ asset('assets/back/img/bg/card-bg-04.png') }}" alt="Img"></span>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">

                        <div class="avatar avatar-md br-10 icon-rotate bg-info flex-shrink-0">
                            <span class="d-flex align-items-center">
                                <i class="ti ti-calendar-event text-white fs-16"></i>
                            </span>
                        </div>

                        <div class="ms-3">
                            <p class="fw-medium text-truncate mb-1">Événements</p>
                            <h5>{{ $totalEvents }}</h5>
                        </div>
                    </div>
                    {{-- <div class="progress progress-xs mb-2">
                        <div class="progress-bar bg-purple" role="progressbar" style="width: {{ $totalGuidesPercent }}%"></div>
                    </div> --}}
                    <span class="position-absolute top-0 end-0"><img src="{{ asset('assets/back/img/bg/card-bg-04.png') }}" alt="Img"></span>
                </div>
            </div>
        </div>

        <!-- Total des Guides -->
        {{-- <div class="col-xl-2 col-md-4">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-md br-10 icon-rotate bg-purple flex-shrink-0">
                            <span class="d-flex align-items-center"><i class="ti ti-headset  text-white fs-16"></i></span>
                        </div>
                        <div class="ms-3">
                            <p class="fw-medium text-truncate mb-1">Guides</p>
                            <h5>{{ $totalGuides }}</h5>
                        </div>
                    </div>

                    <span class="position-absolute top-0 end-0"><img src="{{ asset('assets/back/img/bg/card-bg-04.png') }}" alt="Img"></span>
                </div>
            </div>
        </div> --}}

        {{-- <!-- Total des Guides -->
        <div class="col-xl-2 col-md-4">
            <div class="card position-relative">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-md br-10 icon-rotate bg-purple flex-shrink-0">
                            <span class="d-flex align-items-center"><i class="ti ti-user-star  text-white fs-16"></i></span>
                        </div>
                        <div class="ms-3">
                            <p class="fw-medium fs-10 text-truncate mb-1">Partenaires</p>
                            <h5>{{ $totalPartners }}</h5>
                        </div>
                    </div>

                    <span class="position-absolute top-0 end-0"><img src="{{ asset('assets/back/img/bg/card-bg-04.png') }}" alt="Img"></span>
                </div>
            </div>
        </div> --}}

    </div>
    <div class="row">
        <div class="col-xl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                        <h5>Dernières Réservations</h5>
                        <div>
                            <a href="{{ route('admin.sites.reservations') }}" class="btn btn-sm btn-primary px-3">Voir tout</a>
                        </div>
                    </div>
                </div>
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
                                        <th>Site Réservé</th>
                                        <th>Date prévue</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations->display as $reservation)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('admin.client.details', ['client' => $reservation->client]) }}">
                                                    {{ $reservation->client->firstname }} {{ $reservation->client->lastname }}
                                                </a>

                                            </td>
                                            <td>{{ $reservation->site->name ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') }}</td>
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
                                                <a href="{{ route('admin.sites.reservation.details', $reservation->id) }}" class="btn btn-sm btn-info">Détails</a>
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
    <div class="row">
        <div class="col-xl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                        <h5>Sites touristiques</h5>
                        <div>
                            <a href="{{ route('admin.sites') }}" class="btn btn-sm btn-primary px-3">Voir tout</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        @if($sites->isEmpty())
                        @include('partials.empty')
                        @else
                            @foreach ($sites->display as $site)
                                @php
                                    $borderClasses = ['border-primary', 'border-info', 'border-success', 'border-danger', 'border-dark'];
                                    $bgClasses = ['bg-primary', 'bg-info', 'bg-success', 'bg-danger', 'bg-dark'];

                                    $randomBorder = $borderClasses[array_rand($borderClasses)];
                                    $randomBg = $bgClasses[array_rand($bgClasses)];
                                @endphp

                                <div class="border border-dashed bg-body-secondary rounded p-2 mb-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="d-block border border-3 h-12 {{ $randomBorder }} rounded-5 me-2" style="height: 50px;"></span>
                                            <div>
                                                {{-- <h6 class="fw-medium mb-1">{{ Str::limit($site->name, 50) }}</h6> --}}
                                                <h6 class="fw-medium mb-1 text-truncate">{{ Str::limit($site->name, 50) }} - {{ Str::limit($site->city, 50) }} {{ Str::limit($site->country->name ?? '--', 50) }}</h6>
                                                <p>
                                                    Ajouté le: {{ \Carbon\Carbon::parse($site->created_at)->format('d/m/Y') }} -
                                                    Modifié le: {{ \Carbon\Carbon::parse($site->updated_at)->format('d/m/Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="circle-border {{ $randomBg }} d-flex justify-content-center align-items-center"
                                                style="width: 40px; height: 40px; border-radius: 50%; font-size: 14px;">
                                                <div class="text-black text-bold circle-border bg-body d-flex justify-content-center align-items-center"
                                                    style="width: 37px; height: 37px; border-radius: 50%; font-size: 14px; font-weight: 600">
                                                    {{ $site->views()->count() }}
                                                </div>
                                            </div>
                                            <span class="ms-2">Vues</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @php
            use Carbon\Carbon;
        @endphp
        <div class="col-xl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <h5 class="mb-0">Derniers Événements</h5>
                        @if ($events->count())
                            <a href="{{ route('admin.events') }}" class="btn btn-sm btn-primary">Voir tout</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if ($events->count())
                        @foreach ($events->display as $event)
                            @php
                                $today = Carbon::today();
                                $start = Carbon::parse($event->start_date);
                                $end = Carbon::parse($event->end_date);

                                // Déterminer le statut de l'événement
                                if ($end->isPast()) {
                                    $status = "Passé";
                                    $bgColor = "bg-purple"; // Gris
                                } elseif ($start->isFuture()) {
                                    $status = "À venir";
                                    $bgColor = "bg-secondary";
                                } else {
                                    $status = "En cours";
                                    $bgColor = "bg-success"; // Vert
                                }

                            @endphp

                            <div class="d-flex align-items-center justify-content-between mb-2 p-2 rounded shadow-sm {{ $bgColor }} text-white">
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('admin.events') }}" class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/images/event.png') }}" class="rounded-circle border border-2" alt="Événement">
                                    </a>
                                    <div class="ms-3">
                                        <h6 class="fs-14 fw-bold text-truncate mb-1">
                                            <a href="{{ route('admin.events') }}" class="text-white text-decoration-none">
                                                {{ $event->name }}
                                            </a>
                                            @if ($event->category)
                                                <span class="badge bg-dark">{{ $event->category->name }}</span>
                                            @endif
                                        </h6>
                                        <p class="fs-13 mb-0">
                                            📅 Du <strong>{{ $start->format('d/m/Y') }}</strong> au <strong>{{ $end->format('d/m/Y') }}</strong>    <span class="badge bg-primary">{{ $status }}</span>
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="d-flex align-items-center">
                                    <span class="fw-bold fs-20">
                                        <i class="ti ti-user-check fs-20"></i>
                                        {{ $event->reservations->count() }}</span>
                                </div> --}}
                                 <div class="d-flex align-items-center">
                                    <span class="fw-bold fs-20">
                                        <i class="ti ti-eye fs-20"></i>
                                        {{ $event->views()->count() }}</span>
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

    <div class="row">
        <div class="col-xl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                    <h5>Nouveaux Clients</h5>
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="{{ route('admin.clients') }}" class="btn btn-md btn-primary px-3">Voir tout</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        @if($clients->isEmpty())
                        @include('partials.empty')
                        @else
                            <table class="table table-nowrap dashboard-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom du client</th>
                                        <th>Téléphone</th>
                                        <th>Email</th>
                                        <th>Ville/Pays</th>
                                        {{-- <th>Statut</th> --}}
                                        <th>Inscrit le</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients->display as $client)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <h6 class="fw-medium">
                                                            <a href="{{ route('admin.client.details', ['client' => $client]) }}">
                                                                {{ $client->firstname }} {{ $client->lastname }}
                                                            </a>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center file-name-icon">
                                                        <div class="ms-2">
                                                            <h6 class="fw-medium">{{ $client->phone }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $client->email }}
                                                </td>
                                                <td>
                                                    {{ $client->city ?? '--' }} {{ $client->country ?? '--' }}
                                                </td>

                                                {{-- <td>
                                                    @if ($client->status == 1)
                                                        <span class="badge bg-success text-white">Actif</span>
                                                    @else
                                                        <span class="badge bg-danger text-white">Inactif</span>
                                                    @endif
                                                </td> --}}
                                                    <td>{{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}</td>
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

    <div class="row">
        <div class="col-xl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <h5>Partenaires</h5>
                        <div>
                            <a href="{{ route('admin.partners') }}" class="btn btn-sm btn-primary px-3">Voir Tout</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        @if ($partners->isNotEmpty())
                            @foreach ($partners->display as $partner)
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                            <img src="{{ asset('assets/images/senior.png') }}" class="rounded-circle border border-2" alt="img">
                                        </a>
                                        <div class="ms-2">
                                            <h6 class="fs-14 fw-medium text-truncate mb-1">
                                                <a >{{ $partner->company ?? 'Non-fournie' }}</a>
                                            </h6>
                                            {{-- <p class="fs-13">{{ $partner->company ?? 'Non-fournie' }} --}}
                                            <span class="badge {{ $partner->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $partner->status == 1 ? 'Actif' : 'Inactif' }}
                                            </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="tel:{{ $partner->phone }}" class="btn text-success btn-icon btn-sm me-2">
                                            <i class="ti ti-phone fs-16"></i>
                                        </a>
                                        <a href="mailto:{{ $partner->email }}" class="btn text-secondary btn-icon btn-sm me-2">
                                            <i class="ti ti-mail-bolt fs-16"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        @include('partials.empty')
                        @endif
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <h5>Guides Touristiques</h5>
                        <div>
                            <a href="{{ route('admin.guides') }}" class="btn btn-sm btn-primary px-3">Voir Tout</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        @if ($guides->isNotEmpty())
                            @foreach ($guides->display as $guide)
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                            <img src="{{ asset('assets/images/dev.png') }}" class="rounded-circle border border-2" alt="img">
                                        </a>
                                        <div class="ms-2">
                                            <h6 class="fs-14 fw-medium text-truncate mb-1">
                                                <a href="#">{{ $guide->firstname }} {{ $guide->lastname }}</a>
                                            </h6>
                                            <p class="fs-13">{{ $guide->city ?? '' }} {{ $guide->country ?? '' }} -
                                            <span class="badge {{ $guide->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $guide->status == 1 ? 'Actif' : 'Inactif' }}
                                            </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="tel:{{ $guide->phone }}" class="btn text-success btn-icon btn-sm me-2">
                                            <i class="ti ti-phone fs-16"></i>
                                        </a>
                                        <a href="mailto:{{ $guide->email }}" class="btn text-secondary btn-icon btn-sm me-2">
                                            <i class="ti ti-mail-bolt fs-16"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        @include('partials.empty')
                        @endif
                </div>
            </div>
        </div> --}}

        <div class="col-xl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                        <h5>Statistiques Réservations</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div id="reservations"></div>
                    <div>
                        <h6 class="mb-3">Reservations</h6>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <p class="f-13 mb-0"><i class="ti ti-circle-filled text-success me-1"></i>Confirmés</p>
                            <p class="f-13 fw-medium text-gray-9">{{ $confirmedReservationsPercent }}%</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <p class="f-13 mb-0"><i class="ti ti-circle-filled text-warning me-1"></i>En Attente</p>
                            <p class="f-13 fw-medium text-gray-9">{{ $pendingReservationsPercent }}%</p>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <p class="f-13 mb-0"><i class="ti ti-circle-filled text-danger me-1"></i>Annulés</p>
                            <p class="f-13 fw-medium text-gray-9">{{ $canceledReservationsPercent }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Add Site -->
<div class="modal fade" id="add_site">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un nouveau site touristique</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
           <form action="{{ route('admin.site.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body pb-0">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du site <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Grotte sacrée de Kouankan" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="location" class="form-label">Emplacement <span class="text-danger">*</span></label>
                        <input type="text" id="location" name="location" class="form-control" placeholder="Ex: Route de Macenta, km 15" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="city" class="form-label">Ville <span class="text-danger">*</span></label>
                        <input type="text" id="city" name="city" class="form-control" placeholder="Ex: N'zérékoré" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="district" class="form-label">Quartier / District / Village  <span class="text-danger">*</span></label>
                        <input type="text" id="district" name="district" required class="form-control" placeholder="Ex: Kouankan">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="country_id" class="form-label">Pays <span class="text-danger">*</span></label>
                        <select name="country_id" id="country_id" class="form-control" required>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $country->id == 1 ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Catégorie</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">-- Sélectionner une catégorie --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="language_id" class="form-label">Langue <span class="text-danger">*</span></label>
                        <select name="language_id" id="language_id" class="form-control" required>
                            @foreach($languages as $lang)
                                <option value="{{ $lang->id }}" {{ $lang->id == 1 ? 'selected' : '' }}>{{ $lang->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image principale  <span class="text-danger">*</span></label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="accessibility" class="form-label">Accessibilité  <span class="text-danger">*</span></label>
                        <textarea name="accessibility" id="accessibility" required class="form-control" rows="3" placeholder="Description de l’accès, distance, moyens de transport..."></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="history" class="form-label">Histoire (facultatif)</label>
                        <textarea name="history" id="history" class="form-control" rows="3" placeholder="Brève histoire ou contexte du site"></textarea>
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
                        <input type="url" name="video_url" id="video_url" class="form-control" placeholder="Lien vers la vidéo">
                        <small class="form-text text-muted">Si vous préférez ajouter un lien vidéo (YouTube, Vimeo, etc.), entrez-le ici</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="map_url" class="form-label">Lien vers la carte (Google Maps)</label>
                        <input type="url" id="map_url" name="map_url" class="form-control" placeholder="https://maps.google.com/...">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="info" class="form-label">Info sur le prix</label>
                        <input type="text" id="info" name="info" class="form-control" placeholder="Ex: 10€/Individu">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="form-control" placeholder="************">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="form-control" placeholder="************">
                    </div>
                </div>
                {{-- <div id="map" class="h-64 w-full rounded-xl shadow mb-3" ></div> --}}

                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary mb-3">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
        </div>
    </div>
</div>
<!-- /Add Site -->


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
                </form>

            </div>
        </div>
    </div>
    <!-- /Add Reservation -->



    <script>
        window.chartLabels = ['Confirmés', 'En Attente', 'Annulés'];
        window.chartData = {!! json_encode([
            $confirmedReservations ?? 0,
            $pendingReservations ?? 0,
            $canceledReservations ?? 0
        ]) !!};
        window.chartDatasetLabel = {!! json_encode($totalReservations ?? 0) !!};
    </script>

@endsection

