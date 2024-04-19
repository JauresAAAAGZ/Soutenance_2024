@extends('layout.app')

<body>

@section('content')


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
           
           <h1 class="mb-0">Enregistrer un Etudiant</h1>
           <hr />

          <form action="{{route('etudiants.store')}}" method="post" id="addetu">
            @csrf
            <div class="row">
                <div class="col mb-3">
                    <label for="Matricule" class="form-label">Matricule</label>
                    <input type="text" class="form-control" id="Matricule" name="matricule" required>
                  
                </div>

                <div class="col mb-3">
                    <label for="Nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="Nom" name="nomEtudiant" required>
                  
                </div>
                <div class="col mb-3">
                    <label for="Prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="Prenom" name="prenomEtudiant" required>
                    
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="emailEtudiant" required>
                    
                </div>
                
               
                <div class="col mb-3">
                    <label for="Date_Naissance" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control" id="Date_Naissance" name="date_naissance_etu" required>
                   
                </div>

               
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="filiere" class="form-label">Filiere</label>
                    <select name="filiere_id" id="filiere" class="form-control">
                        <option disabled selected value> Choisir une filière</option>
                        @foreach ($filieres as $filiere)
                        <option value="{{$filiere->id}}" >{{$filiere->nomFiliere}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label for="niveau" class="form-label">Niveau</label>
                    <select name="niveau_id" id="niveau" class="form-control">
                        <option disabled selected value> Choisir un Niveau</option>
                        @foreach ($niveaux as $niveau)
                        <option value="{{$niveau->id}}" >{{$niveau->diplome_niveau}}</option>
                        @endforeach
                    </select>
                </div>
                             
                
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-secondary">Annuler</button>
                <button id="etuadd" type="submit" class="btn btn-warning">Créer l'étudiant</button>
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
        var formulaire = document.getElementById('addetu');
        var boutonAjouter = document.getElementById('etuadd');
    
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