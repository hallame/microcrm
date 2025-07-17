<!-- Header -->
<div class="header">
    <div class="main-header">

        <div class="header-left">
            <a href="{{ route('admin.dashboard') }}" class="logo-text logo logo-normal">Zaly Merveille</a>
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
                    {{-- <a id="toggle_btn" href="javascript:void(0);" class="btn btn-menubar me-1">
                        <i class="ti ti-arrow-bar-to-left"></i>
                    </a> --}}
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
                    <a href="{{ route('home') }}" class="btn btn-menubar me-1" target="_blank">
                        <i class="ti ti-world"></i>
                    </a>

                    <!-- /Search -->
                    {{-- <div class="dropdown crm-dropdown">
                        <a href="#" class="btn btn-menubar me-1" data-bs-toggle="dropdown">
                            <i class="ti ti-layout-grid"></i>
                        </a>
                        <div class="dropdown-menu dropdown-lg dropdown-menu-start">
                            <div class="card mb-0 border-0 shadow-none">
                                <div class="card-header">
                                    <h4>Raccourcis</h4>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="{{ route('admin.experts') }}" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                <span class="d-flex align-items-center me-3">
                                                    <i class="ti ti-users text-default me-2"></i>Experts
                                                </span>
                                                <i class="ti ti-arrow-right"></i>
                                            </a>
                                            <a href="{{ route('admin.projects') }}" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                <span class="d-flex align-items-center me-3">
                                                    <i class="ti ti-box text-default me-2"></i>Projets
                                                </span>
                                                <i class="ti ti-arrow-right"></i>
                                            </a>
                                            <a href="{{ route('admin.clients') }}" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                <span class="d-flex align-items-center me-3">
                                                    <i class="ti ti-users-group text-default me-2"></i>Clients
                                                </span>
                                                <i class="ti ti-arrow-right"></i>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="{{ route('admin.articles') }}" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                <span class="d-flex align-items-center me-3">
                                                    <i class="ti ti-ticket text-default me-2"></i>Articles
                                                </span>
                                                <i class="ti ti-arrow-right"></i>
                                            </a>
                                            <a href="#" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                <span class="d-flex align-items-center me-3">
                                                    <i class="ti ti-settings text-default me-2"></i></i>Paramètres
                                                </span>
                                                <i class="ti ti-arrow-right"></i>
                                            </a>
                                            <a href="{{ route('admin.myprofile') }}" class="d-flex align-items-center justify-content-between p-2 crm-link mb-3">
                                                <span class="d-flex align-items-center me-3">
                                                    <i class="ti ti-circle-arrow-up text-default me-2"></i>Profil
                                                </span>
                                                <i class="ti ti-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="d-flex align-items-center">
                    <div class="me-1">
                        <a href="#" class="btn btn-menubar btnFullscreen">
                            <i class="ti ti-maximize"></i>
                        </a>
                    </div>
                    {{-- <div class="dropdown me-1">
                        <a href="#" class="btn btn-menubar" data-bs-toggle="dropdown">
                            <i class="ti ti-layout-grid-remove"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="card mb-0 border-0 shadow-none">
                                <div class="card-header">
                                    <h4>Applications</h4>
                                </div>
                                <div class="card-body">
                                    <a href="calendar.html" class="d-block pb-2">
                                        <span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-calendar text-gray-9"></i></span>Calendar
                                    </a>
                                    <a href="todo.html" class="d-block py-2">
                                        <span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-subtask text-gray-9"></i></span>To Do
                                    </a>
                                    <a href="notes.html" class="d-block py-2">
                                        <span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-notes text-gray-9"></i></span>Notes
                                    </a>
                                    <a href="file-manager.html" class="d-block py-2">
                                        <span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-folder text-gray-9"></i></span>File Manager
                                    </a>
                                    <a href="kanban-view.html" class="d-block py-2">
                                        <span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-layout-kanban text-gray-9"></i></span>Kanban
                                    </a>
                                    <a href="invoices.html" class="d-block py-2 pb-0">
                                        <span class="avatar avatar-md bg-transparent-dark me-2"><i class="ti ti-file-invoice text-gray-9"></i></span>Invoices
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="me-1">
                        <a href="chat.html" class="btn btn-menubar position-relative">
                            <i class="ti ti-brand-hipchat"></i>
                            <span class="badge bg-info rounded-pill d-flex align-items-center justify-content-center header-badge">5</span>
                        </a>
                    </div>
                    <div class="me-1">
                        <a href="email.html" class="btn btn-menubar">
                            <i class="ti ti-mail"></i>
                        </a>
                    </div>
                    <div class="me-1 notification_item">
                        <a href="#" class="btn btn-menubar position-relative me-1" id="notification_popup"
                            data-bs-toggle="dropdown">
                            <i class="ti ti-bell"></i>
                            <span class="notification-status-dot"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end notification-dropdown p-4">
                            <div class="d-flex align-items-center justify-content-between border-bottom p-0 pb-3 mb-3">
                                <h4 class="notification-title">Notifications (2)</h4>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="text-primary fs-15 me-3 lh-1">Mark all as read</a>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="bg-white dropdown-toggle"
                                            data-bs-toggle="dropdown">
                                            <i class="ti ti-calendar-due me-1"></i>Today
                                        </a>
                                        <ul class="dropdown-menu mt-2 p-3">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                                    This Week
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                                    Last Week
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">
                                                    Last Month
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="noti-content">
                                <div class="d-flex flex-column">
                                    <div class="border-bottom mb-3 pb-3">
                                        <a href="activity.html">
                                            <div class="d-flex">
                                                <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                    <img src="{{ asset('assets/back/img/profiles/avatar-27.jpg') }}" alt="Profile">
                                                </span>
                                                <div class="flex-grow-1">
                                                    <p class="mb-1"><span
                                                            class="text-dark fw-semibold">Shawn</span>
                                                        performance in Math is below the threshold.</p>
                                                    <span>Just Now</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="border-bottom mb-3 pb-3">
                                        <a href="activity.html" class="pb-0">
                                            <div class="d-flex">
                                                <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                    <img src="{{ asset('assets/back/img/profiles/avatar-23.jpg') }}" alt="Profile">
                                                </span>
                                                <div class="flex-grow-1">
                                                    <p class="mb-1"><span
                                                            class="text-dark fw-semibold">Sylvia</span> added
                                                        appointment on 02:00 PM</p>
                                                    <span>10 mins ago</span>
                                                    <div
                                                        class="d-flex justify-content-start align-items-center mt-1">
                                                        <span class="btn btn-light btn-sm me-2">Deny</span>
                                                        <span class="btn btn-primary btn-sm">Approve</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="border-bottom mb-3 pb-3">
                                        <a href="activity.html">
                                            <div class="d-flex">
                                                <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                    <img src="{{ asset('assets/back/img/profiles/avatar-25.jpg') }}" alt="Profile">
                                                </span>
                                                <div class="flex-grow-1">
                                                    <p class="mb-1">New student record <span class="text-dark fw-semibold"> George</span> is created by <span class="text-dark fw-semibold">Teressa</span></p>
                                                    <span>2 hrs ago</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="border-0 mb-3 pb-0">
                                        <a href="activity.html">
                                            <div class="d-flex">
                                                <span class="avatar avatar-lg me-2 flex-shrink-0">
                                                    <img src="{{ asset('assets/back/img/profiles/avatar-01.jpg') }}" alt="Profile">
                                                </span>
                                                <div class="flex-grow-1">
                                                    <p class="mb-1">A new teacher record for <span class="text-dark fw-semibold">Elisa</span> </p>
                                                    <span>09:45 AM</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <a href="#" class="btn btn-light w-100 me-2">Cancel</a>
                                <a href="activity.html" class="btn btn-primary w-100">View All</a>
                            </div>
                        </div>
                    </div> --}}
                    <div class="dropdown profile-dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle d-flex align-items-center"
                            data-bs-toggle="dropdown">
                            <span class="avatar avatar-sm online">
                                <img src="{{ $admin->image ? asset('storage/' . $admin->image) : asset('/assets/images/admin.png') }}" alt="Admin Image" class="img-fluid rounded-circle">
                            </span>
                        </a>
                        <div class="dropdown-menu shadow-none">
                            <div class="card mb-0">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-lg me-2 avatar-rounded">
                                            <img src="{{ $admin->image ? asset('storage/' . $admin->image) : asset('/assets/images/admin.png') }}" alt="img">
                                        </span>
                                        <div>
                                            <h5 class="mb-0">{{ session('admin.firstname') }} {{ session('admin.lastname') }}</h5>
                                            <p class="fs-10 fw-medium mb-0">{{ session('admin.email') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    {{-- <a class="dropdown-item d-inline-flex align-items-center p-0 " href="{{ route('admin.settings.email') }}">
                                        <i class="ti ti-settings me-1"></i>Paramètres
                                    </a> --}}

                                    <a class="dropdown-item d-inline-flex align-items-center p-0 " href="{{ route('admin.myprofile') }}">
                                        <i class="ti ti-circle-arrow-up me-1"></i>Mon Compte
                                    </a>
                                </div>
                                <div class="card-footer">
                                    <a class="dropdown-item d-inline-flex align-items-center p-0" href="{{ route('admin.logout') }}">
                                        <i class="ti ti-login me-2"></i>Se déconnecter
                                    </a>
                                </div>
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
                <a class="dropdown-item" href="{{ route('admin.myprofile') }}">Mon Profil</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.settings.email') }}">Paramètres</a> --}}
                <a class="dropdown-item" href="{{ route('admin.logout') }}">Se déconnecter</a>
            </div>
        </div>
        <!-- /Mobile Menu -->

    </div>

</div>
<!-- /Header -->
