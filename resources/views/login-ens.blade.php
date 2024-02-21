@extends('layout.app')

<body class="fix-menu">
    @section('content')
    <!-- Pre-loader start -->
    <div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
        </div>
    </div>
</div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg2">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                        <form class="md-float-material" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="text-center">
                                <img src="assets/images/logos12.png" alt="logo.png">
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Connexion Enseignant</h3>
                                    </div>
                                </div>
                                <hr/>
                                 <!-- Email Address -->
                                <div class="input-group">
                                   
                                    <x-text-input id="emailProfesseur" class="form-control" placeholder="Entrez votre Mail" type="emailProfesseur" name="emailProfesseur" :value="old('emailProfesseur')" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('emailProfesseur')" class="mt-2" />
                                </div>
                                
                                <div class="input-group">
                                   
                                    <x-text-input id="numEmploye" class="form-control" placeholder="Entrez votre Matricule" type="text" name="numEmploye"  />
                                    <x-input-error :messages="$errors->get('numEmploye')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                
                                <div class="mt-4">
                                    

                                    <x-text-input id="pswdProfesseur" class="form-control"
                                                    placeholder="Entrez votre mot de passe"
                                                    type="password"
                                                    name="pswdProfesseur"
                                                    required autocomplete="current-password" />

                                    <x-input-error :messages="$errors->get('pswdProfesseur')" class="mt-2" />
                                </div>
                                 
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        <a href={{route('registerens')}} class="text-right f-w-600 text-inverse">Inscription</a>
                                    </div>

                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        @if (Route::has('password.request'))
                                            <a class="text-right f-w-600 text-inverse" href="{{ route('password.request') }}">
                                                {{ __('Mot de passe Oublié?') }}
                                            </a>
                                        @endif
                                    </div>
                                   
                                    
                                   
                                </div>
                                <div class="row m-t-30">
                                    
                                    <div class="col-md-12">
                                        <x-primary-button class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                            {{ __('Log in') }}
                                        </x-primary-button>
                                       
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Thank you and enjoy our website.</p>
                                        <p class="text-inverse text-left"><b>Your Authentication Team</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="assets/images/lololo.png" alt="small-logo.png">
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    @endsection
</body>

</html>
