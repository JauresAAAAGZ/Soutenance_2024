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
                <h1 class="ef-page-title">Modifier le niveau</h1>
                <hr />
                <form action="{{ route('niveaux.update', $niveau) }}" method="post" id="editniv">
                    @csrf
                    @method('PUT')
                    <div class="row">
                
                        <div class="col mb-3">
                            <label for="diplome_niveau" class="form-label">Diplôme</label>
                            <input type="text" class="form-control" id="diplome_niveau" name="diplome_niveau" value="{{ $niveau->diplome_niveau }}" required>
                          
                        </div>
                        <div class="col mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="code" name="codeNiveau" value="{{ $niveau->codeNiveau }}" required>
                            
                        </div>
                    </div>
                                        
                      
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('niveaux.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        <button id="nivedit" class="btn btn-primary" type="submit">Modifier</button>
                    </div>
                   
                </form>
            <!-- End of Main Content -->

         
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var formulaire = document.getElementById('editniv');
                var boutonAjouter = document.getElementById('nivedit');
            
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