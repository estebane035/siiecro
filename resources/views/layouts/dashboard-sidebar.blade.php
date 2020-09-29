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
                            <span class="text-muted text-xs block">{{ Auth::user()->rol()->first()->nombre }} <b class="caret"></b></span> 
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
            <li class="{{ $menu == "dashboard" ? "active" : "" }}">
                <a href="{{ route('dashboard.dashboard.index') }}"><i class="fa fa-bar-chart"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{ in_array($menu, ["obras", "solicitudes-intervencion", "tipo-objeto", "tipo-bien-cultural", "temporalidad", "epoca"]) ? "active" : "" }}">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Obras</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ $menu == "solicitudes-intervencion" ? "active" : "" }}">
                        <a href="{{ route('dashboard.obras.solicitudes') }}">Solicitudes</a>
                    </li>
                    <li class="{{ $menu == "obras" ? "active" : "" }}">
                        <a href="{{ route('dashboard.obras.index') }}">Listado</a>
                    </li>
                    <li>
                        <a href="#">Catálogos <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level collapse" style="height: 0px;">
                            <li><a href="{{ route('dashboard.obras-epoca.index') }}">Época</a></li>
                            <li><a href="{{ route('dashboard.obras-temporalidad.index') }}">Temporalidad</a></li>
                            <li><a href="{{ route('dashboard.obras-tipo-bien-cultural.index') }}">Tipo Bien Cultural</a></li>
                            <li><a href="{{ route('dashboard.obras-tipo-objeto.index') }}">Tipo Objeto</a></li>
                            <li><a href="{{ route('dashboard.obras-responsables-ecro.index') }}">Responsables Ecro</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="{{ $menu == "areas" ? "active" : "" }}">
                <a href="{{ route('dashboard.areas.index') }}"><i class="fa fa-folder"></i> <span class="nav-label">Áreas de la ECRO</span></a>
            </li>
            <li class="{{ $menu == "usuarios" ? "active" : "" }}">
                <a href="{{ route('dashboard.usuarios.index') }}"><i class="fa fa-user-circle-o"></i> <span class="nav-label">Usuarios</span></a>
            </li>
            <li class="{{ $menu == "roles" ? "active" : "" }}">
                <a href="{{ route('dashboard.roles.index') }}"><i class="fa fa-lock"></i> <span class="nav-label">Roles</span></a>
            </li>
        </ul>
    </div>
</nav>