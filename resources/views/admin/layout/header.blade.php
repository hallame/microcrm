<!-- Header -->
<div class="header">
    <div class="main-header">
        <div class="header-left">
            <a href="{{ route('admin.dashboard') }}" class="logo-text logo logo-normal">CRM ENTRETIEN</a>
        </div>
        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>
        <div class="header-user">
            <div class="nav user-menu nav-list">

                <div class="me-auto d-flex align-items-center" id="header-search">
                    <!-- Search -->
                    <div class="input-group input-group-flat d-inline-flex me-1">
                        <span class="input-icon-addon">
                            <i class="ti ti-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Rechercher ....">
                        <span class="input-group-text">
                            <kbd>CTRL + / </kbd>
                        </span>
                    </div>

                </div>

                <div class="d-flex align-items-center">
                    <div class="me-1">
                        <a href="#" class="btn btn-menubar btnFullscreen">
                            <i class="ti ti-maximize"></i>
                        </a>
                    </div>

                    <div class="dropdown profile-dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle d-flex align-items-center"
                            data-bs-toggle="dropdown">
                            <span class="avatar avatar-sm online">
                                <img src="{{ asset('/assets/images/admin.png') }}" alt="Admin Image" class="img-fluid rounded-circle">
                            </span>
                        </a>
                        <div class="dropdown-menu shadow-none">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2 avatar-rounded">
                                            <img src="{{ asset('/assets/images/admin.png') }}" alt="img">
                                        </span>
                                        {{-- <div>
                                            <h5 class="mb-0">{{ session('admin.firstname') }} {{ session('admin.lastname') }}</h5>
                                            <p class="fs-10 fw-medium mb-0">{{ session('admin.email') }}</p>
                                        </div> --}}
                                    </div>
                                </div>
                                {{-- <div class="card-body">
                                    <a class="dropdown-item d-inline-flex align-items-center p-0 " href="{{ route('admin.myprofile') }}">
                                        <i class="ti ti-circle-arrow-up me-1"></i>Mon Compte
                                    </a>
                                </div> --}}
                                {{-- <div class="card-footer">
                                    <a class="dropdown-item d-inline-flex align-items-center p-0" href="{{ route('admin.logout') }}">
                                        <i class="ti ti-login me-2"></i>Se déconnecter
                                    </a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-end">
                {{-- <a class="dropdown-item" href="{{ route('admin.myprofile') }}">Mon Profil</a>
                <a class="dropdown-item" href="{{ route('admin.logout') }}">Se déconnecter</a> --}}
            </div>
        </div>
        <!-- /Mobile Menu -->
    </div>
</div>
<!-- /Header -->
