@extends('layout.app')

<body>

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

                <!-- Begin Page Content -->
                <h1 class="mb-0">Modifier un répertoire</h1>
                <hr />
                <form action="{{ route('depots.update', $depot) }}" method="post" id="editdepot">
                    @csrf
                    @method('PUT')
                    
             <div class="row">
                
                <div class="col mb-3">
                    <label for="nomDepot" class="form-label">Nom du répertoire</label>
                    <input type="text" class="form-control" id="nomDepot" name="nomDepot" required value="{{ $depot->nomDepot }}">
                  
                </div>

                <div class="col mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Expliquez dans quel but vous créez ce répertoire ou donnez les instructions..." value="{{ $depot->description }}" required>
                    
                </div>

               
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="matiere" class="form-label">Matières Concernées</label>
                    <select name="matiere_id" id="matiere" class="form-control">
                        <option disabled selected value>Choisir le(s) matière(s)</option>
                        @foreach ($matieres as $matiere)
                            @if ($professeur->matieres->contains($matiere))
                                <option value="{{ $matiere->id }}"  @if ($matiere->id == $depot->matiere_id)
                                    selected
                                    @endif>{{ $matiere->intitule }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label for="niveau" class="form-label">Niveaux Concernés</label>
                    <select name="niveaux[]" id="niveau" class="form-control" multiple>
                        <option disabled selected value> Choisir le(s) Niveau(x)</option>
                        @foreach ($niveaux as $niveau)
                        <option value="{{$niveau->id}}"  @if ($depot->niveaux->contains($niveau->id))
                            selected
                        @endif>{{$niveau->diplome_niveau}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label for="filiere" class="form-label">Filieres Concernées</label>
                    <select name="filieres[]" id="filiere" class="form-control" multiple>
                        <option disabled selected value> Choisir le(s) Filiere(s)</option>
                        @foreach ($filieres as $filiere)
                        <option value="{{$filiere->id}}" @if ($depot->filieres->contains($filiere->id))
                            selected
                        @endif>{{$filiere->nomFiliere}}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>
          <div class="row">

            <div class="col mb-3">
                <label for="dateFermeture" class="form-label">Date de fermeture</label>
                <input type="datetime-local" class="form-control" id="dateFermeture" name="dateFermeture" value="{{ $depot->dateFermeture }}"required>
                
            </div>

           
          </div>
           
            <div class="d-flex justify-content-between">
                
                <button type="reset" class="btn btn-secondary">Annuler</button>
                <button id="depotedit" type="submit" class="btn btn-warning">Modifier le repertoire</button>
            </div>
                   
                </form>
            <!-- End of Main Content -->

         
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var formulaire = document.getElementById('editdepot');
                var boutonAjouter = document.getElementById('depotedit');
            
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

    
</body>