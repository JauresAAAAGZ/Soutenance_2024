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
                <h1 class="ef-page-title">Modifier le mot de passe du compte</h1>
                <hr />
                <form action="{{ route('users.update', $user) }}" method="post" id="edituser">
                    @csrf
                    @method('PUT')
                    <div class="row">
                                               
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly required>
                          
                        </div>
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="Prenom" name="email" value="{{ $user->email }}" readonly required>
                            
                        </div>    
                    </div>
                   
                    <div class="row">
        
                        <div class="col mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            
                        </div>
                      
                        
                        <div class="col mb-3">
                            <label for="newpassword" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="newpassword" name="newpassword" required>
                            
                        </div>
                        
                    </div>
                    
                      
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        <button id="useredit" class="btn btn-primary" type="submit">Modifier le compte</button>
                       
                    </div>
                   
                </form>
            <!-- End of Main Content -->

         
            </div>
        </div>
       
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var formulaire = document.getElementById('edituser');
            var boutonAjouter = document.getElementById('useredit');
            var passwordInput = document.getElementById('password');
            var newPasswordInput = document.getElementById('newpassword');
        
            formulaire.addEventListener('submit', function (e) {
                if (passwordInput.value !== newPasswordInput.value) {
                    // Si les mots de passe ne correspondent pas, empêcher la soumission du formulaire
                    alert("Les mots de passe ne correspondent pas !");
                    e.preventDefault();
                } else {
                    // Si les mots de passe correspondent, soumettre le formulaire
                    boutonAjouter.disabled = true;
                }
            });
        });
    </script>
     
@endsection

    
</body>