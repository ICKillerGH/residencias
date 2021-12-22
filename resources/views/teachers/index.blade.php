@extends('layouts.main', ['activePage' => 'teachers', 'title' => __(''), 'titlePage' => 'Profesotes'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Profesores</h4>
                <p class="cart-category">Lista de profesores</p>
            </div>

            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('teachers.create') }}" class="btn btn-sm btn-success">Añadir Profesor</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nombres</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Sexo</th>
                                <th>CURP</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher->user_id }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->first_name }}</td>
                                    <td>{{ $teacher->fathers_last_name }}</td>
                                    <td>{{ $teacher->mothers_last_name }}</td>
                                    <td>{{ $teacher->sex_text }}</td>
                                    <td>{{ $teacher->curp }}</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-info" title="Ver detalles">
                                            <i class="material-icons">details</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
@endsection
