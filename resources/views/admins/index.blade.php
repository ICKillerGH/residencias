@extends('layouts.main', ['activePage' => 'admins', 'title' => __(''), 'titlePage' => 'Administradores'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
        <div class="alert alert-{{ $alert['type'] }}" role="alert">
            {{ $alert['message'] }}
        </div>
        @endif

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Administradores</h4>
                <p class="card-category">Lista de administradores</p>
            </div>
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('admins.create') }}" class="btn btn-success btn-sm">Añadir administrador</a>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <tr>
                                <th>Id</th>
                                <th>Correo</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->admin->first_name }}</td>
                                    <td>{{ $admin->admin->last_name }}</td>
                                    <td class="text-nowrap text-right">
                                        <a href="" class="btn btn-sm btn-info" title="Ver detalles">
                                            <i class="material-icons">details</i>
                                        </a>
                                        <form
                                            action="{{ route('admins.destroy', $admin) }}"
                                            method="POST"
                                            class="d-inline-block delete-admin-form"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Sin registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $admins->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>        
        const deleteAdminForms = document.querySelectorAll('.delete-admin-form');
        
        deleteAdminForms.forEach(form => form.addEventListener('submit', function(e) {
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
