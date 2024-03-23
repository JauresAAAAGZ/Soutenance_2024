
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
                                    @if (Session::has('error'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Bienvenue !!!</strong> {{session::get('error')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>    
                                    @endif
                                    <div class="page-wrapper">
                                    
                                        <div class="page-body">
                                            <div class="row">
                                                <!-- card1 start -->
                                                <div class="col-md-6 col-xl-3">
                                                    <div class="card widget-card-1">
                                                        <div class="card-block-small">
                                                            <i class="icofont icofont-ui-home bg-c-pink card1-icon"></i>
                                                            <span class="text-c-pink f-w-600">PIGIER BENIN</span>
                                                            <h4>RGL 3</h4>
                                                            <div>
                                                                <span class="f-left m-t-10 text-muted">
                                                                    <i class="text-c-pink f-16 icofont icofont-calendar m-r-10"></i>Last 24 hours
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card1 end -->                                            
                                                <!-- Data widget start -->
                                                <div class="col-md-12 col-xl-6">
                                                    <div class="card project-task">
                                                        <div class="card-header">
                                                            <div class="card-header-left ">
                                                                <h5>Dépots disponibles &amp; exercices</h5>
                                                            </div>
                                                            <div class="card-header-right">
                                                                <ul class="list-unstyled card-option">
                                                                    <li><i class="icofont icofont-simple-left "></i></li>
                                                                    <li><i class="icofont icofont-maximize full-card"></i></li>
                                                                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                                                                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                                                                    <li><i class="icofont icofont-error close-card"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="card-block p-b-10">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Dépots</th>
                                                                            <th>Délai sur la semaine</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="task-contain">
                                                                                    <h6 class="bg-c-blue d-inline-block text-center">U</h6>
                                                                                    <p class="d-inline-block m-l-20">UML</p>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <p class="d-inline-block m-r-20">5j 8H</p>
                                                                                <div class="progress d-inline-block">
                                                                                    <div class="progress-bar bg-c-blue" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="task-contain">
                                                                                    <h6 class="bg-c-pink d-inline-block text-center">C</h6>
                                                                                    <p class="d-inline-block m-l-20">CCNA</p>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <p class="d-inline-block m-r-20">3j 4H</p>
                                                                                <div class="progress d-inline-block">
                                                                                    <div class="progress-bar bg-c-pink" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:23%">
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                    <!-- Data widget End -->
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div id="styleSelector">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endsection
       <body>
</html>
