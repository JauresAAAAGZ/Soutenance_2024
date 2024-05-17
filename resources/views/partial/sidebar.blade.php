 <!-- Sidebar -->
 <nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        @if(  Auth::user()->role_id == 3  )
        <div class="">
            <div class="main-menu-header">
                <img class="img-40 img-radius" src={{asset('assets/images/unknown.jpg')}} alt="User-Profile-Image">
                <div class="user-details">
                    <div>{{ Auth::user()->name }}</div>

                    <span id="more-details">{{ Auth::user()->role->nomRole }}<i class="ti-angle-down"></i></span>
                </div>
            </div>

            
            

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="#"><i class="ti-user"></i>Profile</a>
                       

                       <!-- Authentication deconnexion-->
                       <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="ti-layout-sidebar-left"></i>{{ __('Deconnexion') }}
                        </x-dropdown-link>
                        </form>
                    
                    </li>
                </ul>
            </div>
        
        </div>
        @endif

        @if ( Auth::user()->role_id == 2 )

            <div class=""> 
                <div class="main-menu-header">
                   <a href={{route('depots.create')}}><button>Nouveau Dossier <i class="ri-add-line"></i></button></a> 
                </div>
            </div>
           
        @endif

       
       
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menus</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="active">

                @if(  Auth::user()->role_id == 1  )

                    <a href={{route('dashetu')}}>
                @endif

                @if(  Auth::user()->role_id == 2  )

                    <a href={{route('dashens')}}>
                @endif

                @if(  Auth::user()->role_id == 3  )

                    <a href={{route('dashadmin')}}>
                @endif

                    <span class="pcoded-micon"><i class="ri-home-7-line"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
           
            <li class="pcoded-hasmenu">

                <!--Start Sidebar Etudiant -->
                @if(  Auth::user()->role_id == 1  )

                <li class="active">
                    <a href={{route('depots.index')}}>
                        <span class="pcoded-micon"><i class="ri-folder-3-line"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dossiers</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <ul class="pcoded-submenu">
                   
                @endif
                <!--End Sidebar Etudiant -->

                <!--Start Sidebar Prof -->
                @if(  Auth::user()->role_id == 2  )

                
                <ul class="pcoded-item pcoded-left-item">
                    <li class="active">
                        <a href="{{ route('depots.index') }}">
                            <span class="pcoded-micon"><i class="ri-folder-3-line"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Dossiers</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <!-- Other Main Menu Items -->
                </ul>
               

                <!-- Other Sidebar Items -->
            
                   

                @endif
                <!--End Sidebar Prof-->


                <!--Start Sidebar Admin -->

                @if(  Auth::user()->role_id == 3  )

                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ri-account-pin-circle-fill"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Gestions des Utilisateurs</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href={{route('users.index')}}>
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Comptes utilisateurs</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href={{route('etudiants.index')}}>
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Etudiants</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href={{route('professeurs.index')}}>
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Professeurs</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href={{route('admins.index')}}>
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Admin</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    

                </ul>

                @endif

               

                

            </li>

            @if(  Auth::user()->role_id == 3  )

            <li> 
                    <a href={{route('filieres.index')}}>   

                        <span class="pcoded-micon"><i class="ri-contacts-fill"></i><b>D</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Gestion des Filieres</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
            </li>

            <li> 
                <a href={{route('niveaux.index')}}>   

                    <span class="pcoded-micon"><i class="ri-layout-horizontal-fill"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Gestion des Niveaux</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li> 
                <a href={{route('matieres.index')}}>   

                    <span class="pcoded-micon"><i class="ri-book-marked-fill"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Gestion des Matières</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            @endif
             <!--End Sidebar Admin-->
        

       
            
        
             @if(  Auth::user()->role_id == 2  )
        <li class="active">
            <a href="">
                <span class="pcoded-micon"><i class="ri-delete-bin-5-line"></i><b>D</b></span>
                <span class="pcoded-mtext" data-i18n="nav.dash.main">Corbeille</span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
        @endif
       
        
        <ul class="pcoded-item pcoded-left-item">
            <li class="active">
                <a href="">
                    <span class="pcoded-micon"><i class="ri-logout-box-r-line"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Deconnexion') }}
                            </li>
                        </form>
                    </span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
                    
</nav>
<!-- End of Sidebar -->
