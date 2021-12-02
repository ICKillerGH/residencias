@extends('layouts.main', ['activePage' => 'students', 'title' => __(''), 'titlePage' => 'Estudiantes'])

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
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf

                    {{-- EMAIL --}}
                    <x-inputs.text-field-row
                        name="email"
                        label="Correo electrónico"
                        placeholder="Ingrese el correo electrónico"
                        autofocus
                    />

                    {{-- FIRST NAME --}}
                    <x-inputs.text-field-row
                        name="first_name"
                        label="Nombres"
                        placeholder="Ingrese el nombre"
                    />

                    {{-- FATHER'S LAST NAME --}}
                    <x-inputs.text-field-row
                        name="fathers_last_name"
                        label="Apellido paterno"
                        placeholder="Ingrese el apellido paterno"
                    />

                    {{-- MOTHERS'S LAST NAME --}}
                    <x-inputs.text-field-row
                        name="mothers_last_name"
                        label="Apellido materno"
                        placeholder="Ingrese el apellido materno"
                    />

                    {{-- CARREER --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="career_id" class="d-block">Carrera</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="career_id"
                                    id="career_id"
                                >
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($careers as $career)
                                        <option
                                            value="{{ $career->id }}"
                                            @if (old('career_id') == $career->id) selected @endif
                                        >{{ $career->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('career_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- ACCOUNT NUMBER --}}
                    <x-inputs.text-field-row
                        name="account_number"
                        label="Número de cuenta"
                        placeholder="Ingrese número de cuenta"
                    />

                    {{-- SEX --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="sex" class="d-block">Sexo</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="sex"
                                    id="sex"
                                >
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="m" @if (old('sex') == 'm') selected @endif>Masculino</option>
                                    <option value="f" @if (old('sex') == 'f') selected @endif>Femenino</option>
                                </select>
                            </div>
                            @error('sex')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- CURP --}}
                    <x-inputs.text-field-row
                        name="curp"
                        label="CURP"
                        placeholder="Ingrese el curp"
                    />

                    {{-- CAREER PERCENTAGE --}}
                    <x-inputs.text-field-row
                        name="career_percentage"
                        label="Porcentaje de la carrera"
                        placeholder="Ingrese porcentaje"
                        min="1"
                        max="100"
                        step="0.1"
                    />

                    {{-- ENROLLED --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="is_enrolled" class="d-block">Inscrito</label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="checkbox"
                                id="is_enrolled"
                                name="is_enrolled"
                                @if (old('is_enrolled')) checked @endif
                            >
                        </div>
                    </div>

                    {{-- SOCIAL SERVICE CONCLUDED --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="is_social_service_concluded" class="d-block">Servicio social concluido</label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="checkbox"
                                id="is_social_service_concluded"
                                name="is_social_service_concluded"
                                @if (old('is_social_service_concluded')) checked @endif
                            >
                        </div>
                    </div>

                    {{-- PHONE NUMBER --}}
                    <x-inputs.text-field-row
                        name="phone_number"
                        label="Teléfono"
                        placeholder="Ingrese número de teléfono"
                    />

                    {{-- State --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="state_id" class="d-block">Estado</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="state_id"
                                    id="state_id"
                                >
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" @if ($state->id == old('state_id')) selected @endif>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('state_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- MUNCIPALITY --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="municipality_id" class="d-block">Municipio</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="municipality_id"
                                    id="municipality_id"
                                >
                                    <option value="" selected disabled>Seleccione una opción</option>
                                </select>
                            </div>
                            @error('municipality_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- LOCALITY --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="locality_id" class="d-block">Localidad</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="locality_id"
                                    id="locality_id"
                                >
                                    <option value="" selected disabled>Seleccione una opción</option>
                                </select>
                            </div>
                            @error('locality_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- PASSWORD --}}
                    <x-inputs.text-field-row
                        name="password"
                        label="Contraseña"
                        placeholder="Ingrese la contraseña"
                        type="password"
                    />


                    {{-- PASSWORD CONFIRMATION --}}
                    <x-inputs.text-field-row
                        name="password_confirmation"
                        label="Confirmar contraseña"
                        placeholder="Ingrese la contraseña"
                        type="password"
                    />

                    <div class="text-right">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const states = @json($states);

        $(() => {
            $('#state_id').change((e) => {
                const stateId = Number(e.target.value);
                const state = states.find((state) => state.id === stateId);

                if (!state) return;

                const municipalities = state
                    .locations
                    .map((municipality) => `<option value="${municipality.id}" ${municipality.id == @json(old('municipality_id')) ? 'selected' : ''}>${municipality.name}</option>`)
                    .join('');

                $('#municipality_id').html(`
                    <option value="" selected disabled>Seleccione una opción</option>
                    ${municipalities}
                `);
            }).trigger('change');

            $('#municipality_id').change((e) => {
                const stateId = Number($('#state_id').val());
                const municipalityId = Number(e.target.value);
                const state = states.find((state) => state.id === stateId);

                if (!state) return;

                const municipality = state.locations.find((municipality) => municipality.id === municipalityId);

                if (!municipality) return;

                const localities = municipality
                    .locations
                    .map((locality) => `<option value="${locality.id}" ${locality.id == @json(old('locality_id')) ? 'selected' : ''}>${locality.name}</option>`)
                    .join('');

                $('#locality_id').html(`
                    <option value="" selected disabled>Seleccione una opción</option>
                    ${localities}
                `);
            }).trigger('change');
        });
    </script>
@endpush
