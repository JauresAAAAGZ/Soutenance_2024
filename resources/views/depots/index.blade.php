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

                                        @if(session('message'))
                                        <div id="success-message" class="alert alert-success">
                                            {{session('message')}}
                                        </div>
                                        @endif
                                        @if(session('message1'))
                                        <div id="success-message" class="alert alert-success">
                                            {{session('message1')}}
                                        </div>
                                        @endif
                                        @if(session('danger'))
                                        <div id="success-message" class="alert alert-danger">
                                            {{session('danger')}}
                                        </div>
                                        @endif
                                        @if(session('error'))
                                        <div id="success-message" class="alert alert-danger">
                                            {{session('error')}}
                                        </div>
                                        @endif
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Liste des répertoires</h5>
                                                <a href="{{ route('depots.create') }}" class="btn btn-info">Ajouter</a>

                                                <div class="card-header-right">    <ul class="list-unstyled card-option">        <li><i class="icofont icofont-simple-left "></i></li>        <li><i class="icofont icofont-maximize full-card"></i></li>        <li><i class="icofont icofont-minus minimize-card"></i></li>        <li><i class="icofont icofont-refresh reload-card"></i></li>        <li><i class="icofont icofont-error close-card"></i></li>    </ul></div>
                                            </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Matiere N°</th>
                                                        <th>Intitule</th>
                                                        <th>Code Matiere</th>
                                                        <th>Duree</th>
                                                       
                                                        <th>Opérations</th>
                                                    </tr>
                                                </thead>
                                              
                                                <tbody>
                                                    @php
                                                    $cpt=0;
                                                   @endphp
                                                    @foreach($matieres as $matiere)
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $cpt=$cpt+1;
                                                                    echo $cpt;
                                                                @endphp
                                                            </td>
                                                            
                                                            <td>
                                                                {{ $matiere->intitule }}
                                                            </td>
                                                            <td>
                                                                {{ $matiere->codeMatiere }}
                                                            </td>
                                                            <td>
                                                                {{ $matiere->duree }}
                                                            </td>
                                                          

                                               
                                                           
                                                            <td>
                                                                <a href={{route('matieres.show', $matiere)}} class="btn btn-info">Voir</a>
                                                               
                                                                <a href={{route('matieres.edit', $matiere)}} class="btn btn-primary">Modifier</a>
                                                                <form action={{route('matieres.destroy', $matiere)}} method="POST" style="display: inline;" id="supprimer-matiere-{{ $matiere->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" onclick="confirmerSuppression({{ $matiere->id }})" class="btn btn-danger">Supprimer</button>
                                                                </form>
                                                            </td>
                                    
                                                        </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                            
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
                Êtes-vous sûr de vouloir supprimer cette matiere ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="supprimermatiere()">Supprimer</button>
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
</script>
<script>
function confirmerSuppression(matiereId) {
// Verification que l'ID de l'étudiant est correct
var matiereId = parseInt(matiereId);

if (isNaN(matiereId)) {
return;
}

// Mis à jour de l'attribut data-id de la boîte de dialogue de confirmation avec l'ID de l'étudiant
$('#confirmationModal').attr('data-id', matiereId);

// Affichage de la boîte de dialogue de confirmation
$('#confirmationModal').modal('show');
}

function supprimermatiere() {
// Récupération l'ID de l'étudiant à partir de l'attribut data-id de la boîte de dialogue
var matiereId = $('#confirmationModal').attr('data-id');

// Fermez la boîte de dialogue de confirmation
$('#confirmationModal').modal('hide');

// Obtenez le formulaire de suppression correspondant à l'ID de l'étudiant et soumettez-le
var form = document.querySelector('form#supprimer-matiere-' + matiereId);
if (form) {
form.submit();
}
}

</script>
