@extends('layout.app')

@section('content')


   <!-- Sidebar -->
    @if (auth()->user()->isAdmin())
                @include('partial.sidebar')
            @elseif (auth()->user()->isDE())
                @include('partial.sidebar_DE')
            @elseif (auth()->user()->isCoordonateur())
                @include('partial.sidebar_Coordonateur')
            @elseif (auth()->user()->isADE())
                @include('partial.sidebar_Assistant_Directeur_des_Etudes')
            @endif
   
   <!-- End of Sidebar -->

   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">

       <!-- Main Content -->
       <div id="content">

           <!-- Topbar -->
           @include('partial.header')
           <!-- End of Topbar -->

           <!-- Begin Page Content -->
           <h1 class="mb-0">Créer Filiere</h1>
           <hr />
          <form action="{{route('filieres.store')}}" method="post" id="addfil">
            @csrf
            <div class="row">
                <div class="col mb-3">
                    <label for="Intitule_Filiere" class="form-label">Intitule_Filiere</label>
                    <input type="text" class="form-control" id="Intitule_Filiere" name="Intitule_Filiere" required>
                    @error('Intitule_Filiere')
                    <p class="text-red-500">{{ $message }}</p>
                   @enderror
                  </div>

                <div class="col mb-3">
                    <label for="Niveau_Filiere" class="form-label">Niveau_Filiere</label>
                    <input type="text" class="form-control" id="Niveau_Filiere" name="Niveau_Filiere" required>
                    @error('Niveau_Filiere')
                    <p class="text-red-500">{{ $message }}</p>
                   @enderror
                  </div>
            </div>
            
           
            <button id="filadd" type="submit" class="btn btn-primary">Créer la filiere</button>
        </form>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var formulaire = document.getElementById('addfil');
        var boutonAjouter = document.getElementById('filadd');
    
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