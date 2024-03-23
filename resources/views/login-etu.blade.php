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
                    <div class="login-card card-block auth-body mr-auto ml-auto">

                        <form class="md-float-material" action={{route('etudiant.login.treatment')}} method="post">
                            @csrf

                            <div class="text-center">
                                <img src={{asset('assets/images/logos12.png')}} alt="logo.png">
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Sign In</h3>
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
                                <div class="input-group">
                                    <input  type="email" class="form-control" name="emailEtudiant" placeholder="Votre adresse mail">
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input  type="password" class="form-control" name="pswdEtudiant" placeholder="mot de passe">
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        <a href={{ route('registeretu')}} class="text-right f-w-600 text-inverse">Inscription</a>
                                    </div>
                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        <a href="auth-reset-password.blade.php" class="text-right f-w-600 text-inverse"> Forgot Your Password?</a>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <!--<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button>-->
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button>
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
