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
                        <button
                            class="btn btn-block btn-info"
                            data-target="#residencyRequestUploadDocModal"
                            data-toggle="modal"
                            @if ($student->residencyRequest->signed_document) disabled @endif
                        >
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a
                            @if ($student->residencyRequest->signed_document)
                                href="{{ route('students.residencyRequestDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->residencyRequest->signed_document) disabled @endif"
                            target="_blank"
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
                        <button
                            class="btn btn-block btn-info"
                            data-target="#presentationLetterUploadDocModal"
                            data-toggle="modal"
                            @if ($student->presentationLetter->signed_document) disabled @endif
                        >
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                    <a
                        @if ($student->presentationLetter->signed_document)
                            href="{{ route('students.presentationLetterDownloadSignedDoc', $student) }}"
                        @endif
                        class="btn btn-block btn-success @if (!$student->presentationLetter->signed_document) disabled @endif"
                        target="_blank"
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
                        <button
                            class="btn btn-block btn-info"
                            data-target="#commitmentLetterUploadDocModal"
                            data-toggle="modal"
                            @if ($student->commitmentLetter->signed_document) disabled @endif
                        >
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a
                            @if ($student->commitmentLetter->signed_document)
                                href="{{ route('students.commitmentLetterDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->commitmentLetter->signed_document) disabled @endif"
                            target="_blank"
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

                {{-- Carta de aceptación --}}
                <div class="row">
                    <div class="col-md-8">
                        @if (!$student->acceptanceLetter->exists())
                            <button
                                class="btn btn-block btn-info"
                                data-target="#acceptanceLetterUploadDocModal"
                                data-toggle="modal"
                            >
                                Cargar carta de aceptación
                            </button>
                        @else
                            <a
                                href="{{ route('students.acceptanceLetterDownloadSignedDoc', $student) }}"
                                class="btn btn-block btn-{{ $student->acceptanceLetter->btn_color }}"
                                target="_blank"
                            >
                                Carta de aceptación
                            </a>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <button
                            class="btn btn-block btn-warning"
                            data-toggle="modal"
                            data-target="#acceptanceLetterCorrectionsModal"

                        >
                            Ver correcciones
                        </button>
                    </div>
                </div>                
                {{-- Carta de aceptación end --}}

                {{-- Carta de asignación --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.assignment-letter-btn')
                    </div>
                    <div class="col-md-2">
                        <button
                            class="btn btn-block btn-info"
                            data-target=""
                            data-toggle="modal"
                        >
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a
                          
                            class="btn btn-block btn-success"
                            target="_blank"
                        >
                            Ver documento
                         </a>
                    </div>
                    <div class="col-md-2">
                        <button
                            class="btn btn-block btn-warning"
                            data-toggle="modal"
                            data-target=""
                        >
                            Ver correcciones
                        </button>
                    </div>
                  </div>
                {{-- Carta de asignación end --}}

                {{-- Anteproyecto --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.preliminary-letter-btn')
                    </div>
                    <div class="col-md-2">
                        <button
                            class="btn btn-block btn-info"
                            data-target=""
                            data-toggle="modal"
                        >
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a
                          
                            class="btn btn-block btn-success"
                            target="_blank"
                        >
                            Ver documento
                         </a>
                    </div>
                    <div class="col-md-2">
                        <button
                            class="btn btn-block btn-warning"
                            data-toggle="modal"
                            data-target=""
                        >
                            Ver correcciones
                        </button>
                    </div>
                  </div>
                 {{-- Anteproyecto end --}}
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
                            <label for="signed_document_rr">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_rr" accept="application/pdf" required>
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

    {{-- UPLOAD DOC PRESENTATION LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="presentationLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.presentationLetterUploadSignedDoc', $student) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="signed_document_pl">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_pl" accept="application/pdf" required>
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
    {{-- UPLOAD DOC COMMITMENT LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="commitmentLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.commitmentLetterUploadSignedDoc', $student) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="signed_document_cl">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_cl" accept="application/pdf" required>
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
    {{-- UPLOAD DOC ACCEPTANCE LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="acceptanceLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.acceptanceLetterUploadSignedDoc', $student) }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar carta de aceptación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document_al">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_al" accept="application/pdf" required>
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
     {{-- CORRECTIONS MODAL --}}
     @if ($student->acceptanceLetter->corrections->isNotEmpty())
     <div class="modal" tabindex="-1" id="acceptanceLetterCorrectionsModal">
         <div class="modal-dialog">
             <div class="modal-content">
                 <form action="{{ route('students.acceptanceLetterMarkCorrectionsAsSolved', $student) }}" method="POST">
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
                             @foreach ($student->acceptanceLetter->corrections as $correction)
                                 <li>{{ $correction->content }}</li>
                             @endforeach
                         </ul>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                         <button class="btn btn-primary" @if (!$student->acceptanceLetter->needsCorrections()) disabled @endif >Marcar como corregida</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 @endif
@endpush
