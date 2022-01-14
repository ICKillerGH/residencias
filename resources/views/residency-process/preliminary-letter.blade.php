<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anteproyecto</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">

    <style>

        .info{
            text-align: center;
            margin-bottom: 5px;
            }

        .table {
            width: 100%;
            margin-bottom: 30px;
        }

    </style>
</head>
<body>
    <br>
   
    @include('residency-process.partials.header', ['title' => 'ANTEPROYECTO DE RESIDENCIAS PROFESIONALES'])

    <br>
    <br>

    <div class="info"> <b> DATOS DEL ALUMNO </b></div>
    
    <table border="1" cellspacing="2" cellpadding="0" class="table">
        <tbody>
            <tr>
                <td width="12%" height="4%">Nombre:</td>
                <td colspan="3"> {{ $student->first_name }} {{ $student->fathers_last_name }} {{ $student->mothers_last_name }}</td>
            </tr>
            <tr>
                <td height="4%">Carrera:</td>
                <td> {{ $student->career->name }}</td>
                <td width="13%">No. Cuenta</td>
                <td width="20%"> {{ $student->account_number }}</td>
            </tr>
        </tbody>
    </table>

    <div class="info"> <b> DATOS DE LA EMPRESA O INSTITUCIÓN </b></div>

    <table border="1" cellspacing="2" cellpadding="0" class="table">
            <tr>
                <td width="17%" height="4%">Razón Social:</td>
                <td colspan="5">{{ $externalCompany->business_name }}</td>
            </tr>

            <tr>
                <td  height="4%">Giro Comercial:</td>
                <td colspan="5">{{ $externalCompany->commercial_business }}</td>
            </tr>

            <tr>
                <td height="8%" >Domicilio:</td>
                <td colspan="3">{{ $externalCompany->address_name }}</td>
                <td width="10%" >C.P:</td>
                <td>{{ $externalCompany->zip_code}}</td>
            </tr>

            <tr>
                <td  width="17%" height="4%" colspan="2">Departamento solicitante del proyecto</td>
                <td width="60%"  colspan="4">Coordinación de Unidad</td>
            </tr>

            <tr>
                <td  width="17%" height="4%" colspan="2">Nombre y cargo del responsable directo del Departamento:</td>
                <td width="60%" colspan="4">{{ $externalCompany->person_in_charge }} , {{ $externalCompany->person_in_charge_position}}</td>
            </tr>

            <tr>
                <td height="4%">Teléfono:</td>
                <td>{{ $externalCompany->office_phone_number }}</td>
                <td width="10%">Ext.:</td>
                <td> </td>
                <td>E-mail:</td>
                <td>{{ $externalCompany->email}}</td>
            </tr>
        
    </table>
    
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@include('residency-process.partials.header', ['title' => ''])
<div class="info"> <b> 	DATOS DEL PROYECTO </b></div>
<table border="1" cellspacing="2" cellpadding="0" class="table">
    <tr>
        <td width="20%" height="8%">Titulo del proyecto:</td>
        <td colspan="3">{{ $project->title }}</td>
    </tr>
    <tr>
        <td height="11%">Objetivo General:</td>
        <td colspan="3">{{ $project->general_objective }}</td>
    </tr>
    <tr>
        <td height="17%">Objetivos Específicos:</td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td height="35%">Justificación del proyecto:</td>
        <td colspan="3">{{ $project->justification }}</td>
    </tr>

</table>

@include('residency-process.partials.header', ['title' => ''])
<table border="1" cellspacing="2" cellpadding="0" class="table">
    <tr>
        <td height="8%">Horario requerido de trabajo:</td>
        <td colspan="3">{{ $project->schedule }}</td>
    </tr>
    <tr>
        <td height="4%">Fecha de Inicio:</td>
        <td>{{ $project->start_date }}</td>
        <td width="20%">Fecha de término:</td>
        <td>{{ $project->end_date }}</td>
    </tr>
    <tr>
        <td height="4%">Nombre del Asesor Interno:</td>
        <td colspan="3">{{ $student->teacher->full_name }}</td>
    </tr>
    <tr>
        <td height="4%">Nombre del Asesor Externo:</td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td height="45%" colspan="4" align="center">
            <div>Anexar: Cronograma de Actividades</div>
            <br>
            <img src="{{ asset($project->activity_schedule_image_url) }}" alt="" style="height: 450px">
        </td>
        
    </tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" style="width: 100%; text-align:center;">
    <tr>
        <td width="33.3333%">
            _______________________
            <br>
            Alumno
        </td>
        <td width="33.3333%">
            _______________________
            <br>
            Asesor interno
        </td>
        <td width="33.3333%">
            _______________________
            <br>
            Asesor externo
        </td>
    </tr>
</table>
   
</body>
</html>