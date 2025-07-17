@extends('backend.admin.layout.master')
@section('title') Tickets @endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Tous les Tickets</h2>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
            <div class="mb-2">
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_ticket" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Ajouter un nouveau ticket</a>
            </div>
            <div class="head-icons ms-2">
                <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                    <i class="ti ti-chevrons-up"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="row">
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 d-flex">
                            <div class="flex-fill">
                                <div class="border border-dashed border-primary rounded-circle d-inline-flex align-items-center justify-content-center p-1 mb-3">
                                    <span class="avatar avatar-lg avatar-rounded bg-primary-transparent "><i class="ti ti-ticket fs-20"></i></span>
                                </div>
                                <p class="fw-medium fs-12 mb-1">Nouveaux Tickets</p>
                                <h4>120</h4>
                            </div>
                        </div>
                        <div class="col-6 text-end d-flex">
                            <div class="d-flex flex-column justify-content-between align-items-end">
                                <span class="badge bg-transparent-purple d-inline-flex align-items-center mb-3">
                                    <i class="ti ti-arrow-wave-right-down me-1"></i>
                                    +19.01%
                                </span>
                                <div class="ticket-chart-1">8,5,6,3,4,6,7,3,8,6,4,7</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 d-flex">
                            <div class="flex-fill">
                                <div class="border border-dashed border-purple rounded-circle d-inline-flex align-items-center justify-content-center p-1 mb-3">
                                    <span class="avatar avatar-lg avatar-rounded bg-transparent-purple"><i class="ti ti-folder-open fs-20"></i></span>
                                </div>
                                <p class="fw-medium fs-12 mb-1">Tickets Ouverts</p>
                                <h4>60</h4>
                            </div>
                        </div>
                        <div class="col-6 text-end d-flex">
                            <div class="d-flex flex-column justify-content-between align-items-end">
                                <span class="badge bg-transparent-dark text-dark d-inline-flex align-items-center mb-3">
                                    <i class="ti ti-arrow-wave-right-down me-1"></i>
                                    +19.01%
                                </span>
                                <div class="ticket-chart-2">8,5,6,3,4,6,7,3,8,6,4,7</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 d-flex">
                            <div class="flex-fill">
                                <div class="border border-dashed border-success rounded-circle d-inline-flex align-items-center justify-content-center p-1 mb-3">
                                    <span class="avatar avatar-lg avatar-rounded bg-success-transparent"><i class="ti ti-checks fs-20"></i></span>
                                </div>
                                <p class="fw-medium fs-12 mb-1">Tickets Résolus</p>
                                <h4>50</h4>
                            </div>
                        </div>
                        <div class="col-6 text-end d-flex">
                            <div class="d-flex flex-column justify-content-between align-items-end">
                                <span class="badge bg-info-transparent d-inline-flex align-items-center mb-3">
                                    <i class="ti ti-arrow-wave-right-down me-1"></i>
                                    +19.01%
                                </span>
                                <div class="ticket-chart-3">8,5,6,3,4,6,7,3,8,6,4,7</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 d-flex">
                            <div class="flex-fill">
                                <div class="border border-dashed border-info rounded-circle d-inline-flex align-items-center justify-content-center p-1 mb-3">
                                    <span class="avatar avatar-lg avatar-rounded bg-info-transparent"><i class="ti ti-progress-alert fs-20"></i></span>
                                </div>
                                <p class="fw-medium fs-12 mb-1">Tickets En Cours</p>
                                <h4>10</h4>
                            </div>
                        </div>
                        <div class="col-6 text-end d-flex">
                            <div class="d-flex flex-column justify-content-between align-items-end">
                                <span class="badge bg-secondary-transparent d-inline-flex align-items-center mb-3">
                                    <i class="ti ti-arrow-wave-right-down me-1"></i>
                                    +19.01%
                                </span>
                                <div class="ticket-chart-4">8,5,6,3,4,6,7,3,8,6,4,7</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-9 col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                    <h5 class="text-info fw-medium">IT Support</h5>
                    <div class="d-flex align-items-center">
                        <span class="badge badge-danger d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>High</span>

                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <span class="badge badge-info rounded-pill mb-2">Tic - 001</span>
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="fw-semibold me-2"><a href="{{ route('admin.ticket.details') }}">Laptop Issue</a></h5>
                            <span class="badge bg-outline-pink d-flex align-items-center ms-1"><i class="ti ti-circle-filled fs-5 me-1"></i>Open</span>
                        </div>
                        <div class="d-flex align-items-center flex-wrap row-gap-2">
                            <p class="d-flex align-items-center mb-0 me-2">
                                <img src="{{ asset('assets/images/dev.png') }}" class="avatar avatar-xs rounded-circle me-2" alt="img"> Assigned to <span class="text-dark ms-1"> Edgar Hansel</span>
                            </p>
                            <p class="d-flex align-items-center mb-0 me-2"><i class="ti ti-calendar-bolt me-1"></i>Updated 10 hours ago</p>
                            <p class="d-flex align-items-center mb-0"><i class="ti ti-message-share me-1"></i>9 Comments</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                    <h5 class="text-info fw-medium">IT Support</h5>
                    <div class="d-flex align-items-center">
                        <span class="badge badge-success d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Low</span>

                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <span class="badge badge-info rounded-pill mb-2">Tic - 002</span>
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="fw-semibold me-2"><a href="{{ route('admin.ticket.details') }}">Payment Issue</a></h5>
                            <span class="badge bg-outline-warning d-flex align-items-center ms-1"><i class="ti ti-circle-filled fs-5 me-1"></i>On Hold</span>
                        </div>
                        <div class="d-flex align-items-center flex-wrap row-gap-2">
                            <p class="d-flex align-items-center mb-0 me-2">
                                <img src="{{ asset('assets/images/dev.png') }}" class="avatar avatar-xs rounded-circle me-2" alt="img"> Assigned to <span class="text-dark ms-1">Ann Lynch</span>
                            </p>
                            <p class="d-flex align-items-center mb-0 me-2"><i class="ti ti-calendar-bolt me-1"></i>Updated 15 hours ago</p>
                            <p class="d-flex align-items-center mb-0"><i class="ti ti-message-share me-1"></i>9 Comments</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                    <h5 class="text-info fw-medium">IT Support</h5>
                    <div class="d-flex align-items-center">
                        <span class="badge badge-warning d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Medium</span>

                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <span class="badge badge-info rounded-pill mb-2">Tic - 003</span>
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="fw-semibold me-2"><a href="{{ route('admin.ticket.details') }}">Bug Report</a></h5>
                            <span class="badge bg-outline-purple d-flex align-items-center ms-1"><i class="ti ti-circle-filled fs-5 me-1"></i>Reopened</span>
                        </div>
                        <div class="d-flex align-items-center flex-wrap row-gap-2">
                            <p class="d-flex align-items-center mb-0 me-2">
                                <img src="{{ asset('assets/images/dev.png') }}" class="avatar avatar-xs rounded-circle me-2" alt="img"> Assigned to <span class="text-dark ms-1">Juan Hermann</span>
                            </p>
                            <p class="d-flex align-items-center mb-0 me-2"><i class="ti ti-calendar-bolt me-1"></i>Updated 20 hours ago</p>
                            <p class="d-flex align-items-center mb-0"><i class="ti ti-message-share me-1"></i>9 Comments</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Catégories</h4>
                </div>
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between border-bottom p-3">
                            <a href="javascript:void(0);">Internet Issue</a>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-xs bg-dark rounded-circle">0</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom p-3">
                            <a href="javascript:void(0);">Computer</a>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-xs bg-dark rounded-circle">1</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom p-3">
                            <a href="javascript:void(0);">Redistribute</a>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-xs bg-dark rounded-circle">0</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom p-3">
                            <a href="javascript:void(0);">Payment</a>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-xs bg-dark rounded-circle">2</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3">
                            <a href="javascript:void(0);">Complaint</a>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-xs bg-dark rounded-circle">1</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
