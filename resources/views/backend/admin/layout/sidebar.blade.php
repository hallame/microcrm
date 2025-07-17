		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<!-- Logo -->
            <div class="sidebar-logo">
                <a href="{{ route('admin.dashboard') }}" class="logo-text dark-logo1">ZALY MERVEILLE</a>
                <a href="{{ route('admin.dashboard') }}" class="logo-small">
					<img src="{{ asset('assets/images/favicon.png') }}" alt="Logo">
				</a>
            </div>
			<!-- /Logo -->
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li class="menu-title"><span>SUPER ADMIN</span></li>
						<li>
							<ul>
								<li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
									<a href="{{ route('admin.dashboard') }}">
										<i class="ti ti-smart-home"></i><span>Tableau de bord</span>
										<span class="badge badge-danger fs-10 fw-medium text-white p-1"><i class="ti ti-shield-lock text-white"></i></span>
									</a>
								</li>


                                <li class="submenu">
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
                                        {{-- <li><a href="{{ route('admin.sites.galleries') }}" class="{{ request()->routeIs('admin.sites.galleries') ? 'active' : '' }}" >Galeries  </a> </li> --}}
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
								</li>

                                <li class="{{ request()->routeIs('admin.galleries') ? 'active' : '' }}">
                                    <a href="{{ route('admin.galleries') }}">
                                        <i class="ti ti-photo"></i><span>Galeries</span>
                                    </a>
                                </li>

                                <li class="submenu">
                                    <a href="{{ route('admin.sites.reservations') }}"
                                    class="{{ request()->routeIs([
                                        'admin.sites.reservations',
                                        'admin.sites.reservation.details',
                                        'admin.sites.reservation.add.form',
                                        'admin.sites.reservation.assign.form'
                                    ]) ? 'active subdrop' : '' }}">

										<i class="ti ti-calendar"></i><span>Réservations</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.sites.reservations') }}" class="{{ request()->routeIs('admin.sites.reservations', 'admin.sites.reservation.details') ? 'active' : '' }}">Toutes les réservations</a></li>
                                        <li><a href="{{ route('admin.sites.reservation.add.form') }}" class="{{ request()->routeIs('admin.sites.reservation.add.form') ? 'active' : '' }}">Ajouter une réservation</a></li>
                                        {{-- <li><a href="{{ route('admin.sites.reservation.assign.form') }}" class="{{ request()->routeIs('admin.sites.reservation.assign.form') ? 'active' : '' }}">Assigner une réservation</a></li> --}}
									</ul>
								</li>


                                <li class="submenu">
									<a href="{{ route('admin.museums') }}" class="{{ request()->routeIs(['admin.museums', 'admin.museum.details', 'admin.museum.edit', 'admin.museum.add.form']) ? 'active subdrop' : '' }}">
										<i class="ti ti-building"></i> <span>Musées</span>
                                        {{-- <span class="badge badge-secondary fs-10 fw-medium text-white p-1">New</span> --}}

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
                                         {{-- <span class="badge badge-info fs-10 fw-medium text-white p-1">New</span> --}}

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
								</li>



                                {{-- <li class="submenu">
									<a href="{{ route('admin.hotels') }}" class="{{ request()->routeIs(['admin.hotels', 'admin.hotel.details', 'admin.hotel.edit', 'admin.hotel.add.form']) ? 'active subdrop' : '' }}">
                                         <i class="fa fa-hotel"></i><span>Hôtels</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.hotels') }}" class="{{ request()->routeIs('admin.hotels') ? 'active' : '' }}">Tous les hôtels</a></li>
                                        <li><a href="{{ route('admin.hotel.add.form') }}" class="{{ request()->routeIs('admin.hotel.add.form') ? 'active' : '' }}">Ajouter un hôtel</a></li>
									</ul>
								</li> --}}



                                <li class="menu-title" style="margin-top: 20px" ><span>GESTION DE CONTENU</span></li>

                                {{-- <li class="submenu">
									<a href="{{ route('admin.home.sliders') }}" class="{{ request()->routeIs(['admin.home.sliders', 'admin.home.sections']) ? 'active subdrop' : '' }}">
                                         <i class="fa fa-home"></i><span>Page d’accueil</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.home.sections') }}" class="{{ request()->routeIs('admin.home.sections') ? 'active' : '' }}">Gestion du contenu</a></li>
                                        <li><a href="{{ route('admin.home.sliders') }}" class="{{ request()->routeIs('admin.home.sliders') ? 'active' : '' }}">Gestions des sliders</a></li>
									</ul>
								</li> --}}

                                {{-- <li class="submenu">
									<a href="{{ route('admin.sliders') }}" class="{{ request()->routeIs(['admin.sliders', 'admin.slider.edit', 'admin.slider.add.form']) ? 'active subdrop' : '' }}">
                                         <i class="fa fa-sliders-h"></i><span>Sliders</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.sliders') }}" class="{{ request()->routeIs('admin.sliders') ? 'active' : '' }}">Gestion des sliders</a></li>
                                        <li><a href="{{ route('admin.slider.add.form') }}" class="{{ request()->routeIs('admin.slider.add.form') ? 'active' : '' }}">Ajouter un slider</a></li>
									</ul>
								</li> --}}




                                <li class="submenu">
									<a href="{{ route('admin.pages') }}" class="{{ request()->routeIs(['admin.pages', 'admin.page.edit', 'admin.page.add.form', 'admin.sections', 'admin.sliders', 'admin.section.edit','admin.slider.edit']) ? 'active subdrop' : '' }}">
                                         <i class="fa fa-book"></i><span>Gestion des Pages</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.pages') }}" class="{{ request()->routeIs('admin.pages') ? 'active' : '' }}">Toutes les pages</a></li>
                                        <li><a href="{{ route('admin.page.add.form') }}" class="{{ request()->routeIs('admin.page.add.form') ? 'active' : '' }}">Nouvelle page</a></li>
                                        <li><a href="{{ route('admin.sections') }}" class="{{ request()->routeIs('admin.sections') ? 'active' : '' }}">Sections des pages</a></li>
                                        <li><a href="{{ route('admin.sliders') }}" class="{{ request()->routeIs('admin.sliders') ? 'active' : '' }}">Accueil: Sliders</a></li>
									</ul>
								</li>

                                 {{-- <li class="submenu">
									<a href="{{ route('admin.sections') }}" class="{{ request()->routeIs(['admin.sections', 'admin.section.edit', 'admin.section.add.form']) ? 'active subdrop' : '' }}">
                                         <i class="fa fa-layer-group"></i><span>Sections</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
                                        <li><a href="{{ route('admin.sections') }}" class="{{ request()->routeIs('admin.sections') ? 'active' : '' }}">Gestion des sections</a></li>
                                        <li><a href="{{ route('admin.section.add.form') }}" class="{{ request()->routeIs('admin.section.add.form') ? 'active' : '' }}">Ajouter une section</a></li>
									</ul>
								</li> --}}


                                <li class="{{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                                    <a href="{{ route('admin.contacts') }}">
                                        <i class="ti ti-phone"></i>
                                        <span>Contacts </span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.socials.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.socials') }}">
                                        <i class="ti ti-brand-facebook"></i><span>Réseaux Sociaux</span>
                                        <span class="badge badge-primary fs-10 fw-medium text-white p-1">Footer</span>
                                    </a>
                                </li>


                                <li class="menu-title" style="margin-top: 20px" ><span>PARAMÈTRES DU SYSTÈME</span></li>




                                <li class="{{ request()->routeIs('admin.countries') ? 'active' : '' }}">
                                    <a href="{{ route('admin.countries') }}">
                                        <i class="ti ti-world"></i><span>Configurer les Pays</span>
                                    </a>
                                </li>


                                <li class="{{ request()->routeIs('admin.locations') ? 'active' : '' }}">
                                    <a href="{{ route('admin.locations') }}">
                                        <i class="ti ti-map"></i><span>Emplacements</span>
                                    </a>
                                </li>

							</ul>
						</li>

						{{-- <li class="menu-title"><span>ADMINISTRATION</span></li>
						<li>
                            <ul>
                                <li class="submenu">
                                    <a href="javascript:void(0);" class="{{ request()->routeIs('admin.settings.email') || request()->routeIs('admin.settings.maintenance') ? 'active subdrop' : '' }}">
                                        <i class="ti ti-settings"></i><span>Paramètres</span><span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ route('admin.settings.email') }}" class="{{ request()->routeIs('admin.settings.email') ? 'active' : '' }}">Email</a></li>
                                        <li><a href="{{ route('admin.settings.maintenance') }}" class="{{ request()->routeIs('admin.settings.maintenance') ? 'active' : '' }}">Mode Maintenance</a></li>
                                    </ul>
                                </li>
                            </ul>
						</li> --}}

                        <li class="menu-title"><span>MON COMPTE</span></li>
                        <li>
                            <ul>
                                <li class="{{ request()->routeIs('admin.myprofile') ? 'active' : '' }}">
                                    <a href="{{ route('admin.myprofile') }}">
                                        <i class="ti ti-circle-arrow-up"></i><span>Mon Profil</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- <li class="menu-title"><span>FRONTEND</span></li>
						<li>
                            <ul>
                                <li class="{{ request()->routeIs('admin.services') ? 'active' : '' }}">
									<a href="{{ route('admin.services') }}">
										<i class="ti ti-smart-home"></i><span>Services</span>
									</a>
								</li>
                                <li class="{{ request()->routeIs('admin.services') ? 'active' : '' }}">
									<a href="{{ route('admin.services') }}">
										<i class="ti ti-smart-home"></i><span>Emplacements</span>
									</a>
								</li>

                            </ul>
						</li> --}}

						{{-- <li class="menu-title"><span>CONTENT</span></li>
						<li>
							<ul>
								<li>
									<a href="pages.html">
										<i class="ti ti-box-multiple"></i><span>Pages</span>
									</a>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-brand-blogger"></i><span>Blogs</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="blogs.html">All Blogs</a></li>
										<li><a href="blog-categories.html">Categories</a></li>
										<li><a href="blog-comments.html">Comments</a></li>
										<li><a href="blog-tags.html">Blog Tags</a></li>
									</ul>
								</li>
								<li>
									<a href="testimonials.html">
										<i class="ti ti-message-2"></i><span>Testimonials</span>
									</a>
								</li>
								<li>
									<a href="faq.html">
										<i class="ti ti-question-mark"></i><span>FAQ’S</span>
									</a>
								</li>
							</ul>
						</li> --}}
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

