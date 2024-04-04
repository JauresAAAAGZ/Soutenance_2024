@extends("layout.app")


  <body>


    @section("content")

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

                    <!-- Page Heading -->
                    <h1 class="mb-0">Info Professeur</h1>
                    <hr/>
                    @if(session('message1'))
                    <div id="success-message" class="alert alert-success">
                        {{session('message1')}}
                    </div>
                    @endif
                    <ul>
                        <li>Matricule : {{$professeur->numEmploye}}</li>
                        <li>Nom : {{$professeur->nomProfesseur}}</li>
                        <li>Prenom : {{$professeur->prenomProfesseur}}</li>
                        <li>Courriel : {{$professeur->emailProfesseur}}</li>
                        <li>Matieres Enseignées : </li>
                             
                        @foreach ( $professeur->matieres as $matiere)

                         - {{$matiere->intitule}} <br>

                        @endforeach
                          
                        

                        <li>Date de naissance : {{$professeur->date_naissance_prof}}</li>
                        

                        
                      

                    </ul>
                </div>
           
            </div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var successMessage = document.getElementById('success-message');
        
                if (successMessage) {
                    // Set the timeout in milliseconds (e.g., 5000ms = 5 seconds)
                    var timeout = 3000;
        
                    // Automatically dismiss the success message after the timeout
                    setTimeout(function () {
                        successMessage.style.display = 'none'; // Hide the message
                    }, timeout);
                }
            });
        </script>


@endsection

