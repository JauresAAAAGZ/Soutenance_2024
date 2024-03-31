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
                <h1 class="mb-0">Editer Professeur</h1>
                <hr />
                <form action="{{ route('professeurs.update', $professeur) }}" method="post" id="editprof">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Nom_Professeur</label>
                            <input type="text" name="Nom_Professeur" class="form-control" placeholder="Nom_Professeur" value="{{ $professeur->Nom_Professeur }}">
                            @error('Nom_Professeur')
                            <p class="text-red-500">{{ $message }}</p>
                           @enderror
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Prenom_Professeur</label>
                            <input type="text" name="Prenom_Professeur" class="form-control" placeholder="Prenom_Professeur" value="{{ $professeur->Prenom_Professeur }}" >
                            @error('Prenom_Professeur')
                            <p class="text-red-500">{{ $message }}</p>
                           @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Grade</label>
                            <input type="text" name="Grade" class="form-control" placeholder="Grade" value="{{ $professeur->Grade }}">
                            @error('Grade')
                            <p class="text-red-500">{{ $message }}</p>
                           @enderror
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="d-grid">
                            <button class="btn btn-warning" type="submit" id="profedit">Modifier</button>
                        </div>
                    </div>
                </form>
            <!-- End of Main Content -->

           @include('partial.footer')
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
