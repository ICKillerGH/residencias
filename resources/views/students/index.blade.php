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
                <h4 class="card-title">Estudiantes</h4>
                <p class="cart-category">Lista de estudiantes</p>
            </div>

            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('students.create') }}" class="btn btn-sm btn-success">Añadir estudiante</a>
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
                                <th>Carrera</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->student->first_name }}</td>
                                    <td>{{ $student->student->fathers_last_name }}</td>
                                    <td>{{ $student->student->mothers_last_name }}</td>
                                    <td>{{ $student->student->sex_text }}</td>
                                    <td>{{ $student->student->curp }}</td>
                                    <td>{{ $student->student->career->name }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
