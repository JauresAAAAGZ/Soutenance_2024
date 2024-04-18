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
           
           <h1 class="mb-0">Enregistrer une matiere</h1>
           <hr />

          <form action="{{route('matieres.store')}}" method="post" id="addmat">
            @csrf
            <div class="row">
                
                <div class="col mb-3">
                    <label for="intitule" class="form-label">Intitule</label>
                    <input type="text" class="form-control" id="intitule" name="intitule" required>
                  
                </div>
                <div class="col mb-3">
                    <label for="code" class="form-label">Code</label>
                    <input type="text" class="form-control" id="code" name="codeMatiere" required>
                    
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="duree" class="form-label">Duree</label>
                    <input type="duree" class="form-control" id="duree" name="duree" required>
                    
                </div>
                
              

               
            </div>
          
            <button id="matadd" type="submit" class="btn btn-warning">Créer Matiere</button>
           
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
        var formulaire = document.getElementById('addmat');
        var boutonAjouter = document.getElementById('matadd');
    
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