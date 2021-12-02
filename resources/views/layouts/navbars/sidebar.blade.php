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



            {{-- Menu despegable
            <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
                <i><img style="width:25px" src="{{ asset('img/laravel.svg') }}"></i>
                <p>{{ __('Laravel Examples') }}
                    <b class="caret"></b>
                </p>
                </a>

                <div class="collapse show" id="laravelExample">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                    <a class="nav-link" href="#">
                        <span class="sidebar-mini"> UP </span>
                        <span class="sidebar-normal">{{ __('User profile') }} </span>
                    </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" href="#">
                        <span class="sidebar-mini"> UM </span>
                        <span class="sidebar-normal"> {{ __('User Management') }} </span>
                    </a>
                    </li>
                </ul>
                </div>
                --}}

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
