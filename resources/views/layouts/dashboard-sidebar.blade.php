<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <img src="{{ asset('/img/logo.png') }}" class="img-responsive">
                <div class="dropdown profile-element m-t-md">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> 
                            <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                            </span> 
                            <span class="text-muted text-xs block">{{ Auth::user()->rol }} <b class="caret"></b></span> 
                        </span> 
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    ECRO
                </div>
            </li>
            <li>
                <a href="{{ route('dashboard.dashboard.index') }}"><i class="fa fa-bar-chart"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Catalogos</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="#">Catalogo 1</a></li>
                    <li><a href="#">Catalogo 2</a></li>
                    <li><a href="#">Catalogo 3</a></li>
                    <li><a href="#">Catalogo 4</a></li>
                    <li><a href="#">Catalogo 5</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('dashboard.usuarios.index') }}"><i class="fa fa-user-circle-o"></i> <span class="nav-label">Usuarios</span></a>
            </li>
        </ul>
    </div>
</nav>