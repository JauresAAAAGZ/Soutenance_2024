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

                <!-- Begin Page Content -->
                <h1 class="mb-0">Modifier un  Etudiant</h1>
                <hr />
                <form action="{{ route('etudiants.update', $etudiant) }}" method="post" id="editetu">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col mb-3">
                            <label for="Matricule" class="form-label">Matricule</label>
                            <input type="text" class="form-control" id="Matricule" name="matricule" required value="{{ $etudiant->matricule }}">
                           
                        </div>
        
                        <div class="col mb-3">
                            <label for="Nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="Nom" name="nomEtudiant" required value="{{ $etudiant->nomEtudiant }}">
                          
                        </div>
                        <div class="col mb-3">
                            <label for="Prenom" class="form-label">Prenom</label>
                            <input type="text" class="form-control" id="Prenom" name="prenomEtudiant" required value="{{ $etudiant->prenomEtudiant }}">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="emailEtudiant" required value="{{ $etudiant->emailEtudiant }}">
                            
                        </div>
                        
                        
                        <div class="col mb-3">
                            <label for="Date_Naissance" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" id="Date_Naissance" name="date_naissance_etu" required value="{{ $etudiant->date_naissance_etu }}">
                           
                        </div>
        
                       
                    </div>
                    <div class="mb-3">
                        <label for="filiere" class="form-label">Filiere</label>
                        <select name="filiere_id" id="filiere" class="form-control">
                            
                            @foreach ($filieres as $filiere)
                            <option value="{{$filiere->id}}"
                            @if ($filiere->id == $etudiant->filiere_id)
                            selected
                            @endif
                            
                            >{{$filiere->Intitule_Filiere}}</option>
                            @endforeach
                            
                           
                        </select>

                        <label for="niveau" class="form-label">Niveau</label>
                        <select name="niveau_id" id="niveau" class="form-control">
                            
                            @foreach ($niveaux as $niveau)
                            <option value="{{$niveau->id}}"
                            @if ($niveau->id == $etudiant->niveau_id)
                            selected
                            @endif
                            
                            >{{$niveau->diplome_niveau}}</option>
                            @endforeach
                            
                           
                        </select>


                    </div>
                    
                      
                    </div>
                   
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-secondary">Annuler</button>
                        <button id="etuedit" class="btn btn-warning" type="submit">Modifier</button>
                    </div>
                </form>
            <!-- End of Main Content -->

         
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var formulaire = document.getElementById('editetu');
                var boutonAjouter = document.getElementById('etuedit');
            
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