@extends('layouts.main', ['activePage' => 'teachers', 'title' => __(''), 'titlePage' => 'Profesores'])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Editar profesor</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('teachers.update', $teacher)}}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- EMAIL --}}
                    <x-inputs.text-field-row
                        name="email"
                        label="Correo electrónico"
                        placeholder="Ingrese el correo electrónico"
                        autofocus
                        :default-value="$teacher->user->email"
                    />

                    {{-- FIRST NAME --}}
                    <x-inputs.text-field-row
                        name="first_name"
                        label="Nombres"
                        placeholder="Ingrese el nombre"
                        :default-value="$teacher->first_name"
                    />

                    {{-- FATHER'S LAST NAME --}}
                    <x-inputs.text-field-row
                        name="fathers_last_name"
                        label="Apellido paterno"
                        placeholder="Ingrese el apellido paterno"
                        :default-value="$teacher->fathers_last_name"
                    />

                    {{-- MOTHERS'S LAST NAME --}}
                    <x-inputs.text-field-row
                        name="mothers_last_name"
                        label="Apellido materno"
                        placeholder="Ingrese el apellido materno"
                        :default-value="$teacher->mothers_last_name"
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
                                    <option value="m" @if (old('sex', $teacher->sex) == 'm') selected @endif>Masculino</option>
                                    <option value="f" @if (old('sex', $teacher->sex) == 'f') selected @endif>Femenino</option>
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
                        :default-value="$teacher->curp"
                    />

                    {{-- PHONE NUMBER --}}
                    <x-inputs.text-field-row
                        name="phone_number"
                        label="Teléfono"
                        placeholder="Ingrese número de teléfono"
                        :default-value="$teacher->phone_number"
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
                                        <option value="{{ $state->id }}" @if ($state->id == old('state_id', $teacher->state_id)) selected @endif>{{ $state->name }}</option>
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
                    <div class="text-right">
                        <button class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>

            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Cambiar contraseña</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('teachers.updatePassword', $teacher) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- PASSWORD --}}
                        <x-inputs.text-field-row
                            name="password"
                            label="contraseña nueva"
                            placeholder="Ingrese la contraseña nueva"
                            type="password"
                        />
                        {{-- CONFIRM PASSWORD --}}
                        <x-inputs.text-field-row
                            name="password_confirmation"
                            label="confirmar contraseña"
                            placeholder="confirme la contraseña nueva"
                            type="password"
                        />
                        <div class="text-right">
                                <button class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
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
                .map((municipality) => `<option value="${municipality.id}" ${municipality.id == @json(old('municipality_id', $teacher->municipality_id)) ? 'selected' : ''}>${municipality.name}</option>`)
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
                .map((locality) => `<option value="${locality.id}" ${locality.id == @json(old('locality_id', $teacher->locality_id)) ? 'selected' : ''}>${locality.name}</option>`)
                .join('');

            $('#locality_id').html(`
                <option value="" selected disabled>Seleccione una opción</option>
                ${localities}
            `);
        }).trigger('change');
    });
</script>
@endpush

