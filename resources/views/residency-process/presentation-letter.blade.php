<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
    
    .request-date {
            text-align: right;
            margin-top: 0px;
            padding: 0 1rem;
        }
    .person {
            text-align: left;
            margin-top: 0px;
        }
    .note {
            padding: 0 1rem;
           
            text-align: justify;
        }
    .subtitle {
            margin-top: 1;
            font-size: 1rem;
        }
     .c{
            text-align: left;
            margin-top: 0px;
            padding: 0 1rem;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
@include('residency-process.partials.header', ['title' => 'CARTA PRESENTACIÓN'])
<p class="request-date"><b>No. RPA/ {{ $student->career->abreviation }}/{{str_pad($student->user_id, 4,'0',STR_PAD_LEFT) }}/{{ date('Y') }}</b> </p>
<p class="request-date"><b>Fecha de solicitud:{{$presentationLetter->request_date_formatted}} </b> </p>
<p class="person"><b> </b> </p>
<p class="note">
Por medio de la presente, me permito enviarle un cordial saludo y presentar a usted al (la) C. {{$student->full_name}}
con número de cuenta {{$student->account_number}}, alumno(a) de nuestra casa de estudios e inscrito(a) en la carrera de {{$student->career->name}}, quien desea realizar su Residencia Profesional en la institución a su digno cargo, con un proyecto
perfectamente definido, viable y dentro del área de especialidad afín a su carrera, debiendo cubrir un total de 640 hrs.
durante un período mínimo de cuatro meses y máximo de seis. 
<br>
<br>
En este sentido, el proyecto se realizará a distancia en atención a las políticas de salud emitidas por las instancias federal y
estatal con motivo de la pandemia causada por el coronavirus SARS-COV2 (enfermedad denominada como COVID 19).
Por lo tanto, el C.  {{$student->full_name}} no asistirá en ningún momento, ni bajo cualquier circunstancia, a las
instalaciones de la institución que usted representa.
<br>
<br>
En espera de su amable respuesta, agradezco de antemano su fina atención a la presente; sabedor de su gran apoyo e
impulso a la juventud en pro del desarrollo de nuestro país.
</p>
<br>
<br>
<p class="subtitle"> <b>ATENTAMENTE</b> </p>
<br>
    <div class="subtitle">
        <p > <b>
            LCDA. Brenda González Pacheco
            <br>
            COORDINADORA DE LA UNIDAD DE ESTUDIOS        
            
            <br>
            SUPERIORES VILLA VICTORIA
        </b>
        </p>
    </div>
    <br>
    <br>
    <br>
    <b>
    <div class="c"> C.c.p. Estudiante.</b> </div>
    <div class="c"> C.c.p. Archivo</b> </div>
    </b>

</body>
</html>