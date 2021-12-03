<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="" class="simple-text logo-normal">
            {{ __('Residencia Profesional') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>



            {{-- Menu despegable --}}
            <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'company-info') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#profile-menu-item" aria-expanded="true">
                    <p>
                        <i class="material-icons">account_circle</i>
                        Perfil<b class="caret"></b>
                    </p>
                </a>

                <div class="collapse" id="profile-menu-item">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('students.personalInfo') }}">
                                <span class="sidebar-mini">
                                    <i class="material-icons">dashboard</i>
                                </span>
                                <span class="sidebar-normal">Información personal</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'company-info' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('students.companyInfo')}}">
                                <i class="material-icons">dashboard</i>
                                <span class="sidebar-mini">
                                </span>
                                <span class="sidebar-normal">Información de la empresa</span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'company-info' ? ' active' : '' }}">
                            <a class="nav-link" href="#">
                                <i class="material-icons">dashboard</i>
                                <span class="sidebar-mini">
                                </span>
                                <span class="sidebar-normal">Proceso de residencia</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            @can('index', App\Models\Admin::class)
            <li class="nav-item{{ $activePage == 'admins' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admins.index') }}">
                <i class="material-icons">manage_accounts</i>
                    <p>Administradores</p>
                </a>
            </li>
            @endcan

            @can('index', App\Models\Student::class)
            <li class="nav-item{{ $activePage == 'students' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('students.index') }}">
                <i class="material-icons">people</i>
                    <p>Estudiantes</p>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</div>
