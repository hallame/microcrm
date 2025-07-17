@extends('backend.admin.auth.layout.master')
@section('title') Récupérez votre accès @endsection
@section('content')
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		<div class="container-fuild">
			<div class="w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
				<div class="row nightblue">
					<div class="col-lg-5">
						<div class="login-background position-relative d-lg-flex align-items-center justify-content-center d-none flex-wrap vh-100">
							<div class="bg-overlay-img">
								<img src="{{ asset('assets/back/img/bg/bg-01.png') }}" class="bg-1" alt="Img">
								<img src="{{ asset('assets/back/img/bg/bg-02.png') }}" class="bg-2" alt="Img">
								<img src="{{ asset('assets/back/img/bg/bg-03.png') }}" class="bg-3" alt="Img">
							</div>
							<div class="authentication-card w-100">
								<div class="authen-overlay-item border w-100">
									<h1 class="text-white display-1">Récupérez votre accès</h1>
									<div class="my-4 mx-auto authen-overlay-img">
										<img src="{{ asset('assets/images/reset-password.png') }}" style="width: 60%; height: 60%" alt="Img">
									</div>
									<div>
										<p class="text-white fs-20 fw-semibold text-center">Réinitialisez votre mot de passe pour continuer...</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-7 col-md-12 col-sm-12">
						<div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap">
							<div class="col-md-7 mx-auto">
								<form method="POST" action="{{ route('admin.reset-password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="d-flex flex-column justify-content-between p-4 pb-0">
                                        <div class="mx-auto mb-5 text-center">
                                        </div>
                                        <div class="">
                                            <div class="text-center mb-3">
                                                <h2 class="mb-2">Réinitialisation du mot de passe</h2>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                                <div class="input-group">
                                                    <input type="password" name="password" class="pass-input form-control border-end-0" id="password" required>
                                                    <span class="ti toggle-password ti-eye-off"></span>
                                                    {{-- <span class="input-group-text border-start-0">
                                                        <i class="ti ti-lock"></i>
                                                    </span> --}}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                                <div class="input-group">
                                                    <input type="password" name="password_confirmation" class="pass-input form-control border-end-0" id="password_confirmation" required>
                                                    <span class="ti toggle-password ti-eye-off"></span>
                                                    {{-- <span class="input-group-text border-start-0">
                                                        <i class="ti ti-lock"></i>
                                                    </span> --}}
                                                </div>
                                            </div>
                                            <div class="text-end mb-3">
                                                <a href="{{ route('admin.login') }}" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Se Connecter</a>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary w-100">Réinitialiser le mot de passe</button>
                                            </div>
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
	<!-- /Main Wrapper -->
@endsection

