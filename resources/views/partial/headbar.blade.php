<!-- Navbar Start -->
<nav class="navbar header-navbar pcoded-header">
  <div class="navbar-wrapper">

      <div class="navbar-logo">
          <a class="mobile-menu" id="mobile-collapse" href="#!">
              <i class="ti-menu"></i>
          </a>
          <a class="mobile-search morphsearch-search" href="#">
              <i class="ti-search"></i>
          </a>
          <a href={{route('dashetu')}}>
              <img class="img-fluid" src={{asset('assets/images/la.png')}} alt="Theme-Logo" />
          </a>
          <a class="mobile-options">
              <i class="ti-more"></i>
          </a>
      </div>

      <div class="navbar-container container-fluid">
          <ul class="nav-left">
              <li>
                  <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
              </li>

              <li>
                  <a href="#!" onclick="javascript:toggleFullScreen()">
                      <i class="ti-fullscreen"></i>
                  </a>
              </li>
          </ul>
          <ul class="nav-right">
              <li class="header-notification">
                  <a href="#!">
                      <i class="ti-bell"></i>
                      <span class="badge bg-c-pink"></span>
                  </a>
                  <ul class="show-notification">
                      <li>
                          <h6>Notifications</h6>
                          <label class="label label-danger">New</label>
                      </li>
                      <li>
                          <div class="media">
                              <img class="d-flex align-self-center img-radius" src={{asset('assets/images/avatar-4.jpg')}} alt="Generic placeholder image">
                              <div class="media-body">
                                  <h5 class="notification-user">John Doe</h5>
                                  <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                  <span class="notification-time">30 minutes ago</span>
                              </div>
                          </div>
                      </li>
                      <li>
                          <div class="media">
                              <img class="d-flex align-self-center img-radius" src={{asset("assets/images/avatar-3.jpg")}} alt="Generic placeholder image">
                              <div class="media-body">
                                  <h5 class="notification-user">Joseph William</h5>
                                  <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                  <span class="notification-time">30 minutes ago</span>
                              </div>
                          </div>
                      </li>
                      <li>
                          <div class="media">
                              <img class="d-flex align-self-center img-radius" src={{asset('assets/images/avatar-4.jpg')}} alt="Generic placeholder image">
                              <div class="media-body">
                                  <h5 class="notification-user">Sara Soudein</h5>
                                  <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                  <span class="notification-time">30 minutes ago</span>
                              </div>
                          </div>
                      </li>
                  </ul>
              </li>
              <li class="user-profile header-notification">
                  <a href="#!">
                      <img src={{asset('assets/images/avatar-4.jpg')}} class="img-radius" alt="User-Profile-Image">
                      
                      <span>
                            <?php                           
                            $name = Auth::user()->name;
                            $words = explode(' ', $name); // Split the string by whitespace
                            $truncatedName = implode(' ', array_slice($words, 0, 2)); // Take the first two elements and rejoin them
                            echo $truncatedName;
                            ?>
                        </span>
                      <i class="ti-angle-down"></i>
                  </a>
                  <ul class="show-notification profile-notification">
                     
                      <li>
                          <a href="#">
                              <i class="ti-user"></i> Profile
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <i class="ti-email"></i> Mes Messages
                          </a>
                         
                      </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="ti-layout-sidebar-left"></i>{{ __('Deconnexion') }}
                            </x-dropdown-link>
                            </form>
                    </li>
                     
                  </ul>
              </li>
          </ul>
      </div>
  </div>
</nav>
  <!-- Navbar End -->
