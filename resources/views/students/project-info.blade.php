@extends('layouts.main', ['activePage' => 'project-info', 'title' => __(''), 'titlePage' => 'Informacion del proyecto'])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-primary">
                <h3 class="card-title">Información del proyecto</h3>
            </div>
            <div class="card-body">

                <form action="{{ route('students.updateProjectInfo')}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    {{-- TITLE --}}
                    <x-inputs.text-field-row name="title" label="Titulo del proyecto"
                        placeholder="Ingresa el titulo del proyecto" :default-value="$project->title" />

                    {{-- START DATE --}}
                    <x-inputs.text-field-row name="start_date" label="Fecha de inicio"
                        placeholder="Ingresa la fecha de inicio" type="date" :default-value="$project->star_date" />

                    {{-- END DATE --}}
                    <x-inputs.text-field-row name="end_date" label="Fecha de termino"
                        placeholder="Ingresa la fecha de termino" type="date" :default-value="$project->end_date" />

                    {{-- SCHEDULE --}}
                    <x-inputs.text-field-row name="schedule" label="Horario requerdido" placeholder="Ingresa el horario"
                        :default-value="$project->schedule" />

                    {{-- GENERAL OBJECTIVE --}}
                    <x-inputs.text-field-row name="general_objective" label="Objetivo general"
                        placeholder="Ingresa el objetivo general" :default-value="$project->general_objective" />

                    {{-- JUSTIFICATION --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="justification" class="d-block">Justificación</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <textarea class="form-control" name="justification" id="justification"
                                    rows="5">{{ old('justification',$project->justification) }}</textarea>
                            </div>
                            @error('justification')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- ACTIVITY SCHEDULE IMAGE --}}
                    <x-inputs.text-field-row name="activity_schedule_image" label="Imagen del cronograma de actividades"
                        placeholder="Ingresa la imagen" type="file" accept="image/*"  />

                    @if ($project->activity_schedule_image)
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ $project->activity_schedule_image_url }}" alt="" class="image-responsive" style="max-height: 400px">
                        </div>
                    </div>
                    @endif
                    <div class="text-right">
                        <button class="btn btn-success btn-sm"> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
