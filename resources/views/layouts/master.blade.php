<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@yield('page-title')</title>

      <link rel="stylesheet" href="{{ asset('/css/app.css') }}" type="text/css">

      <link rel="stylesheet" href="{{ asset('/css/style.css') }}" type="text/css">
      <link rel="stylesheet" href="{{ asset('/css/datatables.css') }}" type="text/css">
      <link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css') }}" type="text/css">

   </head>
   <body class="hold-transition sidebar-mini">
      <div class="wrapper" id="app">
         <!-- Navbar -->
         <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
               </li>
               
               <!-- <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/home" class="nav-link">
                     <p>Home</p>
                  </router-link>
               </li>
               @if(auth()->check() && Auth::user()->id == 1)
               <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/contact" class="nav-link">
                     <p>Contact {{Auth::user()->id}} </p>
                  </router-link>
               </li>
               @endif -->
            </ul>
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
               <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                     <button class="btn btn-navbar" type="submit">
                     <i class="fas fa-search"></i>
                     </button>
                  </div>
               </div>
            </form>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
               <!-- Messages Dropdown Menu -->
               <li class="nav-item dropdown">
                  <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="fas fa-comments"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                     <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                           <img src="{{ asset('/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                           <div class="media-body">
                              <h3 class="dropdown-item-title">
                                 Brad Diesel
                                 <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                              </h3>
                              <p class="text-sm">Call me whenever you can...</p>
                              <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
                           </div>
                        </div>
                        <!-- Message End -->
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                           <img src="{{ asset('/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                           <div class="media-body">
                              <h3 class="dropdown-item-title">
                                 John Pierce
                                 <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                              </h3>
                              <p class="text-sm">I got your message bro</p>
                              <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
                           </div>
                        </div>
                        <!-- Message End -->
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                           <img src="{{ asset('/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                           <div class="media-body">
                              <h3 class="dropdown-item-title">
                                 Nora Silvester
                                 <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                              </h3>
                              <p class="text-sm">The subject goes here</p>
                              <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
                           </div>
                        </div>
                        <!-- Message End -->
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                  </div>
               </li>
               <!-- Notifications Dropdown Menu -->
               <li class="nav-item dropdown">
                  <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="fas fa-bell"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                     <span class="dropdown-header">15 Notifications</span>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i> 4 new messages
                     <span class="float-right text-muted text-sm">3 mins</span>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                     <i class="fas fa-users mr-2"></i> 8 friend requests
                     <span class="float-right text-muted text-sm">12 hours</span>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                     <i class="fas fa-file mr-2"></i> 3 new reports
                     <span class="float-right text-muted text-sm">2 days</span>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                  </div>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="fas fa-cogs"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                     <i class="fas fa-user"></i>&nbsp;Profile
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item">
                     <i class="fas fa-key mr-1"></i>&nbsp;Change Password
                     </a>
                     <div class="dropdown-divider"></div>
                     <!-- <a href="#" class="dropdown-item"> -->
                      <a href="{{ route('logout') }}" class="dropdown-item">
                     <i class="fas fa-sign-out-alt mr-1"></i>&nbsp;Logout
                     </a>
                     <div class="dropdown-divider"></div>
                  </div>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                     class="fas fa-th-large"></i></a>
               </li>
            </ul>
         </nav>
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/home" class="brand-link">
            <img src="{{ asset('/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
            <!-- <span class="brand-text font-weight-light">Loyalty Card</span> -->
            </a>
            <div class="sidebar">
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <img src="{{ asset('/img/admin-user.png') }}" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                     <a href="#" class="d-block">{{Auth::user()->name}}</a>
                  </div>
               </div>
               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <li class="nav-item">
                         <router-link to="/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Dashboard</p>
                         </router-link>
                      </li>
                      <!-- <li class="nav-item has-treeview menu-close">
                         <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                               Module Transection
                               <i class="right fa fa-angle-left"></i>
                            </p>
                         </a>
                         <ul class="nav nav-treeview">
                            <li class="nav-item">                               
                              <router-link to="/items" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>Items</p>
                              </router-link>
                            </li>
                            <li class="nav-item">
                               <router-link to="/modules" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>Module</p>
                              </router-link>
                            </li>
                         </ul>
                      </li> -->
                      <li class="nav-item">
                         <router-link to="/customers" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Customers</p>
                         </router-link>
                      </li>
                      <li class="nav-item">
                         <router-link to="/packages" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Packages</p>
                         </router-link>
                      </li>
                      <li class="nav-item">
                         <router-link to="/services" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Services</p>
                         </router-link>
                      </li>
                      @if(auth()->check() && Auth::user()->user_type == 1)
                        <li class="nav-item">
                           <router-link to="/admin-panel" class="nav-link">
                              <i class="nav-icon fas fa-circle"></i>
                              <p>Admin Panel</p>
                           </router-link>
                        </li>
                      @endif
                      <!-- <li class="nav-item">
                         <router-link to="/test" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Test</p>
                         </router-link>
                      </li>  -->                     
                   </ul>
               </nav>
            </div>
         </aside>
         <div class="content-wrapper">
            @section('contetn-page-header')        
            @show
            <div class="content">
               @section('main-content')
               @show
            </div>
         </div>
         <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
               <h5>Title</h5>
               <p>Sidebar content</p>
            </div>
         </aside>
         <footer class="main-footer">
            @section('main-footer')        
            @show
         </footer>
      </div>

      <script type="text/javascript" charset="utf8" src="{{ asset('/js/app.js') }}"></script>
      <script type="text/javascript" charset="utf8" src="{{ asset('/js/datatable.js') }}"></script>
      <script type="text/javascript" charset="utf8" src="{{ asset('/js/dataTables.buttons.min.js') }}"></script>
      <script type="text/javascript" charset="utf8" src="{{ asset('/js/buttons.flash.min.js') }}"></script>
      <script type="text/javascript" charset="utf8" src="{{ asset('/js/jszip.min.js') }}"></script>
      <script type="text/javascript" charset="utf8" src="{{ asset('/js/pdfmake.min.js') }}"></script>
      <script type="text/javascript" charset="utf8" src="{{ asset('/js/vfs_fonts.js') }}"></script>
      <script type="text/javascript" charset="utf8" src="{{ asset('/js/buttons.html5.min.js') }}"></script>
      <script type="text/javascript" charset="utf8" src="{{ asset('/js/buttons.print.min.js') }}"></script>
      <script type="text/javascript" charset="utf8" src="{{ asset('/js/buttons.colVis.min.js') }}"></script>
      <script type="text/javascript" charset="utf8" src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>


   </body>
</html>