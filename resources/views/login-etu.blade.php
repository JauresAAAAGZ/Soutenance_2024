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

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto" style="background-color: transparent;">
                         <!-- Session Status -->
                         <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form class="md-float-material" method="POST" action="{{ route('login') }}">
                            @csrf
                
                            
                            <div class="auth-box">
                                <div class="text-center">
                                    <img src={{asset('assets/images/logos12.png')}} alt="logo.png">
                                </div>
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left" style="color:black">Connexion</h3>
                                    </div>
                                </div>
                                
                                    @if (Session::has('error'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Erreur de connexion !!!</strong> {{session::get('error')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>    
                                    @endif

                                <hr/>

                                <!-- Addresse mail -->
                                <div class="input-group">
                                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus placeholder="Email" style="font-family: 'Arial', sans-serif;" />
                                    <span class="md-line"></span>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                 <!-- mot de passe-->
                                <div class="input-group">                                    
                                    <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Mot de passe" style="font-family: 'Arial', sans-serif;" />
                                    <span class="md-line"></span>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        @if (Route::has('password.request'))
                                                <div class="text-center">
                                                    <a class="large" href="{{ route('password.request') }}">
                                                        {{ __('Mot de passe oublié?') }}
                                                    </a>
                                                </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <x-primary-button class="btn btn-secondary btn-user btn-block">
                                            {{ __('Se connecter') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Merci et Profitez Du Site.</p>
                                        <p class="text-inverse text-left"><b>Votre Equipe d'authentification.</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src={{asset('assets/images/lololo.png')}} alt="small-logo.png">
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