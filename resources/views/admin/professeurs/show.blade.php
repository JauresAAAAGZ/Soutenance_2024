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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="mb-0">Info Professeurs</h1>
                    <hr/>
                    @if(session('message1'))
                    <div id="success-message" class="alert alert-success">
                        {{session('message1')}}
                    </div>
                    @endif
                    <ul>
                        <li>Nom_Professeur : '{{$professeur->Nom_Professeur}}'</li>
                        <li>Prenom_Professeur : '{{$professeur->Prenom_Professeur}}'</li>
                        <li>Grade : '{{$professeur->Grade}}'</li>
                    </ul>
                </div>
            <!-- End of Main Content -->

                @include('partial.footer')
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

