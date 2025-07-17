@extends('backend.admin.layout.master')

@section('title')
    Gestion des Pays
@endsection

@section('content')

<form action="{{ route('admin.countries.config') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="card bg-light-500 shadow-none">
            <div class="card-body d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_country" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Ajouter un pays</a>
                {{-- <h6>Configurer les Pays</h6> --}}
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                <div class="d-flex align-items-center justify-content-end">
                    <div class="form-check form-switch me-2">
                        <label class="form-check-label mt-0">
                            <input class="form-check-input me-2" type="checkbox" role="switch"
                                id="toggle-all-countries" onclick="toggleAllCountries()"
                                {{ $allActive ? 'checked' : '' }}>
                            <span id="toggle-all-text">{{ $allActive ? 'Désactiver tout' : 'Activer tout' }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive border rounded">
            @if ($countries->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Code ISO</th>
                        <th>Indicatif Pays</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($countries as $country)
                        <tr>
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->iso_code }}</td>
                            <td>{{ $country->country_code }}</td>
                            <td>
                                <span class="badge bg-{{ $country->status ? 'success' : 'danger' }}">
                                    {{ $country->status ? 'Activé' : 'Désactivé' }}
                                </span>
                            </td>
                            <td>
                                <div class="form-check form-switch me-2">
                                    <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                    <input type="hidden" name="status[{{ $country->id }}]" value="0">
                                    <!-- Case à cocher avec la valeur '1' si cochée -->
                                    <input class="form-check-input me-2" type="checkbox" role="switch"
                                        name="status[{{ $country->id }}]" value="1" {{ $country->status ? 'checked' : '' }} >
                                </div>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $country->id }})">
                                    <i class="ti ti-trash fs-20 text-danger"></i> <!-- Icône de suppression -->
                                </a>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit_country_modal"
                                    onclick="setEditCountryForm({{ $country->id }}, '{{ addslashes($country->name) }}', '{{ $country->iso_code }}', '{{ $country->country_code }}')">
                                        <i class="ti ti-edit fs-20 text-secondary me-2"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                @include('partials.empty')
            @endif
        </div>
    </div>

    <div class="modal-footer mt-3">
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </div>
</form>




<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirmer la suppression</h4>
                <p class="mb-3">Vous voulez supprimer cet élément, cela ne pourra pas être annulé une fois supprimé.</p>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Annuler</a>

                    <!-- Formulaire de suppression dynamique -->
                    <form id="deleteForm" action="{{ route('admin.country.delete', ':id') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_country_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editCountryForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le pays</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nom du pays</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_iso_code" class="form-label">Code ISO</label>
                        <input type="text" class="form-control" id="edit_iso_code" name="iso_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_country_code" class="form-label">Indicatif</label>
                        <input type="text" class="form-control" id="edit_country_code" name="country_code" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function setEditCountryForm(id, name, iso, code) {
        const form = document.getElementById("editCountryForm");
        let url = '{{ route("admin.country.update", ":id") }}';
        url = url.replace(':id', id);

        form.setAttribute("action", url);
        document.getElementById("edit_name").value = name;
        document.getElementById("edit_iso_code").value = iso;
        document.getElementById("edit_country_code").value = code;
    }
</script>




<script>
    // Fonction pour mettre à jour le texte en fonction de l'état des pays
    function toggleAllCountries() {
        let toggleSwitch = document.getElementById('toggle-all-countries');
        let checkboxes = document.querySelectorAll('input[type="checkbox"][role="switch"]');
        let toggleText = document.getElementById('toggle-all-text');

        // Si le switch est activé, tous les pays sont activés
        if (toggleSwitch.checked) {
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            toggleText.textContent = 'Désactiver tout';
        } else {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            toggleText.textContent = 'Activer tout';
        }
    }

    function setDeleteLink(countryId) {
        // Dynamiser l'URL de suppression avec l'ID du pays
        var deleteUrl = '{{ route("admin.country.delete", ":id") }}';
        deleteUrl = deleteUrl.replace(':id', countryId);

        // Mettre à jour l'URL du formulaire de suppression
        document.getElementById("deleteForm").setAttribute("action", deleteUrl);
    }

</script>

@endsection
