@extends('layout.app')

@section('content')
    <?php
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Récupérer l'objet Professeur associé à l'utilisateur connecté
    $professeur = $user->professeur;
    ?>

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
           
           <div class="ef-page-header">
               <div>
                   <h1 class="ef-page-title">Nouveau dépôt</h1>
                   <p class="ef-page-subtitle">Les étudiants des filières et niveaux choisis pourront y déposer leur travail jusqu'à la date de fermeture.</p>
               </div>
           </div>

          <form action="{{route('depots.store')}}" method="post" id="adddepot" enctype="multipart/form-data">
            @csrf
            <div class="row">
                
                <div class="col mb-3">
                    <label for="nomDepot" class="form-label">Nom du dépôt</label>
                    <input type="text" class="form-control" id="nomDepot" name="nomDepot" placeholder="ex: Devoir de maison" required>
                  
                </div>

                <div class="col mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Consignes pour les étudiants : ce qu'il faut rendre et sous quelle forme" required>
                    
                </div>

               
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="matiere" class="form-label">Matière</label>
                    <select name="matiere_id" id="matiere" class="form-control" required>
                        <option disabled selected value>Choisir la matière</option>
                        @foreach ($matieres as $matiere)
                            @if ($professeur->matieres->contains($matiere))
                                <option value="{{ $matiere->id }}">{{ $matiere->intitule }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label for="niveau" class="form-label">Niveaux concernés</label>
                    <select name="niveaux[]" id="niveau" class="form-control" required multiple>
                        @foreach ($niveaux as $niveau)
                        <option value="{{$niveau->id}}" >{{$niveau->diplome_niveau}}</option>
                        @endforeach
                    </select>
                    <div class="form-text-help">Ctrl + clic pour en sélectionner plusieurs</div>
                </div>

                <div class="col mb-3">
                    <label for="filiere" class="form-label">Filières concernées</label>
                    <select name="filieres[]" id="filiere" class="form-control" required multiple>
                        @foreach ($filieres as $filiere)
                        <option value="{{$filiere->id}}" >{{$filiere->nomFiliere}}</option>
                        @endforeach
                    </select>
                    <div class="form-text-help">Ctrl + clic pour en sélectionner plusieurs</div>
                </div>
                
            </div>
          <div class="row">

            <div class="col mb-3">
                <label for="dateFermeture" class="form-label">Date de fermeture</label>
                <input type="datetime-local" class="form-control" id="dateFermeture" name="dateFermeture" required>
                
            </div>

            <div class="col mb-3">
                <label for="fichier" class="form-label">Ressource à joindre (facultatif)</label>
                <input type="file" class="form-control" id="fichier" name="fichiers[]" accept=".zip, .rar, .pdf">
            </div>
          </div>
           
            <div class="d-flex justify-content-between">
                
                <a href="{{ route('depots.index') }}" class="btn btn-outline-secondary">Annuler</a>
                <button id="depotadd" type="submit" class="btn btn-primary">Créer le dépôt</button>
            </div>
        </form>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->
    </div>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var formulaire = document.getElementById('adddepot');
        var boutonAjouter = document.getElementById('depotadd');
    
        formulaire.addEventListener('submit', function (e) {
            e.preventDefault(); // Empêche la soumission normale du formulaire
    
            // Désactivez le bouton
            boutonAjouter.disabled = true;
    
            // Soumettez le formulaire manuellement
            this.submit();
        });
    });
    
    
</script>

@endsection
