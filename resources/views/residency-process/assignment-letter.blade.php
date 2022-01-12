<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asignación de Asesot Interno</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
</head>
<style>
        .request-date {
                    text-align: right;
                    margin-top: 0px;
                    padding: 0 3rem;
                }
        .person {
            text-align: left;
            padding: 0 3rem;
            margin-top: 0px;
        }
        .cuenta {
            text-align: left;
            padding: 0 3rem;
            margin-top: 0px;
        }
        .note {
            padding: 0 3rem;
            text-align: justify;
        }
        .subtitle {
            margin-top: 1;
            font-size: 1rem;
        }
        .c {
            text-align: left;
            margin-top: 0px;
            padding: 0 3rem;
            font-size: 0.7rem;
        }
        .table {
            width: 100%;
        }
</style>
<body>
    <div>
        <img src="{{ asset('img/escudo-mexico.jpg') }}" alt="" style="height: 80px;">
        <div style="float: right">
            <img src="{{ asset('img/umb-logo.jpg') }}" alt="" style="height: 50px;">
            <img src="{{ asset('img/edomex.jpg') }}" alt="" style="height: 50px;">
        </div>
    </div>
    
    <h1 class="title">UNIVERSIDAD MEXIQUENSE DEL BICENTENARIO</h1>
    <h2 class="subtitle">DIRECCIÓN ACADÉMICA</h2>
    
    <p class="internal-company-name">Unidad de Estudios Superiores Villa Victoria</p>
    
    <div class="document-name">ASIGNACIÓN  DE ASESOR INTERNO</div>
    <br>
    <p class="request-date"><b>Fecha:{{$assignmentLetter->request_date_formatted}}</b> </p>
    <div class="person"><b>Nombre del (a) Alumno(a): {{ $student->full_name }}</b></div>

    <table border="0" cellspacing="0" cellpadding="0" class="table">
        <tbody>
            <tr>
                <td>  <div class="cuenta"><b>No. de Cuenta: {{ $student->account_number }}  </b></div></td>
                <td>  <div class="cuenta"><b>Carrera: {{ $student->career->name }}  </b></div></td>
            </tr>
        </tbody>
    </table>
    <div class="cuenta"><b>PRESENTE: </b></div>

    <p class="note">
        Por medio del presente le informo que el Profesor <b>{{$student->teacher->full_name}} </b> 
        será su asesor interno en la Residencia Profesional que realizará en  el <b>{{ $externalCompany->business_name }}</b> , 
        con el proyecto titulado  <b>{{ $student->project->title}}</b>.
    </p>
    <p class="note">
        El avance del proyecto se revisará cada semana por parte del asesor interno,
        el cual emitirá una calificación. Dicha evaluación se registrará en el acta correspondiente que será proporcionada
        por el Departamento de Control Escolar.
    <br> <br>
    Sin otro asunto en particular, quedo de usted para cualquier aclaración, esperando contar con su valiosa participación y entrega puntual.
    </p>
    <br><br><br><br><br>
    <p class="subtitle"> <b>ATENTAMENTE</b> </p>
    <br>
    <div class="subtitle">
        <p> <b>
                _________________________________
                <br>
                LCDA. BRENDA GONZALEZ PACHECO
                <br>
                COORDINADORA DE LA UNIDAD DE ESTUDIOS
                <br>
                SUPERIORES VILLA VICTORIA
        </p>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="c"> C.c.p. <b>{{$student->teacher->full_name}} </b> .- Para su conocimiento. </div>
    <div class="c"> Expediente/Minutario</b> </div>
</body>
</html>