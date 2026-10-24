@php
    $role = Auth::user()->role_id;

    $accueil = [1 => 'dashetu', 2 => 'dashens', 3 => 'dashadmin', 4 => 'dashExamen'][$role] ?? 'welcome';
    $libelleRole = [1 => 'Étudiant', 2 => 'Professeur', 3 => 'Administrateur', 4 => 'Service examen'][$role] ?? '';

    $pagesUtilisateurs = ['dashadmin1', 'users.*', 'etudiants.*', 'professeurs.*', 'admins.*'];
@endphp

<!-- Sidebar -->
<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">

        <div class="main-menu-header">
            <img class="img-40 img-radius" src={{asset('assets/images/unknown.jpg')}} alt="">
            <div class="user-details">
                <div>{{ Auth::user()->name }}</div>
                <span>{{ $libelleRole }}</span>
            </div>
        </div>

        @if ($role == 2)
            <div class="ef-sidebar-action">
                <a href="{{ route('depots.create') }}" class="btn btn-primary">
                    <i class="ri-add-line"></i> Nouveau dépôt
                </a>
            </div>
        @endif

        <div class="pcoded-navigatio-lavel">Menu</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ request()->routeIs($accueil) ? 'active' : '' }}">
                <a href="{{ route($accueil) }}">
                    <span class="pcoded-micon"><i class="ri-home-7-line"></i></span>
                    <span class="pcoded-mtext">Tableau de bord</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            @if ($role != 3)
                <li class="{{ request()->routeIs('depots.*') ? 'active' : '' }}">
                    <a href="{{ route('depots.index') }}">
                        <span class="pcoded-micon"><i class="ri-folder-3-line"></i></span>
                        <span class="pcoded-mtext">Dépôts</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @endif

            @if ($role == 3)
                <li class="pcoded-hasmenu {{ request()->routeIs($pagesUtilisateurs) ? 'active pcoded-trigger' : '' }}">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="ri-account-pin-circle-line"></i></span>
                        <span class="pcoded-mtext">Utilisateurs</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext">Comptes</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('etudiants.*') ? 'active' : '' }}">
                            <a href="{{ route('etudiants.index') }}">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext">Étudiants</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('professeurs.*') ? 'active' : '' }}">
                            <a href="{{ route('professeurs.index') }}">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext">Professeurs</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admins.*') ? 'active' : '' }}">
                            <a href="{{ route('admins.index') }}">
                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                <span class="pcoded-mtext">Administrateurs</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->routeIs('filieres.*') ? 'active' : '' }}">
                    <a href="{{ route('filieres.index') }}">
                        <span class="pcoded-micon"><i class="ri-contacts-line"></i></span>
                        <span class="pcoded-mtext">Filières</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('niveaux.*') ? 'active' : '' }}">
                    <a href="{{ route('niveaux.index') }}">
                        <span class="pcoded-micon"><i class="ri-layout-horizontal-line"></i></span>
                        <span class="pcoded-mtext">Niveaux</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('matieres.*') ? 'active' : '' }}">
                    <a href="{{ route('matieres.index') }}">
                        <span class="pcoded-micon"><i class="ri-book-marked-line"></i></span>
                        <span class="pcoded-mtext">Matières</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            @endif

            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="pcoded-micon"><i class="ri-logout-box-r-line"></i></span>
                    <span class="pcoded-mtext">Déconnexion</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
    @csrf
</form>
<!-- End of Sidebar -->
