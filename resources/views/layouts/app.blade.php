<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
        <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
        <title>SIDER</title>
        <!-- Favicons-->
        <link rel="icon" href="{{ asset('sider/images/favicon/favicon-32x32.png') }} " sizes="32x32">

        <!-- Favicons-->
        <link rel="apple-touch-icon-precomposed" href="{{ asset('sider/images/favicon/apple-touch-icon-152x152.png') }} ">
        <!-- For iPhone -->
        <meta name="msapplication-TileColor" content="#00bcd4">
        <meta name="msapplication-TileImage" content="{{ asset('sider/images/favicon/mstile-144x144.png') }}
              ">
        <!-- For Windows Phone -->
        <!-- CORE CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('sider/css/themes/semi-dark-menu/materialize.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('sider/css/themes/semi-dark-menu/style.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('sider/css/custom/custom.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('sider/css/layouts/page-center.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('sider/vendors/perfect-scrollbar/perfect-scrollbar.css') }}" />

    </head>
    <body class="">
        @yield('content')

        <!-- ================================================
        Scripts
        ================================================ -->
        <!-- jQuery Library -->
        <script type="text/javascript" src="{{ asset('sider/vendors/jquery-3.2.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('sider/js/materialize.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('sider/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('sider/js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ asset('sider/js/custom-script.js') }}"></script>
        <script type="text/javascript" src="{{url('')}}/js/jquery/jquery.validate.js"></script>
        <!--<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>-->

        
        <script type="text/javascript" src="{{url('')}}/js/functions.js"></script>
        <script>
    $(document).ready(function () {

        $("#user-login-form").validate({
            rules: {
                email: {
                    required: true
                },
                password: {
                    required: true,
                    //minlength: 8
                }
            },
            messages: {
                email: {
                    required: 'Este campo es requerido.'
                },
                password: {
                    required: 'Este campo es requerido.',
                    minlength: 'Introduzca al menos 8 caracteres.'
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error);
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
    function SoloNumeros(e)
    {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toString();
        letras = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        especiales = [8, 37, 39, 46, 6];
        tecla_especial = false
        for(var i in especiales)
        {
            if(key == especiales[i])
            {
                tecla_especial = true;
                break;
            }
        }
        if(letras.indexOf(tecla) == -1 && !tecla_especial)
        {
            console.log('Tecla no aceptada',letras.indexOf(tecla),tecla);
            return false;
        }
    }
        </script>
    </body>
</html>
