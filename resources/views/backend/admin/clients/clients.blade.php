@extends('backend.admin.layout.master')
@section('title') Clients @endsection
@section('content')
<!-- Breadcrumb -->
{{-- <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1">Gestion Clients</h2>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="#" data-bs-toggle="modal" data-bs-target="#add_client" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Ajouter nouveau client</a>
        </div>
        <div class="ms-2 head-icons">
            <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                <i class="ti ti-chevrons-up"></i>
            </a>
        </div>
    </div>
</div> --}}
<!-- /Breadcrumb -->
<!-- Clients Info -->
<div class="row">
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
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Total des Clients</p>
                            <h4>{{ $totalClients }}</h4>
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
                                <i class="ti ti-user-share fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Clients Actifs</p>
                            <h4>{{ $activeClients }}</h4>
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
                                <i class="ti ti-user-pause fs-18"></i>
                            </span>
                        </div>
                        <div>
                            <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Clients Inactifs</p>
                            <h4>{{ $inactiveClients }}</h4>
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
                        {{-- <div class="flex-shrink-0 me-2">
                            <span class="p-2 br-10 bg-info-transparent border border-info d-flex align-items-center justify-content-center">
                                <i class="ti ti-user-plus fs-18"></i>
                            </span>
                        </div> --}}
                        <div>
                            {{-- <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Nouveaux Clients</p>
                            <h4>{{ $newClients }}</h4> --}}
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_client" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Ajouter un client</a>
                        </div>
                    </div>
                    {{-- @php
                        $isPositive = $growthRate > 0;
                    @endphp
                    @if($growthRate !== 0)
                        <span class="badge bg-transparent-secondary
                            {{ $isPositive ? 'text-success' : 'text-danger' }} d-inline-flex align-items-center fw-normal">
                                <i class="ti {{ $isPositive ? 'ti-arrow-wave-right-up' : 'ti-arrow-wave-right-down' }} me-1"></i>
                            {{ $isPositive ? '+' : '' }}{{ number_format($growthRate, 2) }}%
                        </span>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Clients Info -->


    <!-- Clients list -->
    @if ($clients->count() > 0)
        <div class="card">
            <div class="card-body p-0">
                <div class="custom-datatable-filter table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Nom Complet</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Ville/Pays</th>
                                <th>Status</th>
                                <th>Compagnie</th>
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($clients as $client)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center file-name-icon">
                                            <a href="{{ route('admin.client.details', ['client' => $client]) }}" class="avatar avatar-md border avatar-rounded">
                                                <img src="{{ asset($client->profile_image ?? 'assets/images/client.png') }}" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium">
                                                    <a href="{{ route('admin.client.details', ['client' => $client]) }}">
                                                        {{ $client->firstname }} {{ $client->lastname }}
                                                    </a>
                                                </h6>
                                                <span class="fs-12 fw-normal">{{ $client->position ?? 'Poste Non spécifié' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $client->phone ?? 'N/A' }}</td>
                                    <td>{{ $client->email ?? 'N/A' }}</td>

                                    </td>
                                    <td>
                                        {{ $client->city ?? '--' }} {{ $client->country ?? '--' }}
                                    </td>
                                    <td>
                                        <span class="badge {{ $client->status ? 'badge-success' : 'badge-danger' }} d-inline-flex align-items-center badge-xs">
                                            <i class="ti ti-point-filled me-1"></i>
                                            {{ $client->status ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </td>
                                    <td>{{ $client->company ?? '---' }}</td>

                                    {{-- <td>
                                        <div class="action-icon d-inline-flex">
                                            <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_client">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </div>
                                    </td> --}}
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
    <!-- /Clients list -->

@endsection
