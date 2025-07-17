<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Découvrez Zaly Merveille, la plateforme dédiée à la valorisation du patrimoine culturel et naturel de la Guinée Forestière. Explorez des sites uniques, réservez vos visites et plongez dans l'histoire et les traditions locales.">

    <meta property="og:image" content="{{ asset('assets/back/images/logo.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
	<meta name="robots" content="noindex, nofollow">
    <title>@yield('title') | ZALY MERVEILLE</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/faviclogo.jpg') }}">
	<!-- Apple Touch Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/logo.jpg') }}">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap.min.css') }}">

	<!-- Feather CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/icons/feather/feather.css') }}">

	<!-- Tabler Icon CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/tabler-icons/tabler-icons.css') }}">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/fontawesome/css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/back/plugins/fontawesome/css/all.min.css') }}">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ asset('assets/back/css/style.css') }}">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<body class="bg-white">
    <div id="global-loader" style="display: none;">
		<div class="page-loader"></div>
	</div>
    @yield('content')
    @include('backend.admin.auth.layout.scripts')
</body>
</html>
