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
           
           <h1 class="mb-0">Créer un nouveau répertoire</h1>
           <hr />

          <form action="{{route('depots.store')}}" method="post" id="adddepot">
            @csrf
            <div class="row">
                
                <div class="col mb-3">
                    <label for="nomDepot" class="form-label">Nom du répertoire</label>
                    <input type="text" class="form-control" id="nomDepot" name="nomDepot" required>
                  
                </div>
                <div class="col mb-3">
                    <label for="dateFermeture" class="form-label">Date de fermeture</label>
                    <input type="datetime-local" class="form-control" id="dateFermeture" name="dateFermeture" required>
                    
                </div>
            </div>
            <div class="row">
                
                <div class="col mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Expliquez dans quel but vous créez ce répertoire ou donnez les instructions..." required>
                    
                </div>
                
            </div>
          
           
            <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-secondary">Annuler</button>
                <button id="depotadd" type="submit" class="btn btn-warning">Créer le repertoire</button>
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


    
</body>