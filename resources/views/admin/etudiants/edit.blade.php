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
                <h1 class="mb-0">Editer Etudiant</h1>
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
                            <label for="Niveau_Etude" class="form-label">Niveau d'étude</label>
                            <input type="text" class="form-control" id="Niveau_Etude" name="niveau_etude" required value="{{ $etudiant->niveau_etude }}">
                           
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
                    </div>
                    
                      
                    </div>
                    <div class="row">
                        <div class="d-grid">
                            <button id="etuedit" class="btn btn-warning" type="submit">Modifier</button>
                        </div>
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