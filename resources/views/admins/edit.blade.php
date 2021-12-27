@extends('layouts.main', ['activePage' => 'admins', 'title' => __(''), 'titlePage' => 'Administradores'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Editar administrador</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admins.update', $admin) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- EMAIL --}}
                    <x-inputs.text-field-row
                        name="email"
                        label="Correo electrónico"
                        placeholder="Ingrese el correo electrónico"
                        :default-value="$admin->user->email"
                    />

                    {{-- FIRST NAME --}}
                    <x-inputs.text-field-row
                        name="first_name"
                        label="Nombres"
                        placeholder="Ingrese los nombres"
                        :default-value="$admin->first_name"
                    />

                    {{-- LAST NAME --}}
                    <x-inputs.text-field-row
                        name="last_name"
                        label="Apellidos"
                        placeholder="Ingrese los apellidos"
                        :default-value="$admin->last_name"
                    />

                    <div class="text-right">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Cambiar contraseña</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                        {{-- PASSWORD --}}
                        <x-inputs.text-field-row
                        name="password"
                        label="contraseña nueva"
                        placeholder="Ingrese la contraseña nueva"
                        />
                        {{-- CONFIRM PASSWORD --}}
                        <x-inputs.text-field-row
                        name="confirm_password"
                        label="confirmar contraseña"
                        placeholder="confirme la contraseña nueva"
                        />
                </form>
            </div>
        </div>

    </div>
@endsection
