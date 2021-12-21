@extends('layouts.main', ['activePage' => 'residency-process', 'title' => __(''), 'titlePage' => 'Estudiantes'])

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
                    {{ $error }}
                @endforeach
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
                        @include('residency-process.partials.residency-request-btn')
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info" data-target="#residencyRequestUploadDocModal" data-toggle="modal">
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a
                            @if ($student->residencyRequest->signed_document)
                                href="{{ route('students.residencyRequestDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->residencyRequest->signed_document) disabled @endif"
                        >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button
                            class="btn btn-block btn-warning"
                            data-toggle="modal"
                            data-target="#residencyRequestCorrectionsModal"
                        >
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Solicitud de residencias end --}}

                {{-- Carta de presentación --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.presentation-letter-btn')
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info" data-target="" data-toggle="modal">
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a
                            href="#"
                            class="btn btn-block btn-success"
                        >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button
                            class="btn btn-block btn-warning"
                            data-toggle="modal"
                            data-target="#presentationLetterCorrectionsModal"
                        >
                            Ver correcciones
                        </button>
                    </div>

                </div>
                {{-- Carta de presentación end --}}

                {{-- Carta de compromiso --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.commitment-letter-btn')  
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info" data-target="" data-toggle="modal">
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a
                            href="#"
                            class="btn btn-block btn-success"
                        >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button
                            class="btn btn-block btn-warning"
                            data-toggle="modal"
                            data-target="#commitmentLetterCorrectionsModal"
                        >
                            Ver correcciones
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
    {{-- CORRECTIONS MODAL --}}
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

    {{-- UPLOAD DOC MODAL --}}
    <div class="modal" tabindex="-1" id="residencyRequestUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.residencyRequestUploadSignedDoc', $student) }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document" accept="application/pdf" required>
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

    {{-- CORRECTIONS MODAL --}}
    @if ($student->presentationLetter->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="presentationLetterCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.presentationLetterMarkCorrectionsAsSolved', $student) }}" method="POST">
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
                                @foreach ($student->presentationLetter->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" @if (!$student->presentationLetter->needsCorrections()) disabled @endif >Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

     {{-- CORRECTIONS MODAL --}}
     @if ($student->commitmentLetter->corrections->isNotEmpty())
     <div class="modal" tabindex="-1" id="commitmentLetterCorrectionsModal">
         <div class="modal-dialog">
             <div class="modal-content">
                 <form action="{{ route('students.commitmentLetterMarkCorrectionsAsSolved', $student) }}" method="POST">
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
                             @foreach ($student->commitmentLetter->corrections as $correction)
                                 <li>{{ $correction->content }}</li>
                             @endforeach
                         </ul>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                         <button class="btn btn-primary" @if (!$student->commitmentLetter->needsCorrections()) disabled @endif >Marcar como corregida</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 @endif
@endpush
