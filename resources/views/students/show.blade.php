@extends('layouts.main', ['activePage' => 'students', 'title' => __(''), 'titlePage' => 'Detalles de estudiante'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        @if ($errors->isNotEmpty())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- STUDENT DETAILS CARD --}}
        <div class="card mb-5">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Datos de {{ $student->full_name }}</h4>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    {{-- CURP --}}
                    <div class="col-md-12">
                        <p class="mb-0"><b>CURP:</b></p>
                        {{ $student->curp }}
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- NAMES --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Nombre(s):</b></p>
                        {{ $student->first_name }}
                    </div>
                    {{-- FATHER'S LAST NAME --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Apellido paterno:</b></p>
                        {{ $student->fathers_last_name }}
                    </div>
                    {{-- MOTHERS'S LAST NAME --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Nombre(s):</b></p>
                        {{ $student->mothers_last_name }}
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- SEX --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Sexo:</b></p>
                        {{ $student->sex_text }}
                    </div>
                    {{-- CAREER --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Carrera:</b></p>
                        {{ $student->career->name }}
                    </div>
                    {{-- ACCOUNT NUMBER --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Número de cuenta:</b></p>
                        {{ $student->account_number }}
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- IS ENROLLED --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Inscrito:</b></p>
                        {{ $student->is_enrolled  ? 'Si' : 'No' }}
                    </div>
                    {{-- IS SOCIAL SERVICE CONCLUDED --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Servicio social concluido:</b></p>
                        {{ $student->is_social_service_concluded  ? 'Si' : 'No' }}
                    </div>
                    {{-- CAREER PERCENTAGE --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Porcentaje de la carrera:</b></p>
                        {{ $student->career_percentage }}%
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- STATE --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Estado:</b></p>
                        {{ $student->state->name }}
                    </div>
                    {{-- MUNICIPALITY --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Municipio:</b></p>
                        {{ $student->municipality->name }}
                    </div>
                    {{-- LOCALITY --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Localidad:</b></p>
                        {{ $student->locality->name }}
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- PHONE NUMBER --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Teléfono:</b></p>
                        {{ $student->phone_number }}
                    </div>
                </div>
            </div>
        </div>
        {{-- STUDENT DETAILS CARD END --}}

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Proceso de residencia profesional</h4>
            </div>

            <div class="card-body">
                {{-- Solicitud de residencias --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.residency-request-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.residencyRequestMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessResidencyRequest) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#residencyRequestCorrectionsModal"
                            @if (!$student->residencyRequest || ($student->residencyRequest && !$student->residencyRequest->needsCorrections())) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Solicitud de residencias end --}}

                {{-- Carta de presentación --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.presentation-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.presentationLetterMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessPresentationLetter) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#presentatioLetterCorrectionsModal"
                            @if (!$student->presentationletter || !$student->presentationletter->needsCorrections()) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div> 
                {{-- Carta de presentación end --}}
            
                {{-- Carta de compromiso --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.commitment-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.commitmentLetterMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessCommitmentLetter) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#commitmentLetterCorrectionsModal"
                            @if (!$student->commitmentLetter || !$student->commitmentLetter->needsCorrections()) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de compromiso end --}}
                <form action="">
                    <button class="btn btn-block btn-warning" disabled>
                        Carta de aceptación
                    </button>
                </form>
                <form action="">
                    <button class="btn btn-block btn-warning" disabled>
                        Asignación de asesor interno
                    </button>
                </form>
                <form action="">
                    <button class="btn btn-block btn-warning" disabled>
                        Anteproyecto
                    </button>
                </form>
                <form action="">
                    <button class="btn btn-block btn-warning" disabled>
                        Carta de término
                    </button>
                </form>
                <form action="">
                    <button class="btn btn-block btn-warning" disabled>
                        Cédula de cumplimiento
                    </button>
                </form>
                <form action="">
                    <button class="btn btn-block btn-warning" disabled>
                        Estructura del informe final
                    </button>
                </form>
                <form action="">
                    <button class="btn btn-block btn-warning" disabled>
                        Carta de entrega de proyecto
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    {{-- RESIDENCY REQUEST CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="residencyRequestCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.residencyRequestCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- RESIDENCY REQUEST CORRECTIONS MODAL END --}}


    {{-- PRESENTATION LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="presentatioLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.presentatioLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- PRESENTATION LETTER CORRECTIONS MODAL END --}}

    {{-- COMMITMENT LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="commitmentLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.commitmentLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- COMMITMENT CORRECTIONS MODAL END --}}
@endpush
