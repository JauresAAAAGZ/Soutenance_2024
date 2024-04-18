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
                <h1 class="mb-0">Modifier un Professeur</h1>
                <hr />
                <form action="{{ route('professeurs.update', $professeur) }}" method="post" id="editprof">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col mb-3">
                            <label for="numEmploye" class="form-label">Numero Employé</label>
                            <input type="text" class="form-control" id="numEmploye" name="numEmploye" required value="{{ $professeur->numEmploye }}">
                           
                        </div>
        
                        <div class="col mb-3">
                            <label for="Nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="Nom" name="nomProfesseur" required value="{{ $professeur->nomProfesseur }}">
                          
                        </div>
                        <div class="col mb-3">
                            <label for="Prenom" class="form-label">Prenom</label>
                            <input type="text" class="form-control" id="Prenom" name="prenomProfesseur" required value="{{ $professeur->prenomProfesseur }}">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="emailProfesseur" required value="{{ $professeur->emailProfesseur }}">
                            
                        </div>
                        
                        
                        <div class="col mb-3">
                            <label for="Date_Naissance" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" id="Date_Naissance" name="date_naissance_prof" required value="{{ $professeur->date_naissance_prof }}">
                           
                        </div>
        
                       
                    </div>
                    <div class="mb-3">
                        <label for="matiere" class="form-label">matiere</label>
                            <select name="matieres[]" id="matiere" class="form-control" multiple>
                                <option disabled selected value> Choisir les matieres</option>

                                     

                                    @foreach ($matieres as $matiere)
                                    <option value="{{$matiere->id}}"  @if ($professeur->matieres->contains($matiere->id))
                                        selected
                                    @endif>{{$matiere->intitule}}</option>
                                    @endforeach
                                
                             
                            </select>


                    </div>
                    
                      
                    </div>
                    <div class="row">
                        <div class="d-grid">
                            <button id="profedit" class="btn btn-warning" type="submit">Modifier</button>
                        </div>
                    </div>
                   
                </form>
            <!-- End of Main Content -->

         
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var formulaire = document.getElementById('editprof');
                var boutonAjouter = document.getElementById('profedit');
            
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