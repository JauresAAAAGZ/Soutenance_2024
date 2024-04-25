@extends("layout.app")

@section("content")

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
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Liste des répertoires</h4>
                                        </div>

                                        @foreach ($depots as $depot )
                                        <div class="col-md-4 mt-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $depot->nomDepot }}</h5>
                                                    <small>{{ $depot->description }}</small>
                                                </div>
                                                <div class="card-footer">
                                                    <a href="#" class="btn btn-danger mb-3">Fermer</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Options
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <li><a class="dropdown-item" href="#">Option 1</a></li>
                                                            <li><a class="dropdown-item" href="#">Option 2</a></li>
                                                            <li><a class="dropdown-item" href="#">Option 3</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

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
