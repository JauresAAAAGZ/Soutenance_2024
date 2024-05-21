@extends("layout.app")

@section("content")

<!-- Pre-loader start -->
<div class="theme-loader">
    <!-- Loader content -->
</div>
<!-- Pre-loader end -->
<?php
    // Récupérer l'utilisateur connecté
    $user = Auth::user();
    if(Auth::user()->role_id==2){ $professeur = $user->professeur;
    
        $depotsDisponibles = App\Models\Depot::where('professeur_id', $professeur->id)->get();
    }
    
    // Récupérer l'objet Professeur associé à l'utilisateur connecté
    if(Auth::user()->role_id==1){ 
        $etudiant = $user->etudiant;
        $niveauEtudiant = $etudiant->niveau->id;
        $filiereEtudiant = $etudiant->filiere->id;
    
    }
    ?>


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
                                   

                                    <!-- Your card content -->
    <div class="container-fluid"> 

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 style="text-align: center">Liste des répertoires</h4>
                <!-- Search bar -->
                <form action="{{ route('depots.index') }}" method="GET" class="mt-4">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Recherchez par nom ou description" value="{{ request('q') }}">
                        <button type="submit" class="btn btn-primary"><i class="ri-seo-line" style="font-size: 20px"></i></button>
                    </div>
                </form>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Trier par
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('depots.index', ['sort' => 'latest']) }}">Du plus récent au plus ancien</a>
                        <a class="dropdown-item" href="{{ route('depots.index', ['sort' => 'oldest']) }}">Du plus ancien au plus récent</a>
                        <a class="dropdown-item" href="{{ route('depots.index', ['sort' => 'alphabetical']) }}">Ordre alphabétique</a>
                    </div>
                </div>
                
            </div>
        </div>
        
    @if(session('message'))
    <div id="success-message" class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    @if(session('error'))
    <div id="success-message" class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if(session('danger'))
    <div id="success-message" class="alert alert-danger">
        {{ session('danger') }}
    </div>
    @endif
    <div class="row">
        @php
            $colors = ['#ff7eb9', '#85e085', '#ffcc80', '#80dfff', '#80deea'];
            $colorIndex = 0;
        @endphp

        @if (isset($depotsDisponibles))
        @foreach ($depotsDisponibles as $depot )
        
        <!-- Professeur -->
        @if (Auth::user()->role_id==2)
            <div class="col-md-4 mt-3">
                <div class="  card">
                    <div class="position-relative">
                        <div class="random-bg-color position-absolute" style="background-color: {{ $colors[$colorIndex % count($colors)] }}; border-radius: 5px 5px 0 0">
                            <div class="card-header d-flex justify-content-between align-items-start">
                                <h5 class="card-title" style="font-size: 18px">{{ $depot->nomDepot }}</h5>

                                <div class="dropdown">
                                    <button class="btn btn-unstyled" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                       
                                        <i class="ri-more-fill"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        
                                        <li><a class="dropdown-item" href="{{ route('depots.show', $depot) }}">Consulter</a></li>
                                        <li><a class="dropdown-item" href="{{ route('depots.edit', $depot) }}">Modifier</a></li>

                                        @if ($depot->etat == 'fermé')
                                            <li><a class="dropdown-item" href="{{ route('depots.students', $depot) }}">Notes</a></li>
                                        @endif
                                       
                                        <li>
                                            <form action="{{ route('depots.destroy', $depot) }}" method="POST" style="display: inline;" id="supprimer-depot-{{ $depot->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button style="color:red;" type="button" class="dropdown-item" onclick="confirmerSuppression({{ $depot->id }})">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </li>
                                       
                                    </ul>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ $depot->description }}</p> 
                    </div>
                    <div class="card-footer" style="border-radius: 0 0 5px 5px">
                        <hr>
                        @if ($depot->etat != 'fermé')
                       
                        <p>
                            <i class="ri-timer-line" style="font-size: 20px;">:</i>  <!-- Icon markup -->
                            <span id="countdown_{{ $depot->id }}" style="font-size: 20px;"></span> <!-- Countdown timer -->
                        </p>
                        @else
                            <i class="ri-timer-line" style="font-size: 25px;">: Expiré</i>
                        @endif
                       
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    @endif
        @foreach ($depots as $depot )
            <!-- Etudiant -->
            @if (Auth::user()->role_id==1)
            

                @php
                    $niveauxDepot = $depot->niveaux->pluck('id')->toArray();
                    $filieresDepot = $depot->filieres->pluck('id')->toArray();
                @endphp
            
                @if (in_array($niveauEtudiant, $niveauxDepot) && in_array($filiereEtudiant, $filieresDepot))
                <div class="col-md-4 mt-3">
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
                            <div clas="d-flex justify-content-between">

                                <a href={{route('depots.show', $depot)}}> <button class="btn btn-secondary" >Consulter</button> </a>
                                <a href={{ route('depots.downloadProfessorFiles', $depot->id) }}> <button class="btn btn-primary ">Resources</button> </a>

                            </div>
                            
                            <hr>
                        @if ($depot->etat != 'fermé')
                            
                            <p>
                                <i class="ri-timer-line"></i> : <!-- Icon markup -->
                                <span id="countdown_{{ $depot->id }}" style="font-size: 20px;"></span> <!-- Countdown timer -->
                            </p>
                        @else
                            <i class="ri-timer-line" style="font-size: 20px">: Expired</i>
                        @endif
                            
                        </div>
                    </div>
                </div>
        @endif
        
        @endif
        @endforeach

        @foreach ($depots as $depot )

                    <!--serviceExamen-->
                
        @if (Auth::user()->role_id==4)
        <div class="col-md-4 mt-3">
            <a href="{{ route('depots.show', $depot) }}" style="color: black">
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
                    <hr>
                    @if ($depot->etat != 'fermé')
                   
                    <p>
                        <i class="ri-timer-line" style="font-size: 20px;">:</i>  <!-- Icon markup -->
                        <span id="countdown_{{ $depot->id }}" style="font-size: 20px;"></span> <!-- Countdown timer -->
                    </p>
                    @else
                        <i class="ri-timer-line" style="font-size: 25px;">: Expiré</i>
                    @endif
                   
                </div>
            </div>
         </a>
        </div>
        @endif
                <!--serviceExamenEnd-->

        @endforeach

            @php $colorIndex++; @endphp
        
    </div>
</div>
<script>
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
            
            // Display the result in the element with depoid"
            document.getElementById("countdown_" + depotId).innerHTML = days + "j " + hours + "h "
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
    @foreach ($depots as $depot )
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

</body>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce depot ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="supprimerdepot()">Supprimer</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce depot ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="supprimerdepot()">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successMessage = document.getElementById('success-message');

        if (successMessage) {
            // Set the timeout in milliseconds (e.g., 5000ms = 5 seconds)
            var timeout = 3000;

            // Automatically dismiss the success message after the timeout
            setTimeout(function () {
                successMessage.style.display = 'none'; // Hide the message
            }, timeout);
        }
    });

    $(document).ready(function(){
        // Close modal when close button or Cancel button is clicked
        $('#confirmationModal .close, #confirmationModal .btn-secondary').click(function(){
            $('#confirmationModal').modal('hide');
        });
    });

    function confirmerSuppression(depotId) {
        // Verification que l'ID de l'étudiant est correct
        var depotId = parseInt(depotId);

        if (isNaN(depotId)) {
            return;
        }

        // Mis à jour de l'attribut data-id de la boîte de dialogue de confirmation avec l'ID de l'étudiant
        $('#confirmationModal').attr('data-id', depotId);

        // Affichage de la boîte de dialogue de confirmation
        $('#confirmationModal').modal('show');
    }

    function supprimerdepot() {
    // Récupérer l'ID du dépôt à partir de l'attribut data-id de la boîte de dialogue
    var depotId = $('#confirmationModal').attr('data-id');

    // Fermer la boîte de dialogue de confirmation
    $('#confirmationModal').modal('hide');

    // Obtenir le formulaire de suppression correspondant à l'ID du dépôt et le soumettre
    var form = document.querySelector('form#supprimer-depot-' + depotId);
    if (form) {
        form.submit();
    }
}

</script>
