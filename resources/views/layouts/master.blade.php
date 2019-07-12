<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  
  <title>Maingem | Admin Dashboard </title>
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper" id="app">
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" v-model="search" @keyup="searchit()" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit" @keyup="searchit()">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/home" class="brand-link">
      <img src="image/logo/maingem.png" alt="" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Maingem</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="image/profile/areydra.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          <span style="color:#C2C7D0">( {{ Auth::user()->type }} )</span>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-close">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-server"></i>
              <p>
                Data
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Users</p>
                </router-link>
              </li>
            </ul>
          </li>
          @can('isAdmin')
          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-id-card-alt"></i>
              <p>
                Profile
              </p>
            </router-link>
          </li>
          @endcan
          @can('isDeveloper')
          <li class="nav-item">
            <router-link to="/developer" class="nav-link">
              <i class="nav-icon fab fa-dev"></i>
              <p>
                Developer
              </p>
            </router-link>
          </li>          
          @endcan
          <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                    </p>
                </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid">
        @yield('container')
      </div>
    </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block-down">
      Anything you want
    </div>
    <strong>Copyright &copy; 2019 <a href="https://maingem.com">MainGem Corp</a>.</strong> All rights reserved.
  </footer>
</div>

<script> //harus  berada diatas app.js src agar dia bisa dibaca
  window.user = @json(auth()->user()) //membuat variabel user yg bisa diakses seluruh file javascript dengan nilai JSON dari user yg login
</script>
<script src="/js/app.js"></script>
</body>
</html>
