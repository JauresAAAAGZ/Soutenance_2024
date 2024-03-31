@extends('layout.app')

@section('content')


<style>

    td,th{

       white-space: nowrap;
    }
</style>

        <!-- Sidebar -->
         @if (auth()->user()->isAdmin())
                @include('partial.sidebar')
            @elseif (auth()->user()->isDE())
                @include('partial.sidebar_DE')
            @elseif (auth()->user()->isCoordonateur())
                @include('partial.sidebar_Coordonateur')
            @elseif (auth()->user()->isADE())
                @include('partial.sidebar_Assistant_Directeur_des_Etudes')
            @endif
   
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('partial.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Les Professeurs</h1>
                    
                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 col-12">
                            <h6 class="m-0 font-weight-bold text-primary col-6">Professeurs</h6>
                            <a href="{{ route('professeurs.create') }}" class="btn btn-info">Ajouter</a>
                        </div>
                        @if(session('message'))
                        <div id="success-message" class="alert alert-success">
                            {{session('message')}}
                        </div>
                        @endif
                        @if(session('danger'))
                        <div id="success-message" class="alert alert-danger">
                            {{session('danger')}}
                        </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nom_Professeur</th>
                                            <th>Prenom_Professeur</th>
                                            <th>Grade</th>
                                            <th>Opérations</th>
                
                                        </tr>
                                    </thead>
                                    <!--<tfoot>
                                        <tr>
                                            <th>Jury</th>
                                            <th>Salle</th>
                                            <th>Date Et Heure</th>
                                            <th>Prenom_Professeur et Prénoms</th>
                                            <th>Thème</th>
                                            <th>Directeur</th>
                                            <th>Président</th>
                                            <th>Examinateur</th>
                                            <th>Rapporteur</th>
                                        </tr>
                                    </tfoot>-->
                                    <tbody>
                                        @foreach($professeurs as $professeur)
                                            <tr>
                                                <td>
                                                {{ $professeur->Nom_Professeur }}
                                                </td>
                                                <td>
                                                    {{ $professeur->Prenom_Professeur }}
                                                </td>
                                                <td>
                                                    {{ $professeur->Grade }}
                                                </td>
                                               
                                                <td>
                                                    <a href="{{ route('professeurs.show', $professeur) }}" class="btn btn-info">Voir</a>
                                                    <a href="{{ route('professeurs.edit', $professeur) }}" class="btn btn-primary">Modifier</a>
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
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           @include('partial.footer')
        </div>
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation de suppression</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                      <div class="modal-body" style="color:red;">
                        Êtes-vous sûr de vouloir supprimer ce Professeur ? TOUS LES JURYS AUQUELLE CE PROFESSEUR APPARTIENT SERONT SUPPRIMES AVEC CETTE ACTION !!!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger" onclick="supprimerFiliere()">Supprimer</button>
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
    // Verification que l'ID de l'étudiant est correct
    var professeurId = parseInt(professeurId);

    if (isNaN(professeurId)) {
        return;
    }

    // Mis à jour de l'attribut data-id de la boîte de dialogue de confirmation avec l'ID de l'étudiant
    $('#confirmationModal').attr('data-id', professeurId);

    // Affichage de la boîte de dialogue de confirmation
    $('#confirmationModal').modal('show');
}

function supprimerFiliere() {
    // Récupération l'ID de l'étudiant à partir de l'attribut data-id de la boîte de dialogue
    var professeurId = $('#confirmationModal').attr('data-id');

    // Fermez la boîte de dialogue de confirmation
    $('#confirmationModal').modal('hide');

    // Obtenez le formulaire de suppression correspondant à l'ID de l'étudiant et soumettez-le
    var form = document.querySelector('form#supprimer-professeur-' + professeurId);
    if (form) {
        form.submit();
    }
}
</script>

@endsection