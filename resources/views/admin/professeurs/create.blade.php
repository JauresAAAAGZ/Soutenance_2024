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
           <h1 class="mb-0">Créer Professeur</h1>
           <hr />
          <form action="{{route('professeurs.store')}}" method="post" id="addprof">
            @csrf
            <div class="row">
                <div class="col mb-3">
                    <label for="Nom_Professeur" class="form-label">Nom_Professeur</label>
                    <input type="text" class="form-control" id="Nom_Professeur" name="Nom_Professeur" required >
                    @error('Nom_Professeur')
                    <p class="text-red-500">{{ $message }}</p>
                   @enderror
                </div>

                <div class="col mb-3">
                    <label for="Prenom_Professeur" class="form-label">Prenom_Professeur</label>
                    <input type="text" class="form-control" id="Prenom_Professeur" name="Prenom_Professeur" required>
                    @error('Prenom_Professeur')
                    <p class="text-red-500">{{ $message }}</p>
                   @enderror
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="Grade" class="form-label">Grade</label>
                    <input type="text" class="form-control" id="Grade" name="Grade" required>
                    @error('Grade')
                    <p class="text-red-500">{{ $message }}</p>
                   @enderror
                </div>

            </div>

           
            <button id="profadd" type="submit" class="btn btn-primary" >Créer le professeur</button>
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
    var formulaire = document.getElementById('addprof');
    var boutonAjouter = document.getElementById('profadd');

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