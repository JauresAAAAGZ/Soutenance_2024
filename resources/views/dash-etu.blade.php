@extends("layout.app")

@section("content")
<?php
    // Retrieve the logged-in user
    $user = Auth::user();
    
    // Retrieve the associated student and their filiere
    $etudiant = $user->etudiant;
    $filiereNom = $etudiant->filiere->nomFiliere;
    $niveau = $etudiant->niveau->diplome_niveau;

    // Fetch depots available for the student's filiere and niveau
    $depotsDisponibles = App\Models\Depot::whereHas('niveaux', function ($query) use ($niveau) {
        $query->where('niveaux.diplome_niveau', $niveau);
    })->whereHas('filieres', function ($query) use ($filiereNom) {
        $query->where('filieres.nomFiliere', $filiereNom);
    })->get();
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
                                                        <h5>
                                                            <?php 
                                                               echo $filiereNom." ".$niveau ;
                                                            ?>
                                                        </h5><br><br>
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
                                        <!-- Data widget start -->
                                        <div class="col-md-12 col-xl-6">
                                            <div class="card project-task">
                                                <div class="card-header">
                                                    <div class="card-header-left ">
                                                        <h5>Dépôts disponibles &amp; exercices</h5>
                                                    </div>
                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li><i class="icofont icofont-simple-left "></i></li>
                                                            <li><i class="icofont icofont-maximize full-card"></i></li>
                                                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                                                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-block p-b-10">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Dépôts</th>
                                                                    <th>Temps restant</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($depotsDisponibles as $depot)
                                                                <tr>
                                                                    <td>
                                                                        <a href={{ route('depots.show', $depot) }}>
                                                                            <div class="task-contain">
                                                                                <h6 class="bg-c-blue d-inline-block text-center">{{ substr($depot->nomDepot, 0, 1) }}</h6>
                                                                                <p class="d-inline-block m-l-20">{{ $depot->nomDepot }}</p>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td id="remaining-time-{{ $depot->id }}"></td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Data widget End -->
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

<script>
    // Fonction pour mettre à jour le temps restant pour chaque dépôt
    function updateRemainingTime() {
        <?php foreach($depotsDisponibles as $depot): ?>
            var creationDate = new Date('<?php echo $depot->dateCreation; ?>');
            var closureDate = new Date('<?php echo $depot->dateFermeture; ?>');
            var remainingTime = closureDate - new Date();
            
            if (remainingTime <= 0) {
                document.getElementById('remaining-time-<?php echo $depot->id; ?>').textContent = 'Expiré';
            } else {
                var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                remainingTime -= days * (1000 * 60 * 60 * 24);
                var hours = Math.floor(remainingTime / (1000 * 60 * 60));
                remainingTime -= hours * (1000 * 60 * 60);
                var minutes = Math.floor(remainingTime / (1000 * 60));
                remainingTime -= minutes * (1000 * 60);
                var seconds = Math.floor(remainingTime / 1000);
    
                document.getElementById('remaining-time-<?php echo $depot->id; ?>').textContent = days + "d " + hours + "h " + minutes + "m " + seconds + "s";
            }
        <?php endforeach; ?>
    }

    // Mettre à jour le temps restant toutes les secondes
    setInterval(updateRemainingTime, 1000);
    
    // Appeler la fonction une fois pour afficher le temps restant initial
    updateRemainingTime();
</script>

@endsection