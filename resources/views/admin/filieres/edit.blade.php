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
                <h1 class="mb-0">Modifier une filiere</h1>
                <hr />
                <form action="{{ route('filieres.update', $filiere) }}" method="post" id="editfil">
                    @csrf
                    @method('PUT')
                    <div class="row">
                
                        <div class="col mb-3">
                            <label for="nomFiliere" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nomFiliere" name="nomFiliere" value="{{$filiere->nomFiliere}}" required>
                          
                        </div>
                        <div class="col mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="code" name="codeFiliere" value="{{$filiere->codeFiliere}}" required>
                            
                        </div>
                       
                        
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="niveau" class="form-label">Niveau</label>
                            <select name="niveaux[]" id="niveau" class="form-control" multiple>
                                <option disabled selected value> Choisir les Niveaux</option>

                                     

                                    @foreach ($niveaux as $niveau)
                                    <option value="{{$niveau->id}}"  @if ($filiere->niveaux->contains($niveau->id))
                                        selected
                                    @endif>{{$niveau->diplome_niveau}}</option>
                                    @endforeach
                                
                             
                            </select>
                        </div>
                        
                      
        
                       
                    </div>
                    
                      
                    </div>
                    <div class="row">
                        <div class="d-grid">
                            <button id="filedit" class="btn btn-warning" type="submit">Modifier</button>
                        </div>
                    </div>
                   
                </form>
            <!-- End of Main Content -->

         
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var formulaire = document.getElementById('editfil');
                var boutonAjouter = document.getElementById('filedit');
            
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