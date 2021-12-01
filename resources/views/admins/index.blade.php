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
                                    <td></td>
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

