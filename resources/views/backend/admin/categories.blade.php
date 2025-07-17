@extends('backend.admin.layout.master')
@section('title')
    Gestion des Catégories
@endsection
@section('content')

<form action="{{ route('admin.categories.config') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="card bg-light-500 shadow-none">
            <div class="card-body d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_category" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Ajouter une Catégorie</a>
                {{-- <h6>Configurer les Pays</h6> --}}
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                <div class="d-flex align-items-center justify-content-end">
                    <div class="form-check form-switch me-2">
                        <label class="form-check-label mt-0">
                            <input class="form-check-input me-2" type="checkbox" role="switch"
                                id="toggle-all-categories" onclick="toggleAllCategories()"
                                {{ $allActive ? 'checked' : '' }}>
                            <span id="toggle-all-text">{{ $allActive ? 'Désactiver tout' : 'Activer tout' }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive border rounded">
            @if ($categories->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <span class="badge bg-{{ $category->status ? 'success' : 'danger' }}">
                                    {{ $category->status ? 'Activé' : 'Désactivé' }}
                                </span>
                            </td>
                            <td>
                                <div class="form-check form-switch me-2">
                                    <!-- Champ caché pour envoyer la valeur '0' si décoché -->
                                    <input type="hidden" name="status[{{ $category->id }}]" value="0">
                                    <!-- Case à cocher avec la valeur '1' si cochée -->
                                    <input class="form-check-input me-2" type="checkbox" role="switch"
                                        name="status[{{ $category->id }}]" value="1" {{ $category->status ? 'checked' : '' }} >
                                </div>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="setDeleteLink({{ $category->id }})">
                                    <i class="ti ti-trash fs-20 text-danger"></i> <!-- Icône de suppression -->
                                </a>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit_modal"
                                    onclick="setEditForm({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description) }}')">
                                    <i class="ti ti-edit fs-20 text-secondary"></i>
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
                    <form id="deleteForm" action="{{ route('admin.category.delete', ':id') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Modifier la catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    // Fonction pour mettre à jour le texte en fonction de l'état des pays
    function toggleAllCategories() {
        let toggleSwitch = document.getElementById('toggle-all-categories');
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

    function setDeleteLink(categoryId) {
        // Dynamiser l'URL de suppression avec l'ID du pays
        var deleteUrl = '{{ route("admin.category.delete", ":id") }}';
        deleteUrl = deleteUrl.replace(':id', categoryId);

        // Mettre à jour l'URL du formulaire de suppression
        document.getElementById("deleteForm").setAttribute("action", deleteUrl);
    }
</script>

<script>
    function setEditForm(categoryId, name, description) {
        // Définir l'URL du formulaire d'édition
        var editUrl = '{{ route("admin.category.update", ":id") }}';
        editUrl = editUrl.replace(':id', categoryId);

        document.getElementById("editForm").setAttribute("action", editUrl);
        document.getElementById("edit_name").value = name;
        document.getElementById("edit_description").value = description;
    }

</script>

@endsection
