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
                                                <h5>Liste des professeurs</h5>
                                                <a href="{{ route('professeurs.create') }}" class="btn btn-info">Ajouter</a>

                                                <div class="card-header-right">    <ul class="list-unstyled card-option">        <li><i class="icofont icofont-simple-left "></i></li>        <li><i class="icofont icofont-maximize full-card"></i></li>        <li><i class="icofont icofont-minus minimize-card"></i></li>        <li><i class="icofont icofont-refresh reload-card"></i></li>        <li><i class="icofont icofont-error close-card"></i></li>    </ul></div>
                                            </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Numero Employe</th>
                                                        <th>Nom</th>
                                                        <th>Prenom</th>
                                                        <th>Courriel</th>
                                                       
                                                        <th>Date_Naissance</th>
                                                        
                                                        <th>Matières enseignées</th>
                                                        <th>Opérations</th>
                                                    </tr>
                                                </thead>
                                              
                                                <tbody>
                                                    @php
                                                     $cpt=0;
                                                    @endphp
                                                    @foreach($professeurs as $professeur)
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $cpt=$cpt+1;
                                                                    echo $cpt;
                                                                @endphp
                                                            </td>
                                                            <td>
                                                            {{ $professeur->numEmploye }}
                                                            </td>
                                                            
                                                            <td>
                                                                {{ $professeur->nomProfesseur }}
                                                            </td>
                                                            <td>
                                                                {{ $professeur->prenomProfesseur }}
                                                            </td>
                                                            <td>
                                                                {{ $professeur->emailProfesseur }}
                                                            </td>
                                                            

                                                            <td>
                                                                {{ $professeur->date_naissance_prof }}
                                                            </td>
                                                           
                                                            <td>
                                                               
                                                               @foreach($professeur->matieres as $matiere)
                                                               {{ $matiere->intitule}} 
                                                            @endforeach
                                                            </td>

                                               
                                                           
                                                            <td>
                                                                <a href="{{route('professeurs.show', $professeur)}}" class="btn btn-info">Voir</a>
                                                               
                                                                <a href={{route('professeurs.edit', $professeur)}} class="btn btn-primary">Modifier</a>
                                                                <form action="{{ route('professeurs.destroy', $professeur) }}" method="POST" style="display: inline;" id="supprimer-professeur-{{ $professeur->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" onclick="confirmerSuppression({{ $professeur->id }})" class="btn btn-danger">Supprimer</button>
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
                Êtes-vous sûr de vouloir supprimer cet professeur ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="supprimerprofesseur()">Supprimer</button>
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
function confirmerSuppression(professeurId) {
// Verification que l'ID de l'professeur est correct
var professeurId = parseInt(professeurId);

if (isNaN(professeurId)) {
return;
}

// Mis à jour de l'attribut data-id de la boîte de dialogue de confirmation avec l'ID de l'professeur
$('#confirmationModal').attr('data-id', professeurId);

// Affichage de la boîte de dialogue de confirmation
$('#confirmationModal').modal('show');
}

function supprimerprofesseur() {
// Récupération l'ID de l'professeur à partir de l'attribut data-id de la boîte de dialogue
var professeurId = $('#confirmationModal').attr('data-id');

// Fermez la boîte de dialogue de confirmation
$('#confirmationModal').modal('hide');

// Obtenez le formulaire de suppression correspondant à l'ID de l'professeur et soumettez-le
var form = document.querySelector('form#supprimer-professeur-' + professeurId);
if (form) {
form.submit();
}
}

</script>
