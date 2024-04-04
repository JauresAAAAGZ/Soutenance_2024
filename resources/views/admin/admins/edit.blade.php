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
                <h1 class="mb-0">Editer admin</h1>
                <hr />
                <form action="{{ route('admins.update', $admin) }}" method="post" id="editadmin">
                    @csrf
                    @method('PUT')
                    <div class="row">
                
                        <div class="col mb-3">
                            <label for="nomAdmin" class="form-label">nomAdmin</label>
                            <input type="text" class="form-control" id="nomAdmin" name="nomAdmin" value="{{ $admin->nomAdmin }}" required>
                          
                        </div>
                        <div class="col mb-3">
                            <label for="emailAdmin" class="form-label">emailAdmin</label>
                            <input type="emailAdmin" class="form-control" id="email" name="emailAdmin" value="{{ $admin->emailAdmin }}" required>
                            
                        </div>
                    </div>
                                        
                      
                    </div>
                    <div class="row">
                        <div class="d-grid">
                            <button id="adminedit" class="btn btn-warning" type="submit">Modifier</button>
                        </div>
                    </div>
                   
                </form>
            <!-- End of Main Content -->

         
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var formulaire = document.getElementById('editadmin');
                var boutonAjouter = document.getElementById('adminedit');
            
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