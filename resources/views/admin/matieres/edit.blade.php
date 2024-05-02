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
                <h1 class="mb-0">Modifier une matiere</h1>
                <hr />
                <form action="{{ route('matieres.update', $matiere) }}" method="post" id="editmat">
                    @csrf
                    @method('PUT')
                    <div class="row">
                
                        <div class="col mb-3">
                            <label for="intitule" class="form-label">Intitule</label>
                            <input type="text" class="form-control" id="intitule" name="intitule" value="{{ $matiere->intitule }}" required>
                          
                        </div>
                        <div class="col mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="code" name="codeMatiere" value="{{ $matiere->codeMatiere }}" required>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="duree" class="form-label">Duree</label>
                            <input type="duree" class="form-control" id="email" name="duree" value="{{ $matiere->duree }}" required>
                            
                        </div>
                        
                      
        
                       
                    </div>
                    
                      
                    </div>
                   
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-secondary" style="border-radius: 150px">Annuler</button>
                        <button id="matedit" class="btn btn-warning" type="submit" style="border-radius: 150px">Modifier</button>
                    </div>
                   
                </form>
            <!-- End of Main Content -->

         
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var formulaire = document.getElementById('editmat');
                var boutonAjouter = document.getElementById('matedit');
            
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