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
           
           <h1 class="mb-0">Enregistrer un Compte utilisateur</h1>
           <hr />

          <form action="{{route('etudiants.store')}}" method="post" id="adduser">
            @csrf
            <div class="row">
                
                <div class="col mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  
                </div>
                <div class="col mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Prenom" name="email" required>
                    
                </div>
            </div>
           
            <div class="row">

                <div class="col mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role_id" id="role" class="form-control">
                        <option disabled selected value> Choisir le role de l'utilisateur</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->id}}" >{{$role->nomRole}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label for="etudiant" class="form-label">Etudiant</label>
                    <select name="etudiant_id" id="etudiant" class="form-control">
                        <option disabled selected value> Choisir l'étudiant</option>
                        @foreach ($etudiants as $etudiant)
                        <option value="{{$etudiant->id}}" >{{$etudiant->nomEtudiant}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label for="professeur" class="form-label">professeur</label>
                    <select name="professeur_id" id="professeur" class="form-control">
                        <option disabled selected value> Choisir le Professeur</option>
                        @foreach ($professeurs as $professeur)
                        <option value="{{$professeur->id}}" >{{$professeur->nomProfesseur}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label for="admin" class="form-label">Admin</label>
                    <select name="admin_id" id="admin" class="form-control">
                        <option disabled selected value> Choisir l'admin</option>
                        @foreach ($admins as $admin)
                        <option value="{{$admin->id}}" >{{$admin->nomAdmin}}</option>
                        @endforeach
                    </select>
                </div>
                             
                
            </div>
            <button id="useradd" type="submit" class="btn btn-warning">Créer le compte</button>
           
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
        var formulaire = document.getElementById('adduser');
        var boutonAjouter = document.getElementById('useradd');
    
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