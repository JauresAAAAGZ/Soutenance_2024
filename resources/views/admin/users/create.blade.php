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
           
           <h1 class="ef-page-title">Nouveau compte utilisateur</h1>
           <hr />

          <form action="{{route('users.store')}}" method="post" id="adduser">
            @csrf
            <div class="row">
                <div class="col mb-3">
                    <label for="role" class="form-label">Rôle</label>
                    <select name="role_id" id="role" class="form-control" required>
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
                        <option value="{{$etudiant->id}}" >{{$etudiant->nomEtudiant}} {{$etudiant->prenomEtudiant}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col mb-3">
                    <label for="professeur" class="form-label">professeur</label>
                    <select name="professeur_id" id="professeur" class="form-control">
                        <option disabled selected value> Choisir le Professeur</option>
                        @foreach ($professeurs as $professeur)
                        <option value="{{$professeur->id}}" >{{$professeur->nomProfesseur}}{{$professeur->prenomProfesseur}}</option>
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
           
            <div class="row">

              
                <div class="col mb-3">
                    <label for="name" class="form-label">Nom et Prenom</label>
                    <input type="text" class="form-control" id="name" name="name" required readonly>
                  
                </div>
                <div class="col mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required readonly>
                    
                </div>    
                
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    
                </div>
                
                <div class="col mb-3">
                    <label for="newpassword" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="newpassword" name="newpassword" required>
                    
                </div>



            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Annuler</a>
                <button id="useradd" type="submit" class="btn btn-primary">Créer le compte</button>
               
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

    <script>
       document.addEventListener('DOMContentLoaded', function () {
        var roleSelect = document.getElementById('role');
        var etudiantSelect = document.getElementById('etudiant');
        var professeurSelect = document.getElementById('professeur');
        var adminSelect = document.getElementById('admin');

        // Disable all student, professor, and admin selections initially
        etudiantSelect.disabled = true;
        professeurSelect.disabled = true;
        adminSelect.disabled = true;

        roleSelect.addEventListener('change', function() {
            var selectedRole = this.value;

            etudiantSelect.disabled = (selectedRole !== "1"); // Enable only for Student role (ID: 1)
            professeurSelect.disabled = (selectedRole !== "2"); // Enable only for Professor role (ID: 2)
            adminSelect.disabled = (selectedRole !== "3"); // Enable only for Admin role (ID: 3)
        });
        });
      
          formulaire.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent normal form submission
      
            // Disable button (optional)
            boutonAjouter.disabled = true;
      
            // Submit the form manually
            this.submit();
          });
        
    </script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
        var etudiantSelect = document.getElementById('etudiant');
        var professeurSelect = document.getElementById('professeur');
        var adminSelect = document.getElementById('admin');

        var nameInput = document.getElementById('name');
        var emailInput = document.getElementById('email');

            etudiantSelect.addEventListener('change', function() {
                var selectedEtudiantId = this.value;

                if (selectedEtudiantId !== "") {
                    // Effectuer une requête AJAX pour récupérer les informations de l'étudiant
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/get-etudiant-info/' + selectedEtudiantId, true);
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            var etudiantInfo = JSON.parse(xhr.responseText);
                            nameInput.value = etudiantInfo.nomEtudiant +" "+ etudiantInfo.prenomEtudiant;
                            emailInput.value = etudiantInfo.emailEtudiant;
                        } else {
                            console.log('Erreur lors de la récupération des informations de l\'étudiant');
                        }
                    };
                    xhr.send();
                } else {
                    nameInput.value = "";
                    emailInput.value = "";
                }
            });

            // Écouteur d'événement pour la sélection d'administrateur
            adminSelect.addEventListener('change', function() {
            var selectedAdminId = this.value;

            if (selectedAdminId !== "") {
                // Effectuer une requête AJAX pour récupérer les informations de l'administrateur
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/get-admin-info/' + selectedAdminId, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var adminInfo = JSON.parse(xhr.responseText);
                        nameInput.value = adminInfo.nomAdmin; // Remplir le champ nom avec le nom de l'administrateur sélectionné
                        emailInput.value = adminInfo.emailAdmin; // Remplir le champ email avec l'email de l'administrateur sélectionné
                    } else {
                        console.log('Erreur lors de la récupération des informations de l\'administrateur');
                    }
                };
                xhr.send();
            } else {
                nameInput.value = "";
                emailInput.value = "";
            }
        });

        // Écouteur d'événement pour la sélection du professeur
            professeurSelect.addEventListener('change', function() {
            var selectedProfesseurId = this.value;

            if (selectedProfesseurId !== "") {
                // Effectuer une requête AJAX pour récupérer les informations du professeur
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/get-professeur-info/' + selectedProfesseurId, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var professeurInfo = JSON.parse(xhr.responseText);
                        nameInput.value = professeurInfo.nomProfesseur +" "+ professeurInfo.prenomProfesseur; // Remplir le champ nom avec le nom du professeur sélectionné
                        emailInput.value = professeurInfo.emailProfesseur; // Remplir le champ email avec l'email du professeur sélectionné
                    } else {
                        console.log('Erreur lors de la récupération des informations du professeur');
                    }
                };
                xhr.send();
            } else {
                nameInput.value = "";
                emailInput.value = "";
            }
        });

    });

    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var formulaire = document.getElementById('adduser');
        var boutonAjouter = document.getElementById('useradd');
        var passwordInput = document.getElementById('password');
        var newPasswordInput = document.getElementById('newpassword');

        formulaire.addEventListener('submit', function (e) {
            if (passwordInput.value !== newPasswordInput.value) {
                // If passwords do not match, prevent form submission
                alert("Les mots de passe ne correspondent pas !");
                e.preventDefault(); // Prevent form submission
            } else {
                // If passwords match, allow form submission
                boutonAjouter.disabled = true; // Optionally, disable the submit button
            }
        });
    });
</script>


      

@endsection


    
</body>