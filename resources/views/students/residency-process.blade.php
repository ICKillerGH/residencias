@extends('layouts.main', ['activePage' => 'residency-process', 'title' => __(''), 'titlePage' => 'Estudiantes'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Proceso de residencia profesional</h4>
                    </div>

                    <div class="card-body">
                        <form action="">
                            <button class="btn btn-block btn-warning">
                                Solicitud de residencias
                            </button>
                        </form>
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
        </div>
    </div>
@endsection