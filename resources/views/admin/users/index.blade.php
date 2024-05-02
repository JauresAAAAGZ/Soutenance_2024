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
                                                <h5>Liste des Compte Utilisateurs</h5>
                                                <a href="{{ route('users.create') }}" class="btn btn-info" style="border-radius: 150px">Ajouter <i class="ri-add-circle-line"></i></a>

                                                <div class="card-header-right">    <ul class="list-unstyled card-option">        <li><i class="icofont icofont-simple-left "></i></li>        <li><i class="icofont icofont-maximize full-card"></i></li>        <li><i class="icofont icofont-minus minimize-card"></i></li>        <li><i class="icofont icofont-refresh reload-card"></i></li>            </ul></div>
                                            </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Nom</th>
                                                        <th>Courriel</th>
                                                        <th>Mot de passe</th>
                                                        <th>Role</th>
                                                        <th>Opérations</th>
                                                    </tr>
                                                </thead>
                                              @php
                                                  $cpt=0;
                                              @endphp
                                                <tbody>
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $cpt=$cpt+1;
                                                                    echo $cpt;
                                                                 @endphp
                                                            </td>
                                                            
                                                            <td>
                                                            {{ $user->name }}
                                                            </td>
                                                            
                                                            <td>
                                                                {{ $user->email }}
                                                            </td>
                                                            <td>
                                                                {{ $user->password }}
                                                            </td>
                                                          
                                                            <td>
                                                                @if ($user->role)

                                                                {{$user->role->nomRole}}
                                                               
                                                                @endif
                                                            </td>

                                                                                                         
                                                           
                                                            <td>
                                                                <a href="{{route('users.show', $user)}}" class="btn btn-info" style="border-radius: 200px"><i class="ri-eye-line" style="font-size: 20px"></i></a>
                                                               
                                                                <a href={{route('users.edit', $user)}} class="btn btn-primary" style="border-radius: 200px"><i class="ri-edit-box-fill" style="font-size: 20px"></i></a>
                                                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;" id="supprimer-user-{{ $user->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" onclick="confirmerSuppression({{ $user->id }})" class="btn btn-danger" style="border-radius: 200px"><i class="ri-delete-bin-7-fill" style="font-size: 20px"></i></button>
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
                Êtes-vous sûr de vouloir supprimer cet utilisateur ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="supprimeruser()">Supprimer</button>
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
function confirmerSuppression(userId) {
// Verification que l'ID de l'étudiant est correct
var userId = parseInt(userId);

if (isNaN(userId)) {
return;
}

// Mis à jour de l'attribut data-id de la boîte de dialogue de confirmation avec l'ID de l'étudiant
$('#confirmationModal').attr('data-id', userId);

// Affichage de la boîte de dialogue de confirmation
$('#confirmationModal').modal('show');
}

function supprimeruser() {
// Récupération l'ID de l'étudiant à partir de l'attribut data-id de la boîte de dialogue
var userId = $('#confirmationModal').attr('data-id');

// Fermez la boîte de dialogue de confirmation
$('#confirmationModal').modal('hide');

// Obtenez le formulaire de suppression correspondant à l'ID de l'étudiant et soumettez-le
var form = document.querySelector('form#supprimer-user-' + userId);
if (form) {
form.submit();
}
}

</script>
