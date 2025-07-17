@extends('backend.admin.layout.master')
@section('title') Projet Détails @endsection
@section('content')
    <div class="row align-items-center mb-4">
        <div class="d-md-flex d-sm-block justify-content-between align-items-center flex-wrap">
            <h6 class="fw-medium d-inline-flex align-items-center mb-3 mb-sm-0"><a href="{{ route('admin.projects') }}">
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
                    <h5 class="mb-3">Détails du projet</h5>
                    <div class="list-group details-list-group mb-4">
                        <div class="list-group-item">
                            <span>Porteur de projet: </span>
                            <p class="text-gray-9">
                                {{ $project->client ? $project->client->firstname . ' ' . $project->client->lastname : 'Créé par Admin' }}
                            </p>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center justify-content-between">
                                <span>Créé le:</span>
                                <p class="text-gray-9">{{ \Carbon\Carbon::parse($project->created_at)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center justify-content-between">
                                <span>Attribué le: </span>
                                <p class="text-gray-9">{{ \Carbon\Carbon::parse($project->created_at)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex align-items-center justify-content-between">
                                <span>Délai:</span>
                                <div class="d-flex align-items-center">
                                    <p class="text-gray-9 mb-0">{{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }} </p>
                                    <span class="badge badge-danger d-inline-flex align-items-center ms-2"><i class="ti ti-clock-stop"></i></span>
                                </div>
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
                            <a class="flex-shrink-0 me-2"><i class="ti ti-folder text-primary fs-30"></i></a>
                            <div>
                                <h6 class="mb-1">{{ $project->title }}</h6>
                                <p>Project ID : <span class="text-primary"> PR{{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-sm-3">
                            <p class="d-flex align-items-center mb-3"><i class="ti ti-square-rounded me-2"></i>Status</p>
                        </div>
                        <div class="col-sm-9">
                            <span class="badge {{ $project->status_label['class'] }} d-inline-flex align-items-center mb-3">
                                <i class="{{ $project->status_label['icon'] }} me-1"></i> {{ $project->status_label['text'] }}
                            </span>
                        </div>
                        @if ($project->teams->isNotEmpty())
                        <div class="col-sm-3">
                            <p class="d-flex align-items-center mb-3"><i class="ti ti-users-group me-2"></i>Équipe</p>
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-gray-100 p-1 rounded d-flex align-items-center me-2">
                                    @foreach ($project->teams as $team)
                                        <a href="#" style="padding-right: 10px">{{ $team->name }}: </a>
                                        @if ($team->experts->count() > 0)
                                            @foreach ($team->experts as $expert)
                                                {{-- @if ($expert->id !== $team->leader_id) --}}
                                                    <a href="{{ route('admin.expert.details', ['expert' => $expert]) }}" class="avatar avatar-sm avatar-rounded border border-white flex-shrink-0">
                                                        <img src="{{ asset('assets/images/dev.png') }}" alt="Img">
                                                    </a>
                                                    <h6 class="fs-12"><a href="#">
                                                        {{ $expert->firstname }} {{ substr($expert->lastname, 0, 1) }}.</a>
                                                    </h6>
                                                {{-- @endif --}}
                                            @endforeach
                                        @else
                                            <span>Équipe vide</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <p class="d-flex align-items-center mb-3"><i class="ti ti-user-star me-2"></i>Chef d'Équipe</p>
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-gray-100 p-1 rounded d-flex align-items-center me-2">
                                    <a href="#" class="avatar avatar-sm avatar-rounded border border-white flex-shrink-0 me-2">
                                        <img src="{{ asset('/assets/images/senior.png') }}" alt="Img">
                                    </a>
                                    <h6 class="fs-12"><a href="{{ route('admin.project.details', ['project' => $project->leader]) }}">
                                        {{ $project->leader->firstname }} {{ substr($project->leader->lastname, 0, 1) }}.</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        @elseif ($project->teams->isEmpty() && $project->leader)
                        <div class="col-sm-3">
                            <p class="d-flex align-items-center mb-3"><i class="ti ti-user-shield me-2"></i>Chef Projet</p>
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-gray-100 p-1 rounded d-flex align-items-center me-2">
                                    <a href="#" class="avatar avatar-sm avatar-rounded border border-white flex-shrink-0 me-2">
                                        <img src="{{ asset('assets/images/dev.png') }}" alt="Img">
                                    </a>
                                    <h6 class="fs-12"><a href="{{ route('admin.project.details', ['project' => $project->leader]) }}">
                                        {{ $project->leader->firstname }} {{ substr($project->leader->lastname, 0, 1) }}.</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-sm-3">
                            <p class="d-flex align-items-center mb-3"><i class="ti ti-folder me-2"></i>Nouveau Projet</p>
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-gray-100 p-1 rounded d-flex align-items-center me-2">
                                    <p class="d-flex align-items-center"></i>Non Attribué</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="col-sm-3">
                            <p class="d-flex align-items-center mb-3"><i class="ti ti-bookmark me-2"></i>Catégorie</p>
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex align-items-center mb-3">
                                {{-- <a href="#" class="badge task-tag bg-pink rounded-pill me-2">{{ $project->category->name }}</a> --}}
                                <a class="badge task-tag badge-info rounded-pill">{{ $project->category->name ?? "Non définie" }}</a>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <h6 class="mb-1">Description</h6>
                                <p>{!! $project->description !!}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="bg-soft-secondary p-3 rounded d-flex align-items-center justify-content-between">
                                <p class="text-secondary mb-0">Note: </p>
                                <span class="text-secondary fs-16">{{ $project->latestStatus->comment ?? 'Pas d\'info supplémentaire' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="custom-accordion-items">
                <div class="accordion accordions-items-seperate" id="accordionExample">
                    <div class="accordion-item">
                        <div class="accordion-header" id="headingFour">
                            <div class="accordion-button">
                                <div class="d-flex align-items-center flex-fill">
                                    <h5>Fichiers</h5>
                                    <div class=" ms-auto d-flex align-items-center">
                                        <a href="#" class="btn btn-primary btn-xs d-inline-flex align-items-center me-3"></a>
                                        <a href="#" class="d-flex align-items-center collapsed collapse-arrow"  data-bs-toggle="collapse" data-bs-target="#primaryBorderFour" aria-expanded="false" aria-controls="primaryBorderFour">
                                            <i class="ti ti-chevron-down fs-18"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="primaryBorderFour" class="accordion-collapse collapse show border-top" aria-labelledby="headingFour">
                            <div class="accordion-body">
                                <div class="files-carousel owl-carousel">
                                    <div class="card shadow-none mb-0">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-2 pb-2 border-bottom">
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar avatar-md bg-light me-2">
                                                        <img src="assets/img/icons/file-02.svg" class="w-auto h-auto" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6 class="mb-1">Project_1.docx</h6>
                                                        <span>7.6 MB</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="btn btn-sm btn-icon"><i class="ti ti-download"></i></a>
                                                    <a href="#" class="btn btn-sm btn-icon"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="fw-medium mb-0">15 May 2024, 6:53 PM</p>
                                                <span class="avatar avatar-sm avatar-rounded"><img src="assets/img/profiles/avatar-02.jpg" alt="Img"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 d-flex">
                            <div class="accordion-item flex-fill">
                                <div class="accordion-header" id="headingFive">
                                    <div class="accordion-button">
                                        <div class="d-flex align-items-center flex-fill">
                                            <h5>Notes</h5>
                                            <div class=" ms-auto d-flex align-items-center">
                                                <a href="#" class="btn btn-primary btn-xs d-inline-flex align-items-center me-3">
                                                </a>
                                                <a href="#" class="d-flex align-items-center collapsed collapse-arrow"  data-bs-toggle="collapse" data-bs-target="#primaryBorderFive" aria-expanded="false" aria-controls="primaryBorderFive">
                                                    <i class="ti ti-chevron-down fs-18"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="primaryBorderFive" class="accordion-collapse collapse show border-top" aria-labelledby="headingFive">
                                    <div class="accordion-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <h6 class="text-gray-5 fw-medium">15 May 2025</h6>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end p-3">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item rounded-1"><i class="ti ti-edit me-2"></i>Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item rounded-1"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="d-flex align-items-center mb-2"><i class="ti ti-point-filled text-primary me-1"></i>Changes &amp; design</h6>
                                                <p class="text-truncate line-clamb-3">An office management app project streamlines administrative tasks by integrating
                                                    tools for scheduling, communication, and
                                                    task management, enhancing overall productivity and efficiency.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <h6 class="text-gray-5 fw-medium">15 May 2025</h6>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end p-3">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item rounded-1"><i class="ti ti-edit me-2"></i>Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item rounded-1"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="d-flex align-items-center mb-2"><i class="ti ti-point-filled text-primary me-1"></i>Changes &amp; design</h6>
                                                <p class="text-truncate line-clamb-3">An office management app project streamlines administrative tasks by integrating
                                                    tools for scheduling, communication, and
                                                    task management, enhancing overall productivity and efficiency.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 d-flex">
                            <div class="accordion-item flex-fill">
                                <div class="accordion-header" id="headingSix">
                                    <div class="accordion-button">
                                        <div class="d-flex align-items-center flex-fill">
                                            <h5>Activity</h5>
                                            <div class=" ms-auto d-flex align-items-center">
                                                <a href="#" class="btn btn-primary btn-xs d-inline-flex align-items-center me-3">
                                                </a>
                                                <a href="#" class="d-flex align-items-center collapsed collapse-arrow" data-bs-toggle="collapse" data-bs-target="#primaryBorderSix" aria-expanded="false" aria-controls="primaryBorderSix">
                                                    <i class="ti ti-chevron-down fs-18"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="primaryBorderSix" class="accordion-collapse collapse show border-top" aria-labelledby="headingSix">
                                    <div class="accordion-body">
                                        <div class="notice-widget">
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <div class="d-flex overflow-hidden">
                                                    <span class="bg-info avatar avatar-md me-3 rounded-circle flex-shrink-0">
                                                        <i class="ti ti-checkup-list fs-16"></i>
                                                    </span>
                                                    <div class="overflow-hidden">
                                                        <p class="text-truncate mb-1"><span class="text-gray-9 fw-medium">Andrew  </span>added a New Task</p>
                                                        <p class="mb-1">15 May 2024, 6:53 PM</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <div class="d-flex overflow-hidden me-2">
                                                    <span class="bg-warning avatar avatar-md me-3 rounded-circle flex-shrink-0">
                                                        <i class="ti ti-circle-dot fs-16"></i>
                                                    </span>
                                                    <div class="overflow-hidden">
                                                        <p class="text-truncate mb-1"><span class="text-gray-9 fw-medium">Jermai </span>Moved task <span class="text-gray-9 fw-medium"> “Private chat module”</span></p>
                                                        <p class="mb-1">15 May 2024, 6:53 PM</p>
                                                        <div class="d-flex align-items-center">
                                                            <span class="badge badge-success me-2"><i class="ti ti-point-filled me-1"></i>Completed</span>
                                                            <span><i class="ti ti-arrows-left-right me-2"></i></span>
                                                            <span class="badge badge-purple"><i class="ti ti-point-filled me-1"></i>Inprogress</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <div class="d-flex overflow-hidden me-2">
                                                    <span class="bg-purple avatar avatar-md me-3 rounded-circle flex-shrink-0">
                                                        <i class="ti ti-checkup-list fs-16"></i>
                                                    </span>
                                                    <div class="overflow-hidden">
                                                        <p class="text-truncate mb-1"><span class="text-gray-9 fw-medium">Jermai </span>Created task <span class="text-gray-9 fw-medium"> “Private chat module”</span></p>
                                                        <p class="mb-1">15 May 2024, 6:53 PM</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex overflow-hidden">
                                                    <span class="bg-secondary avatar avatar-md me-3 rounded-circle flex-shrink-0">
                                                        <i class="ti ti-photo fs-16"></i>
                                                    </span>
                                                    <div class="overflow-hidden">
                                                        <p class="text-truncate mb-1"><span class="text-gray-9 fw-medium">Hendry  </span> Updated Image <span class="text-gray-9 fw-medium"> “logo.jpg” </span></p>
                                                        <p class="mb-1">15 May 2024, 6:53 PM</p>
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
            </div> --}}
        </div>
    </div>
@endsection
