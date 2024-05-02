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
                                                <h5>Liste des niveaux</h5>
                                                <a href="{{ route('niveaux.create') }}" class="btn btn-info" style="border-radius: 150px">Ajouter <i class="ri-add-circle-line"></i></a>

                                                <div class="card-header-right">    <ul class="list-unstyled card-option">        <li><i class="icofont icofont-simple-left "></i></li>        <li><i class="icofont icofont-maximize full-card"></i></li>        <li><i class="icofont icofont-minus minimize-card"></i></li>        <li><i class="icofont icofont-refresh reload-card"></i></li>            </ul></div>
                                            </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Niveau n°</th>
                                                        <th>Diplome et année</th>
                                                        <th>Code niveau</th>
                                                       
                                                       
                                                        <th>Opérations</th>
                                                    </tr>
                                                </thead>
                                              
                                                <tbody>
                                                    @php
                                                    $cpt=0;
                                                   @endphp
                                                    @foreach($niveaux as $niveau)
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $cpt=$cpt+1;
                                                                    echo $cpt;
                                                                @endphp
                                                            </td>
                                                            
                                                            <td>
                                                                {{ $niveau->diplome_niveau }}
                                                            </td>
                                                            <td>
                                                                {{ $niveau->codeNiveau }}
                                                            </td>
                                                           
                                                          

                                               
                                                           
                                                            <td>
                                                                <a href={{route('niveaux.show', $niveau)}} class="btn btn-info" style="border-radius: 200px"><i class="ri-eye-line" style="font-size: 20px"></i></a>
                                                               
                                                                <a href={{route('niveaux.edit', $niveau)}} class="btn btn-primary" style="border-radius: 200px"><i class="ri-edit-box-fill" style="font-size: 20px"></i></a>
                                                                <form action={{route('niveaux.destroy', $niveau)}} method="POST" style="display: inline;" id="supprimer-niveau-{{ $niveau->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" onclick="confirmerSuppression({{ $niveau->id }})" class="btn btn-danger" style="border-radius: 200px"><i class="ri-delete-bin-7-fill" style="font-size: 20px"></i></button>
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
                Êtes-vous sûr de vouloir supprimer cette niveau ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="supprimerniveau()" >Supprimer</button>
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
function confirmerSuppression(niveauId) {
// Verification que l'ID du  niveau est correct
var niveauId = parseInt(niveauId);

if (isNaN(niveauId)) {
return;
}

// Mis à jour de l'attribut data-id de la boîte de dialogue de confirmation avec l'ID du niveau
$('#confirmationModal').attr('data-id', niveauId);

// Affichage de la boîte de dialogue de confirmation
$('#confirmationModal').modal('show');
}

function supprimerniveau() {
// Récupération l'ID de l'niveau à partir de l'attribut data-id de la boîte de dialogue
var niveauId = $('#confirmationModal').attr('data-id');

// Fermez la boîte de dialogue de confirmation
$('#confirmationModal').modal('hide');

// Obtenez le formulaire de suppression correspondant à l'ID de l'niveau et soumettez-le
var form = document.querySelector('form#supprimer-niveau-' + niveauId);
if (form) {
form.submit();
}
}

</script>
