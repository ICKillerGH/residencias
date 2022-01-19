@extends('layouts.main', ['activePage' => 'external-advisor', 'title' => __(''), 'titlePage' => 'Asesores Externos'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Asesores Externos</h4>
                <p class="cart-category">Lista de Asesores Externos</p>
            </div>

            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('externalAdvisor.create') }}" class="btn btn-sm btn-success">Añadir Asesor Externo</a>
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
                            @foreach ($externaladvisors as $externaladvisor)
                                <tr>
                                    <td>{{ $externaladvisor->user_id }}</td>
                                    <td>{{ $externaladvisor->email }}</td>
                                    <td>{{ $externaladvisor->first_name }}</td>
                                    <td>{{ $externaladvisor->fathers_last_name }}</td>
                                    <td>{{ $externaladvisor->mothers_last_name }}</td>
                                    <td>{{ $externaladvisor->sex_text }}</td>
                                    <td>{{ $externaladvisor->curp }}</td>
                                    <td>
                                        <a href="{{ route('externalAdvisor.edit', $externaladvisor) }}" class="btn btn-sm btn-info" title="Editar" >
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <form
                                            action="{{ route('externalAdvisor.destroy', $externaladvisor) }}"
                                            method="POST"
                                            class="d-inline-block delete-external-advisor-form"
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
                {{ $externaladvisors->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>        
        const deleteExternalAdvisorForms = document.querySelectorAll('.delete-external-advisor-form');
        
        deleteExternalAdvisorForms.forEach(form => form.addEventListener('submit', function(e) {
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