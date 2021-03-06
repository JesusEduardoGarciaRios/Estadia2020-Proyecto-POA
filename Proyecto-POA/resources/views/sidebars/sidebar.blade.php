<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a class="d-block">
            <i class="fas fa-user fa-lg"></i>&nbsp;
                Rol
            </a>
        </div>
    </div> -->
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/user3.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            @if (Auth::guest())
                <a href="#" class="d-block">Sin Sesión</a>
            @else
                <a href="#" class="d-block">{{ Auth::user()->rol }}</a>
            @endif
        </div>
      </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                                with font-awesome or any other icon font library -->
            <li class="nav-header">ACCIONES</li>
            @if (Auth::guest())
                <!-- Boton iniciar sesión -->
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="nav-icon fas fa-share"></i>
                        <p>
                            Iniciar Sesión
                        </p>
                    </a>
                </li>
            @endif
            <!-- Cerrar Sesión | solo se muestra si existe una sesión -->
            @auth
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-reply"></i>
                        <p>
                            Cerrar Sesión
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endauth
            <!-- Ayuda -->
            <li @click="menu=5" class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-question-circle"></i>
                    <p>
                        Ayuda
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>