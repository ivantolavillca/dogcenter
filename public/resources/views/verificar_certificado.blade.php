<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verificar Certificado</title>
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/dashboard/assets/images/logo_idiomas.png') }}">

        <link href="{{ asset('assets/dashboard/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/dashboard/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/dashboard/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/dashboard/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App Css-->
        <link href="{{ asset('assets/dashboard/assets/css/app.min.css') }}" id="app-style"  rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/dashboard/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"  rel="stylesheet" type="text/css" />
        
    	
        @livewireStyles
        
        <style>
    :root {
        --tamanio-borde: 1px;
    }
    .certificado-contenedor {
        position: relative;
        width: calc(220px + var(--tamanio-borde) * 2);
        height: calc(280px + var(--tamanio-borde) * 2);
        box-sizing:border-box;
        border: solid black var(--tamanio-borde);
        user-select: none;

        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 4px;

        transform: scale(1);
    }
    .certificado-contenedor > img {
        display: block;
        width: 100%;
    }

    .certificado-contenedor span {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        padding: 0 1px;
        text-align: center;
        color: #000;
        background: rgba(0, 139, 139, 0);
    }

    .certificado-contenedor.formato1 .codigo,
    .certificado-contenedor.formato3 .codigo,
    .certificado-contenedor.formato4 .codigo {
        top: 54.5px;
        left: 174px;
        width: 32px;
    }
    .certificado-contenedor.formato2 .codigo{
        top: 52px;
        left: 176px;
        width: 32.5px;
    }
    
    .certificado-contenedor.formato1 .ci,
    .certificado-contenedor.formato3 .ci,
    .certificado-contenedor.formato4 .ci {
        top: 95.5px;
        left: 169.5px;
        width: 37.5px;
    }
    .certificado-contenedor.formato2 .ci {
        top: 96.1px;
        left: 173px;
        width: 35.5px;
    } 

    .certificado-contenedor.formato1 .nombre_persona,
    .certificado-contenedor.formato3 .nombre_persona,
    .certificado-contenedor.formato4 .nombre_persona {
        top: 113px;
        left: 38px;
        width: 171.5px;
        font-size: 7px;
    }
    .certificado-contenedor.formato2 .nombre_persona {
        top: 118px;
        left: 38.75px;
        width: 165.25px;
        font-size: 7px;
    }

    .certificado-contenedor.formato1 .idioma,
    .certificado-contenedor.formato3 .idioma,
    .certificado-contenedor.formato4 .idioma {
        top: 136px;
        left: 38px;
        width: 171.5px;
        font-size: 7px;
    }
    .certificado-contenedor.formato2 .idioma {
        top: 141px;
        left: 38.75px;
        width: 165.25px;
        font-size: 7px;
    }

    .certificado-contenedor.formato1 .modalidad,
    .certificado-contenedor.formato3 .modalidad,
    .certificado-contenedor.formato4 .modalidad {
        top: 147.5px;
        left: 79.5px;
        width: 130px;
    }
    .certificado-contenedor.formato2 .modalidad {
        top: 154.75px;
        left: 79.5px;
        width: 124.5px;
    }

    .certificado-contenedor.formato1 .gestion,
    .certificado-contenedor.formato3 .gestion,
    .certificado-contenedor.formato4 .gestion {
        top: 156.5px;
        left: 99px;
        width: 110.5px;
    }
    .certificado-contenedor.formato2 .gestion {
        top: 165.5px;
        left: 99px;
        width: 105px;
    }

    .certificado-contenedor.formato1 .carga-horaria,
    .certificado-contenedor.formato3 .carga-horaria,
    .certificado-contenedor.formato4 .carga-horaria {
        top: 165.5px;
        left: 114px;
        width: 95.5px;
    }

    .certificado-contenedor.formato2 .carga-horaria{
        top: 165.5px;
        left: 157.5px;
        width: 46.5px;
        text-align: left;
        background: rgba(255, 0, 0, 0);
        display: none;
    }
    .certificado-contenedor.formato2 .carga-horaria:before {
        content: 'con ';
    }

    .certificado-contenedor.formato1 .fecha-dia,
    .certificado-contenedor.formato3 .fecha-dia {
        left: 120px;
        width: 10.5px;
    }
    .certificado-contenedor.formato2 .fecha-dia {
        left: 119.75px;
        width: 14.5px;
    }

    .certificado-contenedor.formato1 .fecha-mes,
    .certificado-contenedor.formato3 .fecha-mes,
    .certificado-contenedor.formato4 .fecha-mes {
        left: 136.5px;
        width: 41px;
    }
    .certificado-contenedor.formato2 .fecha-mes {
        left: 140px;
        width: 41.5px;
    }

    .certificado-contenedor.formato1 .fecha-anio,
    .certificado-contenedor.formato3 .fecha-anio,
    .certificado-contenedor.formato4 .fecha-anio {
        left: 189px;
        width: 14px;
        text-align: left;
    }
    .certificado-contenedor.formato2 .fecha-anio {
        left: 192px;
        width: 14.25px;
        text-align: left;
    }

    .certificado-contenedor.formato1 .fecha-dia,
    .certificado-contenedor.formato1 .fecha-mes,
    .certificado-contenedor.formato1 .fecha-anio,
    .certificado-contenedor.formato4 .fecha-dia,
    .certificado-contenedor.formato4 .fecha-mes,
    .certificado-contenedor.formato4 .fecha-anio {
        top: 199.75px; /* 199.25px; */
    }
    .certificado-contenedor.formato2 .fecha-dia,
    .certificado-contenedor.formato2 .fecha-mes,
    .certificado-contenedor.formato2 .fecha-anio {
        top: 196.75px;
    }
    .certificado-contenedor.formato3 .fecha-dia,
    .certificado-contenedor.formato3 .fecha-mes,
    .certificado-contenedor.formato3 .fecha-anio {
        top: 207.75px; /* 207.25px; */
    }

    .certificado-contenedor .qr {
        background: #fff;
        padding: 2px;
    }

    .certificado-contenedor.formato2 .qr,
    .certificado-contenedor.formato1 .qr {
        top: 245px;
        left: 50px;
    }
    .certificado-contenedor.formato3 .qr {
        top: 29.5px;
        left: 178px;
    }

    @media only screen and (min-width: 640px){
        .certificado-contenedor {
            transform: scale(1.25);
            border-color: red;
        }
    }
    @media only screen and (min-width: 768px){
        .certificado-contenedor {
            margin-top: 220px;
            transform: scale(2.5);
            border-color: yellow;
            margin-bottom: 220px;
        }
    }
    @media only screen and (min-width: 1024px){
        .certificado-contenedor {
            margin-top: 440px;
            transform: scale(4);
            border-color: darkred;
            margin-bottom: 450px;
        }
    }
    /* 1280px */
        </style>
	
        <script src="{{ asset('assets/dashboard/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/dashboard/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        
    </head>
    <body>
        @livewire('verificar')
        
        @livewireScripts
    </body>
</html>
