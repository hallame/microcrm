@extends('backend.admin.layout.master')
@section('title') Maintenance @endsection
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
                        <a href="{{ route('admin.settings.email') }}" class="d-inline-flex align-items-center rounded py-2 px-3">Paramètres Email</a>
                        <a href="{{ route('admin.settings.maintenance') }}" class="d-inline-flex align-items-center active rounded py-2 px-3"><i class="ti ti-arrow-badge-right me-2"></i>Maintenance</a>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="border-bottom mb-3 pb-3">
                        <h4>Mode Maintenance</h4>
                    </div>
                    <form action="gdpr.html">
                        <div class="border-bottom mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <h6 class="fw-medium">Image</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center flex-wrap row-gap-3 w-100 rounded mb-4">
                                                    {{-- <div class="d-flex align-items-center justify-content-center og-upload rounded border border-dashed me-2 flex-shrink-0 text-dark frames">
                                                        <i class="ti ti-photo text-gray-3 fs-16"></i>
                                                    </div> --}}
                                                    <div class="input-block mb-3 row">
                                                        <div class="col-lg-12">
                                                            <input type="file" class="form-control">
                                                            <span class="form-text text-muted">Taille recommandée:600x400</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <h6 class="fw-medium">Description</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <div class="summernote">
                                                    {{-- <textarea name="" id="" cols="60" rows="3"></textarea> --}}
                                                    <p>Ecrivez votre message ici ...</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <h6 class="fw-medium">Status</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input mb-3" type="checkbox" role="switch">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <button type="button" class="btn btn-outline-light border me-3">Annuler</button>
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
