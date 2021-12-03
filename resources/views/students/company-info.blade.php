@extends('layouts.main', ['activePage' => 'students', 'title' => __(''), 'titlePage' => 'Informacion de la empresa'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-primary">
                <h3 class="card-title">Información de la empresa </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('students.updateCompanyInfo') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- BUSINESS NAME --}}
                    <x-inputs.text-field-row name="business_name" label="Razon social" placeholder="Ingrese la razon social" :default-value="$company->business_name" />

                    {{-- ADDRESS NAME --}}
                    <x-inputs.text-field-row name="address_name" label="Direccion" placeholder="Ingrese la direccion"  :default-value="$company->address_name" />

                    {{-- PERSON NAME IN CHARGE --}}
                    <x-inputs.text-field-row name="person_in_charge" label="Encargado" placeholder="Ingrese la persona encargada"  :default-value="$company->person_in_charge" />

                    {{-- PERSON IN CHARGE POSITION --}}
                    <x-inputs.text-field-row name="person_in_charge_position" label="Cargo" placeholder="Ingrese el cargo"  :default-value="$company->person_in_charge_position" />

                    {{-- E-MAIL --}}
                    <x-inputs.text-field-row name="email" label="E-mail" placeholder="Ingrese el e-mail" :default-value="$company->email" />

                    {{-- OFFICE PHONE NUMBER --}}
                    <x-inputs.text-field-row name="office_phone_number" label="Teléfono Oficina" placeholder="Ingrese el teléfono oficina"  :default-value="$company->office_phone_number" />

                    {{-- PERSONAL PHONE NUMBER --}}
                    <x-inputs.text-field-row name="personal_phone_number" label="Teléfono celular" placeholder="Ingrese el teléfono celular"  :default-value="$company->personal_phone_number" />

                    {{-- COMMERCIAL BUSINESS --}}
                    <x-inputs.text-field-row name="commercial_business" label="Giro comercial" placeholder="Ingrese el giro comercial"  :default-value="$company->commercial_business" />

                    {{-- ZIP CODE --}}
                    <x-inputs.text-field-row name="zip_code" label="Código postal" placeholder="Ingrese el código postal"  :default-value="$company->zip_code" />
                    
                    <div class="text-right">
                        <button class="btn btn-sm btn-success">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
