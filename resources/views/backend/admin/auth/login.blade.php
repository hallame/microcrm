@extends('backend.admin.auth.layout.master')
@section('title') Connexion Back Office @endsection
@section('content')
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		<div class="container-fuild">
			<div class="w-100 overflow-hidden position-relative flex-wrap d-block vh-100 ">
				<div class="row bg-nightblue">
					<div class="col-lg-6">
						<div class="login-background position-relative d-lg-flex align-items-center justify-content-center d-none flex-wrap vh-100">
							<div class="bg-overlay-img">
								<img src="{{ asset('assets/back/img/bg/bg-01.png') }}" class="bg-1" alt="Img">
								<img src="{{ asset('assets/back/img/bg/bg-02.png') }}" class="bg-2" alt="Img">
								<img src="{{ asset('assets/back/img/bg/bg-03.png') }}" class="bg-3" alt="Img">
							</div>
							<div class="authentication-card w-100">
								<div class="authen-overlay-item border w-100">
									<h1 class="text-white display-1">Connexion à l'Espace <br> Administrateur.</h1>
									<div class="my-4 mx-auto authen-overlay-img">
										<img src="{{ asset('assets/images/senior.png') }}" style="width: 60%; height: 60%" alt="Img">
									</div>
									<div>
										<p class="text-white fs-20 fw-semibold text-center">Centre de contrôle ...</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12">
						<div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap">
							<div class="col-md-7 mx-auto vh-100">
								<form method="POST" action="{{ route('admin.access') }}" class="vh-100">
                                    @csrf
									<div class="vh-100 d-flex flex-column justify-content-between p-4 pb-0">
										<div class=" mx-auto mb-5 text-center">
										</div>
										<div class="">
											<div class="text-center mb-3">
												<h2 class="mb-2 text-white">Back Office</h2>
											</div>
											<div class="mb-3">
												<label for="email" class="form-label text-white">Adresse Email</label>
												<div class="input-group">
													<input type="email" name="email" id="email" class="form-control border-end-0">
													<span class="input-group-text border-start-0">
														<i class="ti ti-mail"></i>
													</span>
												</div>
											</div>
											<div class="mb-3">
												<label for="password" class="form-label text-white">Mot de passe</label>
												<div class="pass-group">
													<input type="password" name="password" id="password" class="pass-input form-control">
													<span class="ti toggle-password ti-eye-off"></span>
												</div>
											</div>
											<div class="d-flex align-items-center justify-content-between mb-3">
												<div class="d-flex align-items-center">
													<div class="form-check form-check-md mb-0">
														<input class="form-check-input" id="remember_me" type="checkbox">
														<label for="remember_me" class="form-check-label mt-0 text-white">Se rappeler</label>
													</div>
												</div>
												<div class="text-end">
													<a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" class="text-white">Mot de passe oublié?</a>
												</div>
											</div>
											<div class="mb-3">
												<button type="submit" class="btn btn-primary w-100">Se Connecter</button>
											</div>

										</div>
                                        <div class="mt-5 pb-4 text-center">
											<p class="mb-0 text-white">Copyright &copy; 2025 | <a class="text-white" href="{{ route('home') }}">ZALY MERVEILLE</a></p>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Réinitialiser le mot de passe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.forgot-password.send') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Envoyer le lien de réinitialisation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
	<!-- /Main Wrapper -->
@endsection
