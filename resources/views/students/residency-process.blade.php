@extends('layouts.main', ['activePage' => 'residency-process', 'title' => __(''), 'titlePage' => 'Estudiantes'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Proceso de residencia profesional</h4>
            </div>

            <div class="card-body">
                {{-- Solicitud de residencias --}}
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('students.residencyRequest') }}" method="POST">
                            @csrf
                            <button class="btn btn-block btn-{{ $student->residencyRequest->btn_color }}">
                                Solicitud de residencias
                            </button>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info">
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-success">
                            Ver documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <button
                            class="btn btn-block btn-warning"
                            @if ($student->residencyRequest->corrections->isEmpty()) disabled @endif
                            data-toggle="modal"
                            data-target="#residencyRequestCorrectionsModal"
                        >
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Solicitud de residencias end --}}

                <form action="">
                    <button class="btn btn-block btn-warning" disabled>
                        Carta de presentación
                    </button>
                </form>
                <form action="">
                    <button class="btn btn-block btn-warning" disabled>
                        Carta de compromiso
                    </button>
                </form>
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
    @if ($student->residencyRequest->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="residencyRequestCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.residencyRequestMarkCorrectionsAsSolved') }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->residencyRequest->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" @if (!$student->residencyRequest->needsCorrections()) disabled @endif >Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endpush
