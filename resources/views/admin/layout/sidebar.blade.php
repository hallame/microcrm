		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<!-- Logo -->
            <div class="sidebar-logo">
                <a href="{{ route('admin.dashboard') }}" class="logo-text dark-logo1"> МИКРО ЦРМ</a>
                <a href="{{ route('admin.dashboard') }}" class="logo-small">
					<img src="{{ asset('assets/images/favicon.png') }}" alt="Logo">
				</a>
            </div>
			<!-- /Logo -->
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li class="menu-title"><span>СУПЕР АДМИН</span></li>
						<li>
							<ul>
								<li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
									<a href="{{ route('admin.dashboard') }}">
										<i class="ti ti-smart-home"></i><span> Главная</span>
										<span class="badge badge-danger fs-10 fw-medium text-white p-1"><i class="ti ti-shield-lock text-white"></i></span>
									</a>
								</li>

                                {{-- <li class="submenu">
									<a href="{{ route('admin.clients') }}" class="{{ request()->routeIs(['admin.clients', 'admin.client.details']) ? 'active subdrop' : '' }}">
										<i class="ti ti-users-group"></i><span>Gestion Clients</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.clients') }}" class="{{ request()->routeIs('admin.clients', 'admin.client.details') ? 'active' : '' }}">Tous les clients</a></li>
                                        <li><a href="#" class="{{ request()->routeIs('admin.client.create') ? 'active' : '' }}" data-bs-toggle="modal" data-bs-target="#add_client">Ajouter un Client</a></li>
									</ul>
								</li>

                                 <li class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                                    <a href="{{ route('admin.categories') }}">
                                        <i class="ti ti-layout-grid-add"></i><span>Catégories</span>
                                    </a>
                                </li>
                                <li class="submenu">
									<a href="{{ route('admin.sites') }}" class="{{ request()->routeIs(['admin.sites', 'admin.site.details', 'admin.site.edit', 'admin.site.add.form', 'admin.sites.galleries']) ? 'active subdrop' : '' }}">
										<i class="ti ti-map-pin"></i><span>Sites Touristiques</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.sites') }}" class="{{ request()->routeIs('admin.sites') ? 'active' : '' }}">Tous les sites</a></li>
                                        <li><a href="{{ route('admin.site.add.form') }}" class="{{ request()->routeIs('admin.site.add.form') ? 'active' : '' }}">Ajouter un site</a></li>
									</ul>
								</li>

                                <li class="submenu">
									<a href="{{ route('admin.circuits') }}" class="{{ request()->routeIs(['admin.circuits', 'admin.circuit.create', 'admin.circuit.edit', 'admin.circuit.add.form']) ? 'active subdrop' : '' }}">
										<i class="ti ti-pyramid"></i><span>Circuits</span>
                                        <span class="badge badge-success fs-10 fw-medium text-white p-1">Nouveau</span>
										<span class="menu-arrow"></span>
									</a>

									<ul>
                                        <li><a href="{{ route('admin.circuits') }}" class="{{ request()->routeIs('admin.circuits') ? 'active' : '' }}">Tous les circuits</a></li>
                                        <li><a href="{{ route('admin.circuit.add.form') }}" class="{{ request()->routeIs('admin.circuit.add.form') ? 'active' : '' }}">Ajouter un circuit</a></li>
									</ul>
								</li> --}}

                                {{-- <li class="{{ request()->routeIs('admin.galleries') ? 'active' : '' }}">
                                    <a href="{{ route('admin.galleries') }}">
                                        <i class="ti ti-photo"></i><span>Galeries</span>
                                    </a>
                                </li>

                                <li class="submenu">
									<a href="{{ route('admin.museums') }}" class="{{ request()->routeIs(['admin.museums', 'admin.museum.details', 'admin.museum.edit', 'admin.museum.add.form']) ? 'active subdrop' : '' }}">
										<i class="ti ti-building"></i> <span>Musées</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.museums') }}" class="{{ request()->routeIs('admin.museums') ? 'active' : '' }}">Tous les musées</a></li>
                                        <li><a href="{{ route('admin.museum.add.form') }}" class="{{ request()->routeIs('admin.museum.add.form') ? 'active' : '' }}">Ajouter un musée</a></li>
									</ul>
								</li>

                                <li class="submenu">
									<a href="{{ route('admin.monuments') }}" class="{{ request()->routeIs(['admin.monuments', 'admin.monument.details', 'admin.monument.edit', 'admin.monument.add.form']) ? 'active subdrop' : '' }}">
										 <i class="fa fa-landmark"></i><span>Monuments</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.monuments') }}" class="{{ request()->routeIs('admin.monuments') ? 'active' : '' }}">Tous les monuments</a></li>
                                        <li><a href="{{ route('admin.monument.add.form') }}" class="{{ request()->routeIs('admin.monument.add.form') ? 'active' : '' }}">Ajouter un monument</a></li>
									</ul>
								</li>

                                <li class="submenu">
									<a href="{{ route('admin.objects') }}" class="{{ request()->routeIs(['admin.objects', 'admin.object.details', 'admin.object.edit', 'admin.object.add.form']) ? 'active subdrop' : '' }}">
										<i class="ti ti-brush"></i> <span>Objets d'art</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.objects') }}" class="{{ request()->routeIs('admin.objects') ? 'active' : '' }}">Tous les objets</a></li>
                                        <li><a href="{{ route('admin.object.add.form') }}" class="{{ request()->routeIs('admin.object.add.form') ? 'active' : '' }}">Ajouter un objet</a></li>
									</ul>
								</li>
                                <li class="submenu">
									<a href="{{ route('admin.events') }}" class="{{ request()->routeIs(['admin.events', 'admin.event.edit']) ? 'active subdrop' : '' }}">
										<i class="ti ti-calendar-check"></i><span>Événements </span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.events') }}" class="{{ request()->routeIs('admin.events', 'admin.event.details') ? 'active' : '' }}">Tous les événements</a></li>
                                        <li><a href="#" class="{{ request()->routeIs('admin.event.create') ? 'active' : '' }}" data-bs-toggle="modal" data-bs-target="#add_event">Nouvel événement</a></li>
									</ul>
								</li>

                                <li class="submenu">
									<a href="{{ route('admin.partners') }}" class="{{ request()->routeIs('admin.partners', 'admin.partner.details', 'admin.partner.add.form') ? 'active subdrop' : '' }}">
										<i class="ti ti-user-star"></i><span>Partenaires</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="{{ route('admin.partners') }}" class="{{ request()->routeIs('admin.partners', 'admin.partner.details') ? 'active' : '' }}">Nos Partenaires</a></li>
                                        <li><a href="#" class="{{ request()->routeIs('admin.partner.create') ? 'active' : '' }}" data-bs-toggle="modal" data-bs-target="#add_partner">Nouveau Partenaire</a></li>
									</ul>
								</li> --}}
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Sidebar -->

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap');
            .logo-text {
                font-size: 20px;
                font-weight: 900;
                text-transform: uppercase;
                letter-spacing: 1px;
                display: block;
                font-family: "Roboto", sans-serif;
            }

            .logo-normal {
                color: #2C3E50; /* Couleur principale */
            }

            .logo-small {
                font-size: 20px;
                color: #3498DB; /* Bleu */
            }

            .dark-logo1 {
                color: white;
                padding: 5px 10px 30px 5px;
                text-shadow: 1px 1px 3px rgba(247, 74, 0, 0.9);
            }
        </style>

