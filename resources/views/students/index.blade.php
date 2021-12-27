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
                                    <td>{{ $student->user_id }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->fathers_last_name }}</td>
                                    <td>{{ $student->mothers_last_name }}</td>
                                    <td>{{ $student->sex_text }}</td>
                                    <td>{{ $student->curp }}</td>
                                    <td>{{ $student->career->name }}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info" title="Ver detalles">
                                            <i class="material-icons">details</i>
                                        </a>

                                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-info" title="Editar" >
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <form
                                            action="{{ route('students.destroy', $student) }}"
                                            method="POST"
                                            class="d-inline-block delete-student-form"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                    </td>
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

@push('js')
    <script>        
        const deleteStudentForms = document.querySelectorAll('.delete-student-form');
        
        deleteStudentForms.forEach(form => form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Está seguro?',
                text: "Esta acción es irreversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        }))
    </script>
@endpush