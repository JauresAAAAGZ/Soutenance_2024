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
                                                <h5>Administrateurs</h5>
                                                <a href="{{ route('admins.create') }}" class="btn btn-primary btn-sm ml-3"><i class="ri-add-line"></i> Ajouter</a>
                                            </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Nom</th>
                                                        <th>Email</th>
                                                        
                                                       
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                              
                                                <tbody>
                                                    
                                                    @php
                                                        $cpt=0;
                                                    @endphp
                                                     @foreach($admins as $admin)
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $cpt=$cpt+1;
                                                                    echo $cpt;
                                                                @endphp
                                                            </td>
                                                            
                                                            <td>
                                                                {{ $admin->nomAdmin }}
                                                            </td>

                                                            <td>
                                                                {{ $admin->emailAdmin }}
                                                            </td>
                                                           
                                                          

                                               
                                                           
                                                            <td>
                                                                <a href={{route('admins.show', $admin)}} class="btn btn-sm btn-icon-action" title="Voir"><i class="ri-eye-line"></i></a>
                                                               
                                                                <a href={{route('admins.edit', $admin)}} class="btn btn-sm btn-icon-action" title="Modifier"><i class="ri-edit-line"></i></a>
                                                                <form action={{route('admins.destroy', $admin)}} method="POST" style="display: inline;" id="supprimer-admin-{{ $admin->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" onclick="confirmerSuppression({{ $admin->id }})" class="btn btn-sm btn-icon-action danger" title="Supprimer"><i class="ri-delete-bin-line"></i></button>
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
                Êtes-vous sûr de vouloir supprimer cette admin ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="supprimeradmin()">Supprimer</button>
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
function confirmerSuppression(adminId) {
// Verification que l'ID de l'étudiant est correct
var adminId = parseInt(adminId);

if (isNaN(adminId)) {
return;
}

// Mis à jour de l'attribut data-id de la boîte de dialogue de confirmation avec l'ID de l'étudiant
$('#confirmationModal').attr('data-id', adminId);

// Affichage de la boîte de dialogue de confirmation
$('#confirmationModal').modal('show');
}

function supprimeradmin() {
// Récupération l'ID de l'étudiant à partir de l'attribut data-id de la boîte de dialogue
var adminId = $('#confirmationModal').attr('data-id');

// Fermez la boîte de dialogue de confirmation
$('#confirmationModal').modal('hide');

// Obtenez le formulaire de suppression correspondant à l'ID de l'étudiant et soumettez-le
var form = document.querySelector('form#supprimer-admin-' + adminId);
if (form) {
form.submit();
}
}

</script>
