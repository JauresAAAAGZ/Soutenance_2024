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
                <h1 class="mb-0">Editer Filiere</h1>
                <hr />
                <form action="{{ route('filieres.update', $filiere) }}" method="post" id="editfil">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Intitule_Filiere</label>
                            <input type="text" name="Intitule_Filiere" class="form-control" placeholder="Intitule_Filiere" value="{{ $filiere->Intitule_Filiere }}">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Niveau_Filiere</label>
                            <input type="text" name="Niveau_Filiere" class="form-control" placeholder="Niveau_Filiere" value="{{ $filiere->Niveau_Filiere }}" >
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="d-grid">
                            <button id="filedit" class="btn btn-warning" type="submit">Modifier</button>
                        </div>
                    </div>
                </form>
            <!-- End of Main Content -->

           @include('partial.footer')
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
