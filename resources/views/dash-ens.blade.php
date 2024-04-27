@extends("layout.app")

<body>
    @section("content")
        <!-- Pre-loader start -->
        <div class="theme-loader">
            <div class="ball-scale">
                <div class='contain'>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                    <div class="ring">
                        <div class="frame"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pre-loader end -->

        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                @include("partial.headbar")
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        @include("partial.sidebar")
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <div class="page-body">
                                            <div class="row">
                                                <!-- card1 start -->
                                                <div class="col-md-8 col-xl-6">
                                                    <div class="card widget-card-1">
                                                        <div class="card-block-small">
                                                            <!-- Première instance de card-block-small -->
                                                            <div class="card-block-small">
                                                                <i class="icofont icofont-ui-home bg-c-pink card1-icon"></i>
                                                                <span class="text-viber f-w-600">WELCOME <?php                           
                                                                    $name = Auth::user()->name;
                                                                    $words = explode(' ', $name); // Sépare la chaîne par les espaces
                                                                    $truncatedName = implode(' ', array_slice($words, 0, 2)); // Prend les deux premiers éléments et les réunit
                                                                    echo $truncatedName;?>
                                                                </span>
                                                                <br>
                                                                <br>
                                                                <!-- Bouton Statut -->
                                                                <a href="" target="_blank" class="statut-button">
                                                                    <i class="icofont icofont-info-circle"></i>
                                                                    Statut
                                                                </a>
                                                                <!-- Affichage de l'heure -->
                                                                <div>
                                                                    <span id="current-time" class="f-left m-t-10 text-muted">
                                                                        <i class="text-c-pink f-16 icofont icofont-calendar m-r-10"></i>
                                                                        <script>
                                                                            // Fonction pour mettre à jour l'heure actuelle
                                                                            function updateCurrentTime() {
                                                                                var currentTime = new Date();
                                                                                var formattedDateTime = currentTime.toLocaleString('fr-FR', { weekday: 'long', day: '2-digit', month: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                                                                                document.getElementById('current-time').textContent = formattedDateTime;
                                                                            }
                                                                            
                                                                            // Mettre à jour l'heure toutes les secondes
                                                                            setInterval(updateCurrentTime, 1000);
                                                                            
                                                                            // Appeler la fonction une fois pour afficher l'heure actuelle
                                                                            updateCurrentTime();
                                                                        </script>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card1 end -->
                                                <!-- card2 start -->
                                                <div class="col-md-8 col-xl-6 d-inline-block">
                                                    <div class="card widget-card-1">
                                                        <div class="card-block-small text-center d-flex justify-content-between">
                                                            <!-- Bouton "Créer un dépot" -->
                                                            <a class="btn btn-warning rounded-pill mb-3 d-block" href="{{ route('depots.create') }}">Créer un dépot</a>
                                                            <!-- Bouton "Dépots supprimés" -->
                                                            <a class="btn btn-warning rounded-pill mb-3 d-block" href="">Dépots supprimés</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                                <!-- card2 end -->
                                            </div>
                                            <!-- row end -->
                                            <!-- iframe start -->
                                                
                                            <!-- iframe end -->
                                        </div>
                                        <!-- page-body end -->
                                    </div>
                                    <!-- page-wrapper end -->
                                </div>
                                <!-- main-body end -->
                            </div>
                            <!-- pcoded-inner-content end -->
                        </div>
                        <!-- pcoded-content end -->
                    </div>
                    <!-- pcoded-wrapper end -->
                </div>
                <!-- pcoded-main-container end -->
            </div>
            <!-- pcoded-container navbar-wrapper end -->
        </div>
        <!-- pcoded end -->
    @endsection
</body>