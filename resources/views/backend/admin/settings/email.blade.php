@extends('backend.admin.layout.master')
@section('title') Email @endsection
@section('content')
    <!-- Breadcrumb -->
    {{-- <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Paramètres</h2>
        </div>
        <div class="head-icons ms-2">
            <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                <i class="ti ti-chevrons-up"></i>
            </a>
        </div>
    </div> --}}
    <!-- /Breadcrumb -->
    <div class="row">
        {{-- <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column list-group settings-list">
                        <a href="{{ route('admin.settings.email') }}" class="d-inline-flex align-items-center rounded active py-2 px-3"><i class="ti ti-arrow-badge-right me-2"></i>Paramètres Email</a>
                        <a href="{{ route('admin.settings.maintenance') }}" class="d-inline-flex align-items-center rounded py-2 px-3">Mode Maintenance</a>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="border-bottom mb-3 pb-3">
                        <h4>Configuration Email</h4>
                    </div>
                    <form action="email-settings.html">
                        <div class="border-bottom mb-3">
                            <div class="row">

                            </div>
                            <div class="row">
                                <div class="col-md-6 d-flex">
                                    <div class="card flex-fill">
                                        <div class="card-body">
                                            <div class="border-bottom pb-3 mb-3">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-xl p-2 me-2 bg-light flex-shrink-0">
                                                            <img src="{{ asset('assets/back/img/settings/phpmail.svg') }}" alt="Profile">
                                                        </span>
                                                        <h5>PHP Mailer</h5>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
                                                    </div>
                                                </div>
                                                <p>Permet d'envoyer des mails facilement et en toute sécurité via le code PHP à partir du serveur First TIA..</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="btn btn-sm d-inline-flex align-items-center btn-dark">
                                                    <i class="ti ti-checks me-1"></i>Non connecté
                                                </span>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#phpmailersettings" class="btn btn-icon btn-sm text-gray-5 fs-20"><i class="ti ti-settings"></i></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card flex-fill">
                                        <div class="card-body">
                                            <div class="border-bottom pb-3 mb-3">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-xl me-2 p-2 bg-light flex-shrink-0">
                                                            <img src="{{ asset('assets/back/img/settings/smtp.svg') }}" alt="Profile">
                                                        </span>
                                                        <h5>SMTP</h5>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                                    </div>
                                                </div>
                                                <p>Le protocole SMTP est utilisé pour envoyer, relayer ou transférer des messages à partir d'une API de messagerie.</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="btn btn-sm d-inline-flex align-items-center btn-light">
                                                    <i class="ti ti-checks me-1"></i>Connecté
                                                </span>
                                                <a href="#"  data-bs-toggle="modal" data-bs-target="#smtpsettings" class="btn btn-icon btn-sm text-gray-5 fs-20"><i class="ti ti-settings"></i></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
