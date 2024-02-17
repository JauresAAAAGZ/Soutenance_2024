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
                        <form class="md-float-material" action="" method="post">
                            <div class="text-center">
                                <img src="assets/images/logos12.png" alt="logo.png">
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Sign In</h3>
                                    </div>
                                </div>
                                <hr/>
                                <div class="input-group">
                                    <input type="emailEns" class="form-control" placeholder="Entrez votre Mail">
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="passwordEns" class="form-control" placeholder="Entrez votre Matricule">
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="passwordEns" class="form-control" placeholder="Entrez votre mot de passe">
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        <a href={{route('registerens')}} class="text-right f-w-600 text-inverse">Inscription</a>
                                    </div>
                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        <a href="auth-reset-password.blade.php" class="text-right f-w-600 text-inverse"> Forgot Your Password?</a>
                                    </div>
                                   
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <!--<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button>-->
                                        <a href={{route('dashens')}} class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</a>
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
