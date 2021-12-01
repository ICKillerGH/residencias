@extends('layouts.main', ['activePage' => 'admins', 'title' => __(''), 'titlePage' => 'Administradores'])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Añadir administrador</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admins.store') }}" method="POST">
                    @csrf
                    {{-- EMAIL --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="email" class="d-block">Email</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="email"
                                    id="email"
                                    placeholder="Ingrese el email"
                                    value="{{ old('email') }}"
                                    autofocus
                                >
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- FIRST NAME --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="first_name" class="d-block">Nombres</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="first_name"
                                    id="first_name"
                                    placeholder="Ingrese los nombres"
                                    value="{{ old('first_name') }}"
                                >
                            </div>
                            @error('first_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- LAST NAME --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="last_name" class="d-block">Apellidos</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="last_name"
                                    id="last_name"
                                    placeholder="Ingrese los apellidos"
                                    value="{{ old('last_name') }}"
                                >
                            </div>
                            @error('last_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

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
