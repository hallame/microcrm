@extends('backend.admin.layout.master')
@section('title') Partenaires @endsection
@section('content')

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
                                <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Total Partenaires</p>
                                <h4>{{ $totalPartners }}</h4>
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
                                <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Partenaires Actifs</p>
                                <h4>{{ $activePartners }}</h4>
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
                                <p class="fs-12 fw-medium mb-0 text-gray-5 mb-1">Partenaires Inactifs</p>
                                <h4>{{ $inactivePartners }}</h4>
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
                                <a href="#" data-bs-toggle="modal" data-bs-target="#add_partner" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus"></i> Nouveau partenaire</a>
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


    <!-- Clients list -->
    @if ($partners->count() > 0)
        <div class="row">
            @foreach ($partners as $partner)
                <div class="col-xxl-3 col-xl-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            {{-- Logo en haut, centré --}}
                            <div class="text-center mb-3">
                                <a
                                    class="d-inline-block"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#partner_details"
                                    role="button"
                                >
                                    <img
                                        src="{{ $partner->logo ? asset('storage/' . $partner->logo) : asset('/assets/images/senior.png') }}"
                                        alt="Logo {{ $partner->company }}"
                                        class="img-fluid"
                                        style="width: 100px; height: 100px; object-fit: cover;"
                                    >
                                </a>
                            </div>

                            {{-- Titre de l’entreprise + badge de statut --}}
                            <div class="text-center mb-2">
                                <h5 class="card-title mb-1">
                                    <a
                                        class="text-decoration-none text-dark"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#partner_details"
                                    >
                                        {{ $partner->company }}
                                    </a>
                                </h5>
                                <span class="badge
                                    @if($partner->status === 1) bg-success
                                    @elseif($partner->status === 0) bg-warning
                                    @else bg-secondary
                                    @endif
                                ">
                                    {{ $partner->status === 1 ? 'Actif' : ($partner->status === 0 ? 'Inactif' : 'Autre') }}
                                </span>
                            </div>

                            {{-- Email --}}
                            <div class="mb-3 text-center">
                                <p class="text-muted mb-0">
                                    <i class="ti ti-mail me-1"></i>
                                    <small>{{ $partner->email }}</small>
                                </p>
                            </div>

                            {{-- Téléphone --}}
                            <div class="mb-3 text-center">
                                <p class="text-muted mb-0">
                                    <i class="ti ti-phone me-1"></i>
                                    <small>{{ $partner->phone ?? 'Non fournie' }}</small>
                                </p>
                            </div>

                            {{-- Espace flexible pour pousser les actions en bas --}}
                            <div class="mt-auto">
                                <hr>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Bouton Éditer --}}
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-primary editPartnerBtn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#edit_partner"
                                        data-id="{{ $partner->id }}"
                                        data-company="{{ $partner->company }}"
                                        data-address="{{ $partner->address }}"
                                        data-email="{{ $partner->email }}"
                                        data-phone="{{ $partner->phone }}"
                                        data-contact="{{ $partner->contact }}"
                                        data-description="{{ $partner->description }}"
                                    >
                                        <i class="ti ti-edit"></i> Éditer
                                    </button>

                                    {{-- Bouton Supprimer --}}
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#delete_modal"
                                        onclick="setDeleteLink({{ $partner->id }})"
                                    >
                                        <i class="ti ti-trash"></i> Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        @include('partials.empty')
    @endif
    <!-- /Clients list -->

    <!-- Edit Partner -->
    @if($partners->isNotEmpty())
        <div class="modal fade" id="edit_partner">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modifier le partenaire</h4>
                        <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>

                    <form id="editPartnerForm" action="{{ route('admin.partner.update', $partner->id ?? ':id') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="id" value="{{ old('id', $partner->id ?? '') }}">

                        <div class="tab-content" id="myTabContent">
                            <div
                                class="tab-pane fade show active"
                                id="basic-info"
                                role="tabpanel"
                                aria-labelledby="info-tab"
                                tabindex="0"
                            >
                                <div class="modal-body pb-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="company" class="form-label">
                                                    Entreprise <span class="text-danger">*</span>
                                                </label>
                                                <input
                                                    type="text"
                                                    name="company"
                                                    id="company"
                                                    class="form-control"
                                                    required
                                                    placeholder="Entrez le nom de l'entreprise"
                                                    value="{{ old('company', $partner->company ?? '') }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">
                                                    Adresse Complète <span class="text-danger">*</span>
                                                </label>
                                                <input
                                                    type="text"
                                                    name="address"
                                                    id="address"
                                                    class="form-control"
                                                    required
                                                    placeholder="Entrez l'adresse complète"
                                                    value="{{ old('address', $partner->address ?? '') }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">
                                                    Email <span class="text-danger">*</span>
                                                </label>
                                                <input
                                                    type="email"
                                                    id="email"
                                                    name="email"
                                                    class="form-control"
                                                    required
                                                    placeholder="Entrez l'email de l'entreprise"
                                                    value="{{ old('email', $partner->email ?? '') }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Numéro de téléphone <span class="text-danger">*</span>
                                                </label>
                                                <input
                                                    type="tel"
                                                    name="phone"
                                                    id="phone"
                                                    class="form-control"
                                                    required
                                                    placeholder="Entrez le numéro de téléphone"
                                                    value="{{ old('phone', $partner->phone ?? '') }}"
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="logo" class="form-label">
                                                    Logo de l'entreprise <span class="text-danger">*</span>
                                                </label>
                                                <input
                                                    type="file"
                                                    name="logo"
                                                    id="logo"
                                                    class="form-control"
                                                    accept="image/*"
                                                >
                                                @if(isset($partner->logo))
                                                    <small class="text-muted">
                                                        Fichier actuel : <a href="{{ Storage::url($partner->logo) }}" target="_blank">
                                                            Voir le logo
                                                        </a>
                                                    </small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="website" class="form-label">Site web de l'entreprise</label>
                                                <input type="url" name="website" id="website" class="form-control" placeholder="Entrez l’URL du site web"
                                                    value="{{ old('website', $partner->website ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="contact" class="form-label">
                                                    Contact
                                                </label>
                                                <textarea
                                                    name="contact"
                                                    id="contact"
                                                    cols="30"
                                                    rows="2"
                                                    class="form-control"
                                                    placeholder="Précisez la personne à contacter"
                                                >{{ old('contact', $partner->contact ?? '') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">
                                                    Description
                                                </label>
                                                <textarea
                                                    name="description"
                                                    id="description"
                                                    cols="30"
                                                    rows="2"
                                                    class="form-control"
                                                    placeholder="Entrez une brève description"
                                                >{{ old('description', $partner->description ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-outline-light border me-2"
                                        data-bs-dismiss="modal"
                                    >
                                        Annuler
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        Mettre à jour
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif
    <!-- /Edit Partner -->


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editButtons = document.querySelectorAll(".editPartnerBtn");
            const form = document.getElementById("editPartnerForm");

            editButtons.forEach(btn => {
                btn.addEventListener("click", () => {
                    form.action = "/zpanel/update/partner/" + btn.dataset.id;

                    document.getElementById("edit_id").value = btn.dataset.id;
                    document.getElementById("firstname").value = btn.dataset.firstname || "";
                    document.getElementById("lastname").value = btn.dataset.lastname || "";
                    document.getElementById("email").value = btn.dataset.email || "";
                    document.getElementById("phone").value = btn.dataset.phone || "";
                    document.getElementById("country").value = btn.dataset.country || "";
                    document.getElementById("city").value = btn.dataset.city || "";
                    document.getElementById("address").value = btn.dataset.address || "";
                    document.getElementById("company").value = btn.dataset.company || "";
                    document.getElementById("position").value = btn.dataset.position || "";
                    document.getElementById("contact").value = btn.dataset.contact || "";
                    document.getElementById("description").value = btn.dataset.description || "";
                });
            });
        });
    </script>


    <!-- Modal pour confirmation de suppression -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                        <i class="ti ti-trash-x fs-36"></i>
                    </span>
                    <h4 class="mb-1">Confirmer la suppression</h4>
                    <p class="mb-3 text-danger">
                        Attention : En supprimant ce partenaire, toutes les informations associées seront définitivement perdues.
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Annuler</a>

                        <!-- Formulaire de suppression dynamique -->
                        <form id="deleteForm" action="{{ route('admin.partner.delete', ':id') }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setDeleteLink(partnerId) {
            var formAction = document.getElementById('deleteForm');
            formAction.action = formAction.action.replace(':id', partnerId);
        }
    </script>


@endsection
