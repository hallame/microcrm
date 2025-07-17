@extends('backend.admin.layout.master')
@section('title') Expert Détails @endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
        <div class="my-auto mb-2">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0">
                <a href="{{ route('admin.experts') }}"><i class="ti ti-arrow-left me-2"></i>Retour</a>
            </h6>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
            {{-- <div class="mb-2">
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_bank_satutory" class="btn btn-primary d-flex align-items-center">
                    <i class="ti ti-circle-plus me-2"></i>Finance & Conformité
                </a>
            </div> --}}
            <div class="head-icons ms-2">
                <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                    <i class="ti ti-chevrons-up"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card card-bg-1">
                <div class="card-body p-0">
                    <span class="avatar avatar-xl avatar-rounded border border-2 border-white m-auto d-flex mb-2">
                        <img src="{{ asset('/assets/images/dev.png') }}" class="w-auto h-auto" alt="Img">
                    </span>
                    <div class="text-center px-3 pb-3 border-bottom">
                        <div class="mb-3">
                            <h5 class="d-flex align-items-center justify-content-center mb-1">{{ $expert->firstname }} {{ $expert->lastname }}<i class="ti ti-discount-check-filled text-success ms-1"></i></h5>
                            <span class="badge badge-soft-dark fw-medium me-2">
                                <i class="ti ti-point-filled me-1"></i>{{ $expert->profession }}
                            </span>
                            <span class="badge badge-soft-secondary fw-medium">{{ $expert->experience_years }}+ ans d'expérience</span>
                        </div>
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center">
                                    <i class="ti ti-id me-2"></i>
                                    Expert ID
                                </span>
                                <p class="text-dark">EXP{{ str_pad($expert->id, 3, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            @if ($expert->teams->count() > 0)
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="d-inline-flex align-items-center">
                                        <i class="ti ti-star me-2"></i>
                                        Équipes
                                    </span>
                                    <p class="text-dark"> |
                                        @foreach ($expert->teams as $team)
                                           {{ $team->name }} |
                                        @endforeach
                                    </p>
                                </div>
                            @endif
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center">
                                    <i class="ti ti-calendar-check me-2"></i>
                                    Inscrit
                                </span>
                                <p class="text-dark">{{ \Carbon\Carbon::parse($expert->created_at)->format('d/m/Y') }}</p>
                            </div>

                            <div class="row gx-2 mt-3">
                                @if (!empty($expert->phone))
                                    <div class="col-6">
                                        <div>
                                            <a href="tel:{{ $expert->phone }}" class="btn btn-dark w-100">
                                                <i class="ti ti-phone-call me-1"></i> Appeler
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                <div class="{{ empty($expert->phone) ? 'col-12' : 'col-6' }}">
                                    <div>
                                        <a href="mailto:{{ $expert->email }}" class="btn btn-primary w-100">
                                            <i class="ti ti-message-heart me-1"></i> Écrire
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 border-bottom">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6>Informations Personnelles</h6>
                            {{-- <a href="javascript:void(0);" class="btn btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#edit_employee"><i class="ti ti-edit"></i></a> --}}
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="d-inline-flex align-items-center">
                                <i class="ti ti-phone me-2"></i> Téléphone
                            </span>
                            <p class="text-dark">{{ $expert->phone }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="d-inline-flex align-items-center">
                                <i class="ti ti-mail-check me-2"></i>
                                Email
                            </span>
                            <a href="mailto:{{ $expert->email }}" class="text-info d-inline-flex align-items-center">{{ $expert->email }}</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="d-inline-flex align-items-center">
                                <i class="ti ti-gender-male me-2"></i> Genre
                            </span>
                            <p class="text-dark text-end">{{ $expert->gender ?? '-' }}</p>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="d-inline-flex align-items-center">
                                <i class="ti ti-map-pin-check me-2"></i> Adresse
                            </span>
                            <p class="text-dark text-end">{{ $expert->address ?? '-' }}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="d-inline-flex align-items-center">
                                <i class="ti ti-flag me-2"></i> Nationalité
                            </span>
                            <p class="text-dark text-end">{{ $expert->contry ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h6>Équipes de {{ $expert->firstname }} {{ substr($expert->lastname, 0, 1) }}.</h6>
                {{-- <a href="javascript:void(0);" class="btn btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#edit_emergency">
                    <i class="ti ti-edit"></i>
                </a> --}}
            </div>
            <div class="card">
                <div class="card-body p-0">
                    @if ($expert->teams->count() > 0)
                        @foreach ($expert->teams as $team)
                            <div class="p-3 border-bottom">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="d-inline-flex align-items-center">
                                            {{ $team->name }}
                                        </span>
                                        <h6 class="d-flex align-items-center fw-medium mt-1">Rôle:  <span class="d-inline-flex mx-1">{{ $team->pivot->role }}</span></h6>
                                    </div>
                                    <p class="text-dark">{{ $team->experts->count() }} Membres</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <span class="d-flex align-items-center p-2 border-bottom"><i class="ti ti-point-filled text-danger"></i>N'appartient à aucune équipe</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div>
                <div class="tab-content custom-accordion-items">
                    <div class="tab-pane active show" id="bottom-justified-tab1" role="tabpanel">
                        <div class="accordion accordions-items-seperate" id="accordionExample">
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingOne">
                                    <div class="accordion-button">
                                        <div class="d-flex align-items-center flex-fill">
                                            <h5>Présentation</h5>
                                            {{-- <a href="#" class="btn btn-sm btn-icon ms-auto" data-bs-toggle="modal" data-bs-target="#edit_employee"><i class="ti ti-edit"></i></a> --}}
                                            <a href="#" class="d-flex align-items-center collapsed collapse-arrow" data-bs-toggle="collapse" data-bs-target="#primaryBorderOne" aria-expanded="false" aria-controls="primaryBorderOne">
                                                <i class="ti ti-chevron-down fs-18"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="primaryBorderOne" class="accordion-collapse collapse show border-top" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body mt-2">{!! $expert->bio !!}</div>
                                </div>
                            </div>
                            {{-- <div class="accordion-item">
                                <div class="accordion-header" id="headingTwo">
                                    <div class="accordion-button">
                                        <div class="d-flex align-items-center flex-fill">
                                            <h5>Informations de paiements</h5>
                                            <a href="#" class="btn btn-sm btn-icon ms-auto" data-bs-toggle="modal" data-bs-target="#edit_bank"><i class="ti ti-edit"></i></a>
                                            <a href="#" class="d-flex align-items-center collapsed collapse-arrow"  data-bs-toggle="collapse" data-bs-target="#primaryBorderTwo" aria-expanded="false" aria-controls="primaryBorderTwo">
                                                <i class="ti ti-chevron-down fs-18"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="primaryBorderTwo" class="accordion-collapse collapse border-top" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <span class="d-inline-flex align-items-center">
                                                    Moyens de paiement
                                                </span>
                                                <h6 class="d-flex align-items-center fw-medium mt-1">MOBILE MONEY</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="d-inline-flex align-items-center">
                                                    Numéro de compte
                                                </span>
                                                <h6 class="d-flex align-items-center fw-medium mt-1">{{ $expert->phone }}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="d-inline-flex align-items-center">
                                                    Nom de Compte
                                                </span>
                                                <h6 class="d-flex align-items-center fw-medium mt-1">{{ $expert->lastname }} {{ $expert->firstname }}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="d-inline-flex align-items-center">
                                                    Pays
                                                </span>
                                                <h6 class="d-flex align-items-center fw-medium mt-1">{{ $expert->country ?? '-' }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="accordion-item">
                                        <div class="row">
                                            <div class="accordion-header" id="headingFour">
                                                <div class="accordion-button">
                                                    <div class="d-flex align-items-center justify-content-between flex-fill">
                                                        <h5>Formations</h5>
                                                        <div class="d-flex">
                                                            <a href="#" class="btn btn-icon btn-sm"  data-bs-toggle="modal" data-bs-target="#edit_education"><i class="ti ti-edit"></i></a>
                                                            <a href="#" class="d-flex align-items-center collapsed collapse-arrow" data-bs-toggle="collapse" data-bs-target="#primaryBorderFour" aria-expanded="false" aria-controls="primaryBorderFour">
                                                                <i class="ti ti-chevron-down fs-18"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="primaryBorderFour" class="accordion-collapse collapse border-top" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div>
                                                        <div class="mb-3">
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div>
                                                                    <span class="d-inline-flex align-items-center fw-normal">
                                                                        {{ $expert->institution ?? '-- Établissement --'}}
                                                                    </span>
                                                                    <h6 class="d-flex align-items-center mt-1"> {{ $expert->institution ?? '-- Titre --'}}</h6>
                                                                </div>
                                                                <p class="text-dark"> {{ $expert->intervale ?? 'De ... À ....'}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="accordion-item">
                                        <div class="row">
                                            <div class="accordion-header" id="headingFive">
                                                <div class="accordion-button collapsed">
                                                    <div class="d-flex align-items-center justify-content-between flex-fill">
                                                        <h5>Expériences</h5>
                                                        <div class="d-flex">
                                                            <a href="#" class="btn btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#edit_experience"><i class="ti ti-edit"></i></a>
                                                            <a href="#" class="d-flex align-items-center collapsed collapse-arrow" data-bs-toggle="collapse" data-bs-target="#primaryBorderFive" aria-expanded="false" aria-controls="primaryBorderFive">
                                                                <i class="ti ti-chevron-down fs-18"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="primaryBorderFive" class="accordion-collapse collapse border-top" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div>
                                                        <div class="mb-3">
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div>
                                                                    <h6 class="d-inline-flex align-items-center fw-medium">
                                                                        {{ $expert->intervale ?? '--  Structure --'}}
                                                                    </h6>
                                                                    <span class="d-flex align-items-center badge bg-secondary-transparent mt-1"><i class="ti ti-point-filled me-1"></i>{{ $expert->intervale ?? '--  Poste --'}}</span>
                                                                </div>
                                                                <p class="text-dark">{{ $expert->intervale ?? 'De ... À ....'}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="card">
                                <div class="card-body">
                                    <div class="contact-grids-tab p-0 mb-3">
                                        <ul class="nav nav-underline" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="info-tab2" data-bs-toggle="tab" data-bs-target="#basic-info2" type="button" role="tab" aria-selected="true">Projets</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="address-tab2" data-bs-toggle="tab" data-bs-target="#address2" type="button" role="tab" aria-selected="false">Publications</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content" id="myTabContent3">
                                        <div class="tab-pane fade show active" id="basic-info2" role="tabpanel" aria-labelledby="info-tab2" tabindex="0">
                                            <div class="row">
                                                @if ($projects->count() > 0)
                                                    @foreach ($projects as $project)
                                                        <div class="col-md-6 d-flex">
                                                            <div class="card flex-fill mb-4 mb-md-0">
                                                                <div class="card-body">
                                                                    <div class="d-flex align-items-center pb-3 mb-3 border-bottom">
                                                                        <a href="#" class="flex-shrink-0 me-2">
                                                                            <img src="{{ asset('assets/images/project.png') }}" style="width: 35px; height: 35px" alt="Img">
                                                                        </a>
                                                                        <div>
                                                                            <h6 class="mb-1"><a href="{{ route('admin.project.details', $project->id) }}">{{ $project->title }}</a></h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div>
                                                                                <span class="mb-1 d-block">Délai</span>
                                                                                <p class="text-dark">{{ optional($project->assignments->first())->deadline ? \Carbon\Carbon::parse($project->assignments->first()->deadline)->format('d/m/Y') : 'Non défini' }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div>
                                                                                @if ($project->leader)
                                                                                    <span class="mb-1 d-block">Chef Projet</span>
                                                                                    <a href="#" class="fw-normal d-flex align-items-center">
                                                                                        <img class="avatar avatar-sm rounded-circle me-2" src="{{ asset('/assets/images/dev.png') }}" alt="Img">
                                                                                        {{ $project->leader->firstname }} {{ substr($project->leader->lastname, 0, 1) }}.
                                                                                    </a>
                                                                                @else
                                                                                    <span class="text-muted">Projet Non Assigné</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="text-center p-4">
                                                        <img src="{{ asset('assets/images/empty.png') }}" alt="Aucun Expert" width="150">
                                                        <p class="text-muted mt-3">Aucun projet ne lui a été assigné.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="address2" role="tabpanel" aria-labelledby="address-tab2" tabindex="0">
                                            <div class="row">
                                                @if ($expert->articles->count() > 0)
                                                    @foreach ($expert->articles as $article)
                                                        <div class="col-md-12 d-flex">
                                                            <div class="card flex-fill">
                                                                <div class="card-body">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-md-12">
                                                                            <div class="d-flex align-items-center">
                                                                                <a href="#" class="flex-shrink-0 me-2">
                                                                                    <img src="{{ asset('assets/images/article.png') }}" style="width: 35px; height: 35px" class="img-fluid rounded-circle" alt="img">
                                                                                </a>
                                                                                <div>
                                                                                    <h6 class="mb-1"><a href="{{ route('blog.details', ['article' => $article]) }}">{{ $article->title }}</a></h6>
                                                                                    <div class="d-flex align-items-center">
                                                                                            <p>
                                                                                                <span class="text-primary">{{ $article->category->name }}
                                                                                                    <i class="ti ti-point-filled text-primary mx-1"></i>
                                                                                                </span>
                                                                                                {{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y à H:m') }}
                                                                                            </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @else
                                                    <div class="text-center p-4">
                                                        <img src="{{ asset('assets/images/empty.png') }}" alt="Aucun article" width="150">
                                                        <p class="text-muted mt-3">Aucun article.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
