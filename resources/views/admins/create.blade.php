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
                <h4 class="card-title">Añadir administrador</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admins.store') }}" method="POST">
                    @csrf
                    {{-- EMAIL --}}
                    <x-inputs.text-field-row
                        name="email"
                        label="Correo electrónico"
                        placeholder="Ingrese el correo electrónico"
                    />

                    {{-- FIRST NAME --}}
                    <x-inputs.text-field-row
                        name="first_name"
                        label="Nombres"
                        placeholder="Ingrese los nombres"
                    />

                    {{-- LAST NAME --}}
                    <x-inputs.text-field-row
                        name="last_name"
                        label="Apellidos"
                        placeholder="Ingrese los apellidos"
                    />

                    {{-- PASSWORD --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="password" class="d-block">Contraseña</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese la contraseña">
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- PASSWORD CONFIRMATION --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="password_confirmation" class="d-block">Confirmar contraseña</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Ingrese la contraseña">
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
