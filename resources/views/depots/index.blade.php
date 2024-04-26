@extends("layout.app")

@section("content")

<?php
    // Récupérer l'utilisateur connecté
    $user = Auth::user();
    if(Auth::user()->role_id==2){ $professeur = $user->professeur;}
    // Récupérer l'objet Professeur associé à l'utilisateur connecté
    if(Auth::user()->role_id==1){ 
        $etudiant = $user->etudiant;
        $niveauEtudiant = $etudiant->niveau->id;
        $filiereEtudiant = $etudiant->filiere->id;
    
    }
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

                                    <!-- Your card content -->
                                    <div class="container-fluid">
                                        <div class="card-header">
                                            <h4>Liste des répertoires</h4>
                                        </div>

                                        <!-- Professeur -->
                                        @if (Auth::user()->role_id==2)

                                        <div class="row">
                                            @foreach ($depots as $depot )
                                            <div class="col-md-4 mt-3 ms-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $depot->nomDepot }}</h5>
                                                        <small>{{ $depot->description }}</small>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="d-flex justify-content-between">
                                                        <a href="#" class="btn btn-danger mb-3">Fermer</a>
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Options
                                                            </button>
                                                            <ul class="dropdown-content" >
                                                                <li><a class="dropdown-item" href={{route('depots.show', $depot)}}>Consulter</a></li>
                                                                <li><a class="dropdown-item" href={{route('depots.edit', $depot)}}>Modifier</a></li>
                                                                <li>
                                                                    <form action="{{ route('depots.destroy', $depot) }}" method="POST" style="display: inline;" id="supprimer-depot-{{ $depot->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" onclick="confirmerSuppression({{ $depot->id }})" class="btn btn-danger">Supprimer</button>
                                                                    </form></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif

                                        <!-- Etudiant -->
                                        @if (Auth::user()->role_id==1)
                                           
                                                <div class="row">
                                                    @foreach ($depots as $depot )

                                                    @php
                                                        $niveauxDepot = $depot->niveaux->pluck('id')->toArray();
                                                        $filieresDepot = $depot->filieres->pluck('id')->toArray();
                                                    @endphp
                                                
                                                    @if (in_array($niveauEtudiant, $niveauxDepot) && in_array($filiereEtudiant, $filieresDepot))
                                                        <div class="col-md-4 mt-3 ms-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">{{ $depot->nomDepot }}</h5>
                                                                    <small>{{ $depot->description }}</small>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <a href={{route('depots.show', $depot)}} class="btn btn-primary mb-3">Consulter</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                </div>
                                            @endif
                                            @endforeach
                                        @endif
                                        
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
        // Récupération l'ID de l'étudiant à partir de l'attribut data-id de la boîte de dialogue
        var depotId = $('#confirmationModal').attr('data-id');

        // Fermez la boîte de dialogue de confirmation
        $('#confirmationModal').modal('hide');

        // Obtenez le formulaire de suppression correspondant à l'ID de l'étudiant et soumettez-le
        var form = document.querySelector('form#supprimer-depot-' + depotId);
        if (form) {
            form.submit();
        }
    }
</script>
