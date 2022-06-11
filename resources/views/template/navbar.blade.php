<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #0f4c81;">
<!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" style="color: #fff;" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="btn-group" role="group">

                <a id="btnGroupDrop1" style="color: #fff; margin-right: 110px;" type="button" class="dropdown-toggle text-capitalize" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="nav-icon fas fa-user-circle"></i> &nbsp; {{Auth::user()->nama}}
                </a>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    @if (Auth::user()->role == "admin")
                        <a class="dropdown-item" href="{{route('admin-profile')}}"><i class="nav-icon fas fa-user-circle"></i> &nbsp;Profile</a>
                    @endif

                    <a class="dropdown-item" href="{{route('logout')}}"><i class="nav-icon fas fa-sign-out-alt"></i> &nbsp; Log Out</a>
                    
                </div>
              </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
