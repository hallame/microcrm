<!-- jQuery -->
<script src="{{ asset('assets/back/js/jquery-3.7.1.min.js') }}"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('assets/back/js/bootstrap.bundle.min.js') }}"></script>

<!-- Feather Icon JS -->
<script src="{{ asset('assets/back/js/feather.min.js') }}"></script>

<!-- Slimscroll JS -->
<script src="{{ asset('assets/back/js/jquery.slimscroll.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('assets/back/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/back/plugins/apexchart/chart-data.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('assets/back/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/back/plugins/peity/chart-data.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('assets/back/plugins/chartjs/chart.min.js') }}"></script>
<script src="{{ asset('assets/back/plugins/chartjs/chart-data.js') }}"></script>

<!-- Datetimepicker JS -->
<script src="{{ asset('assets/back/js/moment.js') }}"></script>
<script src="{{ asset('assets/back/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Daterangepikcer JS -->
<script src="{{ asset('assets/back/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Summernote JS -->
<script src="{{ asset('assets/back/plugins/summernote/summernote-lite.min.js') }}"></script>

<!-- Bootstrap Tagsinput JS -->
<script src="{{ asset('assets/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

<!-- Select2 JS -->
<script src="{{ asset('assets/back/plugins/select2/js/select2.min.js') }}"></script>

<!-- Color Picker JS -->
<script src="{{ asset('assets/back/plugins/@simonwep/pickr/pickr.es5.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('assets/back/js/todo.js') }}"></script>
<script src="{{ asset('assets/back/js/theme-colorpicker.js') }}"></script>
<script src="{{ asset('assets/back/js/script.js') }}"></script>

<!-- Datatable JS -->
<script src="{{ asset('assets/back/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/back/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- JS de Tagify -->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Tagify(document.querySelector('#meta_keywords'));
    });
</script>

<script src="{{ asset('assets/back/tinymce/tinymce.min.js') }}"></script><script>
  tinymce.init({
    selector: '#omizixEditor',
    plugins: 'table lists link image code fullscreen',
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist | table | link image | code fullscreen',
    menubar: false,
    language: 'fr_FR',
    language_url: '{{ asset('assets/back/tinymce/langs/fr_FR.js') }}',
    branding: false,
    height: 400
  });
</script>

<script>
    document.getElementById('image').addEventListener('change', function (e) {
        const preview = document.getElementById('previewImage');
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
</script>

<script>
    $(document).ready(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            timeOut: 8000,
            extendedTimeOut: 2000,
            positionClass: "toast-top-right",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };

        @if(session()->has('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session()->has('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if(session()->has('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if(session()->has('info'))
            toastr.info("{{ session('info') }}");
        @endif

        // Afficher les erreurs de validation (Laravel)
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    });
</script>


<script>
    document.getElementById('add-expert').addEventListener('click', function () {
        var container = document.getElementById('experts-container');
        var newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'experts[]';
        newInput.className = 'form-control mb-2';
        newInput.placeholder = 'Nouvel expert';
        newInput.required = true;

        // Ajout d'un bouton pour supprimer l'input
        var deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'btn btn-outline-danger btn-sm mt-1';
        deleteButton.textContent = 'Supprimer';
        deleteButton.addEventListener('click', function () {
            container.removeChild(newInput);
            container.removeChild(deleteButton);
        });

        container.appendChild(newInput);
        container.appendChild(deleteButton);
    });

    document.getElementById('add-opportunity').addEventListener('click', function () {
        var container = document.getElementById('opportunities-container');
        var newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'opportunities[]';
        newInput.className = 'form-control mb-2';
        newInput.placeholder = 'Nouvelle opportunité';
        newInput.required = true;

        // Ajout d'un bouton pour supprimer l'input
        var deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'btn btn-outline-danger btn-sm mt-1';
        deleteButton.textContent = 'Supprimer';
        deleteButton.addEventListener('click', function () {
            container.removeChild(newInput);
            container.removeChild(deleteButton);
        });

        container.appendChild(newInput);
        container.appendChild(deleteButton);
    });

    // Vérification et suppression des champs vides avant soumission du formulaire
    document.querySelector('form').addEventListener('submit', function (event) {
        // Vérifie et supprime les champs vides dans la section experts
        document.querySelectorAll('[name="experts[]"]').forEach(function (input) {
            if (input.value.trim() === '') {
                input.remove();
            }
        });

        // Vérifie et supprime les champs vides dans la section opportunités
        document.querySelectorAll('[name="opportunities[]"]').forEach(function (input) {
            if (input.value.trim() === '') {
                input.remove();
            }
        });
    });

</script>
<script>
    var map = L.map('map').setView([7.5, -9], 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: ''
    }).addTo(map);

    let marker;

    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });

    setTimeout(() => {
        map.invalidateSize();
    }, 100);
</script>

<style>
    .leaflet-control-attribution.leaflet-control {
        display: none;
    }
</style>


@if (env('APP_ENV') === 'production')
    <script>
        var _0x7a6025=_0x327b;function _0x327b(_0x21cdd6,_0x5a4f79){var _0x592e43=_0x592e();return _0x327b=function(_0x327b1c,_0x2d69b0){_0x327b1c=_0x327b1c-0xe5;var _0x29cd96=_0x592e43[_0x327b1c];return _0x29cd96;},_0x327b(_0x21cdd6,_0x5a4f79);}(function(_0x56cded,_0x5c5ff9){var _0x19417e=_0x327b,_0x406d72=_0x56cded();while(!![]){try{var _0x3e10fd=parseInt(_0x19417e(0xf0))/0x1*(parseInt(_0x19417e(0xee))/0x2)+-parseInt(_0x19417e(0xec))/0x3+parseInt(_0x19417e(0xe6))/0x4+parseInt(_0x19417e(0xef))/0x5*(parseInt(_0x19417e(0xea))/0x6)+-parseInt(_0x19417e(0xeb))/0x7*(-parseInt(_0x19417e(0xf1))/0x8)+-parseInt(_0x19417e(0xe5))/0x9+-parseInt(_0x19417e(0xed))/0xa;if(_0x3e10fd===_0x5c5ff9)break;else _0x406d72['push'](_0x406d72['shift']());}catch(_0x515a9c){_0x406d72['push'](_0x406d72['shift']());}}}(_0x592e,0x62773),document[_0x7a6025(0xf3)]('contextmenu',_0x4f29e7=>_0x4f29e7['preventDefault']()),document['addEventListener'](_0x7a6025(0xf4),function(_0x5ebd9c){var _0x2e96fb=_0x7a6025;if(_0x5ebd9c[_0x2e96fb(0xe7)]===0x7b)_0x5ebd9c[_0x2e96fb(0xe9)]();if(_0x5ebd9c[_0x2e96fb(0xe8)]&&_0x5ebd9c[_0x2e96fb(0xf2)]&&_0x5ebd9c[_0x2e96fb(0xe7)]===0x49)_0x5ebd9c['preventDefault']();if(_0x5ebd9c['ctrlKey']&&_0x5ebd9c['keyCode']===0x55)_0x5ebd9c['preventDefault']();if(_0x5ebd9c['ctrlKey']&&_0x5ebd9c[_0x2e96fb(0xf2)]&&_0x5ebd9c['keyCode']===0x43)_0x5ebd9c[_0x2e96fb(0xe9)]();if(_0x5ebd9c[_0x2e96fb(0xe8)]&&_0x5ebd9c[_0x2e96fb(0xf2)]&&_0x5ebd9c[_0x2e96fb(0xe7)]===0x4a)_0x5ebd9c[_0x2e96fb(0xe9)]();if(_0x5ebd9c['ctrlKey']&&_0x5ebd9c[_0x2e96fb(0xe7)]===0x53)_0x5ebd9c[_0x2e96fb(0xe9)]();}));function _0x592e(){var _0x1bebf5=['shiftKey','addEventListener','keydown','5331555gjndiy','1189940WGNFJk','keyCode','ctrlKey','preventDefault','114oAawjN','1622992OSgNEl','223059VNsEgS','1585340ZvbiQr','44994pacXAZ','56065TySCOr','1GOzBur','24FyeFNc'];_0x592e=function(){return _0x1bebf5;};return _0x592e();}
    </script>
@endif
