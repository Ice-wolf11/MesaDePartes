<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('panel')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Panel
                </a>
                <div class="sb-sidenav-menu-heading">Panel de trabajador</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Revisión
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @can('ver-mis-derivaciones')
                        <a class="nav-link" href="{{route('derivaciones.show',['id' => auth()->user()->id])}}">Mis Tramites Pendientes</a>
                        @endcan
                        @can('ver-mis-revisiones')
                        <a class="nav-link" href="{{route('revisiones.show',['id' => auth()->user()->id])}}">Mis Revisiones</a>
                        @endcan
                        @can('ver-tramites')
                        <a class="nav-link" href="{{route('tramites.index')}}">Ver Todos los Tramites</a> 
                        @endcan
                        @can('ver-todas-las-revisiones')
                        <a class="nav-link" href="{{route('revisiones.index')}}">Ver Todas las revisiones</a>
                        @endcan
                        @can('ver-todas-las-derivaciones')
                        <a class="nav-link" href="{{route('derivaciones.index')}}">Tramites Asignados</a>
                        @endcan
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Panel de Administrador</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-screwdriver-wrench"></i></i></div>
                    Administración
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        @can('ver-trabajadores')
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Administrar Usuarios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('trabajadores.index')}}">Ver Usuarios</a>  
                            </nav>
                        </div>
                        @endcan
                        @can('ver-roles')
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Roles y Permisos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('roles.index')}}">Ver Roles</a>
                                
                                
                            </nav>
                        </div>
                        @endcan
                        
                        @can('ver-areas')
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseArea" aria-expanded="false" aria-controls="pagesCollapseArea">
                            Areas Academicas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseArea" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('areas.index')}}">Ver Areas</a>
                                
                                
                            </nav>
                        </div>
                        @endcan
                    </nav>
                </div>
                <!--<div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>-->
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Bienvenido:</div>
            {{auth()->user()->name}}
        </div>
    </nav>
</div>