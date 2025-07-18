<!DOCTYPE html>
<html lang="fr">
<head>
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Micro CRM</title>
    <meta name="description" content="Découvrez Zaly Merveille, la plateforme dédiée à la valorisation du patrimoine culturel et naturel de la Guinée Forestière. Explorez des sites uniques, réservez vos visites et plongez dans l'histoire et les traditions locales.">
	<meta name="robots" content="noindex, nofollow">

    <meta property="og:image" content="{{ asset('assets/images/admin.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">


	<!-- Apple Touch Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/logo.jpg') }}">

	<!-- Favicon -->
	<link rel="icon" href="{{ asset('assets/images/logo.jpg') }}" type="image/x-icon">
	<link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}" type="image/x-icon">

	<!-- Theme Script js -->
	<script src="{{ asset('assets/back/js/theme-script.js') }}"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap.min.css') }}">

	<!-- Feather CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/icons/feather/feather.css') }}">

	<!-- Tabler Icon CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/tabler-icons/tabler-icons.css') }}">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/select2/css/select2.min.css') }}">

    <!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/css/dataTables.bootstrap5.min.css') }}">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/fontawesome/css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/fontawesome/css/all.min.css') }}">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap-datetimepicker.min.css') }}">

	<!-- Bootstrap Tagsinput CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">

	<!-- Summernote CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/summernote/summernote-lite.min.css') }}">

	<!-- Daterangepikcer CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/daterangepicker/daterangepicker.css') }}">

	<!-- Color Picker Css -->
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/flatpickr/flatpickr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/@simonwep/pickr/themes/nano.min.css') }}">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/css/style.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


     <!-- Toastr CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


     <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- CSS de Tagify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">



</head>
<body>
    <div id="global-loader" style="display: none;">
		<div class="page-loader"></div>
	</div>
	<!-- Main Wrapper -->
	<div class="main-wrapper">
        @include('admin.layout.header')
        @include('admin.layout.sidebar')
		<!-- Page Wrapper -->
		<div class="page-wrapper">
            {{-- @include('components.alert') --}}
			<div class="content">
                @yield('content')
            </div>
            @include('admin.layout.footer')
        </div>
        <!-- /Page Wrapper -->
        @include('admin.layout.modals')
    </div>
	<!-- /Main Wrapper -->
    @include('admin.layout.scripts')
</body>
</html>

