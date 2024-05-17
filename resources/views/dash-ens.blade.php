@extends("layout.app")

@section("content")
<?php
    // Retrieve the logged-in user
    $user = Auth::user();
    
    // Retrieve the associated professor
    $professeur = $user->professeur;

    // Fetch depots associated with the professor
    $depotsDisponibles = App\Models\Depot::where('professeur_id', $professeur->id)->get();
?>

<!-- Pre-loader start -->
<div class="theme-loader">
    <!-- Loader content -->
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
                                                        <br>
                                                        <br>
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
                                                <h5 id="liste" style="text-align: center; font: small-caps bold 24px/1 sans-serif" class="mt-3">Liste des Options</h5>
                                                <div class="card-block-small text-center d-flex justify-content-between">
                                                    <!-- Bouton "Créer un dépot" -->
                                                    <a class="btn btn-warning rounded-pill mb-3 d-block" href="{{ route('depots.create') }}">Créer un dépot</a>
                                                    <!-- Bouton "Dépots supprimés" -->
                                                    <a class="btn btn-warning rounded-pill mb-3 d-block" href="">Dépots supprimés</a>
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <!-- card2 end -->                                     
                                          <!-- Your card content -->
    <div class="container-fluid"> 

        <div class="card-header">
            <h4 id="liste" style="text-align:center; font: small-caps bold 24px/1 sans-serif" class="mt-1">Liste des Depots</h4>
        </div>
        <div class="row">
            @php
                $colors = ['#ff7eb9', '#85e085', '#ffcc80', '#80dfff', '#80deea'];
                $colorIndex = 0;
            @endphp
    
    
            @foreach ( $depotsDisponibles as $depot )
            
            <!-- Professeur -->
            @if (Auth::user()->role_id==2)
               
                <div class="col-md-4 mt-3">
                    <a href={{route('depots.show',$depot)}} style="color:black">
                    <div class="card-depot card">
                        <div class="position-relative">
                            <div class="random-bg-color position-absolute" style="background-color: {{ $colors[$colorIndex % count($colors)] }}; border-radius: 5px 5px 0 0">
                                <div class="card-header d-flex justify-content-between align-items-start">
                                    <h5 class="card-title" style="font-size: 18px">{{ $depot->nomDepot }}</h5>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>{{ $depot->description }}</p> 
                        </div>
                        
                        <div class="card-footer" style="border-radius: 0 0 5px 5px">
                            <p style="">
                                Date de fermeture: {{ $depot->dateFermeture }}
                            </p>
                            <hr>
                            @if ($depot->etat == 'fermé')
                            <i class="ri-timer-line" style="font-size: 25px;">: Expired</i>
                            <br>
                            @else
                                <p>
                                    <i class="ri-timer-line" style="font-size: 20px;">:</i>  <!-- Icon markup -->
                                    <span id="countdown_{{ $depot->id }}" style="font-size: 20px;"></span> <!-- Countdown timer -->
                                </p>
                            @endif
                           
                        </div>
                    </div>
                </a>
                </div>
           
                @endif
                @php $colorIndex++; @endphp
                @endforeach
            </div>
        </div>
        <script>
            // Function to confirm suppression
            function confirmerSuppression(depotId) {
                if (confirm("Êtes-vous sûr de vouloir supprimer ce dépôt ?")) {
                    // If the user confirms, submit the form
                    document.getElementById('supprimer-depot-' + depotId).submit();
                } else {
                    // If the user cancels, do nothing
                    return false;
                }
            }
            
            // Function to update countdown for each depot
            function updateCountdown(depotId, closingDate) {
                // Set the date we're counting down to
                var countDownDate = new Date(closingDate).getTime();
        
                // Update the countdown every 1 second
                var x = setInterval(function() {
        
                    // Get the current date and time
                    var now = new Date().getTime();
                    
                    // Calculate the distance between now and the count down date
                    var distance = countDownDate - now;
                    
                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    
                    
                    document.getElementById("countdown_" + depotId).innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";
                    
                    // If the count down is finished, display expired message
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("countdown_" + depotId).innerHTML = "Expiré";
                        
                        updateDepotEtat(depotId);
                    }
                }, 1000);
            }
        
            // Call updateCountdown function for each depot
            @foreach ( $depotsDisponibles as $depot )
                updateCountdown({{ $depot->id }}, "{{ $depot->dateFermeture }}");
            @endforeach
        
            // Function to update the état of the dépôt to "fermé"
            function updateDepotEtat(depotId) {
        
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                // Send an Ajax request to update the état of the dépôt
                $.ajax({
                    url: '/update-depot-etat/' + depotId,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
        
                    success: function(response) {
                        // Handle success response if needed
                        console.log(response);
                    },
                    error: function(xhr) {
                        // Handle error response if needed
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection