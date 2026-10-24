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
                                                <h5>Étudiants</h5>
                                                <a href="{{ route('etudiants.create') }}" class="btn btn-primary btn-sm ml-3"><i class="ri-add-line"></i> Ajouter</a>
                                            </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Matricule</th>
                                                        <th>Nom</th>
                                                        <th>Prénom</th>
                                                        <th>Email</th>
                                                        <th>Niveau</th>
                                                        <th>Date de naissance</th>
                                                        
                                                        <th>Filière</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                              
                                                <tbody>
                                                    @php
                                                        $cpt=0;
                                                    @endphp                                               
                                                       
                                                    @foreach($etudiants as $etudiant)
                                                        <tr>
                                                            <td>
                                                                @php
                                                                $cpt=$cpt+1;
                                                                echo $cpt;
                                                            @endphp
                                                            </td>
                                                            <td>
                                                            {{ $etudiant->matricule }}
                                                            </td>
                                                            
                                                            <td>
                                                                {{ $etudiant->nomEtudiant }}
                                                            </td>
                                                            <td>
                                                                {{ $etudiant->prenomEtudiant }}
                                                            </td>
                                                            <td>
                                                                {{ $etudiant->emailEtudiant }}
                                                            </td>
                                                            <td>
                                                                @if ($etudiant->niveau)

                                                                {{$etudiant->niveau->diplome_niveau}}
                                                               
                                                                @endif
                                                            </td>

                                                            <td>
                                                                {{ $etudiant->date_naissance_etu }}
                                                            </td>
                                                           
                                                            <td>
                                                                @if ($etudiant->filiere)
                                                                {{$etudiant->filiere->nomFiliere }}
                                                                @endif
                                                            </td>

                                               
                                                           
                                                            <td>
                                                                <a href="{{route('etudiants.show', $etudiant)}}" class="btn btn-sm btn-icon-action" title="Voir"><i class="ri-eye-line"></i></a>
                                                               
                                                                <a href={{route('etudiants.edit', $etudiant)}} class="btn btn-sm btn-icon-action" title="Modifier"><i class="ri-edit-line"></i></a>
                                                                <form action="{{ route('etudiants.destroy', $etudiant) }}" method="POST" style="display: inline;" id="supprimer-etudiant-{{ $etudiant->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" onclick="confirmerSuppression({{ $etudiant->id }})" class="btn btn-sm btn-icon-action danger" title="Supprimer"><i class="ri-delete-bin-line"></i></button>
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
                Êtes-vous sûr de vouloir supprimer cet étudiant ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="supprimerEtudiant()">Supprimer</button>
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
function confirmerSuppression(etudiantId) {
// Verification que l'ID de l'étudiant est correct
var etudiantId = parseInt(etudiantId);

if (isNaN(etudiantId)) {
return;
}

// Mis à jour de l'attribut data-id de la boîte de dialogue de confirmation avec l'ID de l'étudiant
$('#confirmationModal').attr('data-id', etudiantId);

// Affichage de la boîte de dialogue de confirmation
$('#confirmationModal').modal('show');
}

function supprimerEtudiant() {
// Récupération l'ID de l'étudiant à partir de l'attribut data-id de la boîte de dialogue
var etudiantId = $('#confirmationModal').attr('data-id');

// Fermez la boîte de dialogue de confirmation
$('#confirmationModal').modal('hide');

// Obtenez le formulaire de suppression correspondant à l'ID de l'étudiant et soumettez-le
var form = document.querySelector('form#supprimer-etudiant-' + etudiantId);
if (form) {
form.submit();
}
}

</script>
