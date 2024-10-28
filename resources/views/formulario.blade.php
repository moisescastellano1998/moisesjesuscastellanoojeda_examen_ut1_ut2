<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* Fuente legible */
            background-color: #f9f9f9; /* Color de fondo suave */
            margin: 0; /* Sin márgenes */
            padding: 20px; /* Espacio alrededor del contenido */
            display: flex;
            justify-content: center; /* Centrar horizontalmente */
            align-items: center; /* Centrar verticalmente */
            height: 100vh; /* Altura completa de la ventana */
        }

        form {
            background: white; /* Fondo blanco para el formulario */
            padding: 20px; /* Espacio interno */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            width: 300px; /* Ancho fijo del formulario */
        }

        label {
            margin-bottom: 10px; /* Espacio debajo de las etiquetas */
            font-weight: bold; /* Negrita para las etiquetas */
        }

        select, textarea {
            width: 100%; /* Ancho completo */
            padding: 10px; /* Espacio interno */
            margin-bottom: 15px; /* Espacio entre elementos */
            border: 1px solid #ccc; /* Borde gris claro */
            border-radius: 4px; /* Bordes redondeados */
            box-sizing: border-box; /* Incluir el padding y border en el tamaño total */
            font-size: 14px; /* Tamaño de fuente */
        }

        .div_errores {
            color: red; /* Color rojo para errores */
            font-size: 12px; /* Tamaño de fuente más pequeño */
            margin-bottom: 10px; /* Espacio debajo de los mensajes de error */
        }

        .div_ok {
            color: green; /* Color verde para mensajes de éxito */
            font-size: 14px; /* Tamaño de fuente */
            margin-bottom: 10px; /* Espacio debajo del mensaje */
        }

        button {
            background-color: #007BFF; /* Color de fondo del botón */
            color: white; /* Color del texto del botón */
            padding: 10px; /* Espacio interno */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cursor de puntero al pasar sobre el botón */
            font-size: 16px; /* Tamaño de fuente */
            transition: background-color 0.3s; /* Transición suave */
            width: 100%; /* Ancho completo del botón */
        }

        button:hover {
            background-color: #0056b3; /* Color más oscuro al pasar el ratón */
        }

        button:active {
            transform: scale(0.95); /* Efecto de clic */
        }

        div {
                background: white; /* Fondo blanco para el contenedor */
                border-radius: 8px; /* Bordes redondeados */
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
                padding: 20px; /* Espacio interno */
                text-align: center; /* Centramos el texto */
                margin: 10px; /* Espacio entre divs */
            }

            a {
                text-decoration: none; /* Sin subrayado en los enlaces */
                color: #007BFF; /* Color azul para los enlaces */
                font-weight: bold; /* Texto en negrita */
                padding: 10px 15px; /* Espaciado alrededor del enlace */
                border: 2px solid transparent; /* Borde inicial transparente */
                border-radius: 5px; /* Bordes redondeados */
                transition: all 0.3s ease; /* Transición suave para efectos */
            }

            a:hover {
                background-color: #007BFF; /* Fondo azul al pasar el ratón */
                color: white; /* Texto blanco al pasar el ratón */
                border-color: #0056b3; /* Borde azul oscuro */
            }

            a:active {
                transform: scale(0.95); /* Efecto de clic */
            }

            input[name="image"] {
                width: 100%; /* Ancho completo */
                padding: 10px; /* Espacio interno */
                margin-bottom: 15px; /* Espacio debajo del input */
                border: 1px solid #ccc; /* Borde gris claro */
                border-radius: 4px; 
                box-sizing: border-box;
                font-size: 14px; 
                transition: border-color 0.3s ease; 
            }

            
            input[name="image"]:focus {
                border-color: #007BFF;
                outline: none;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            }
    </style>
</head>
<body>
    @if (session('ok'))
        <div class='div_ok'>Se han registrado los datos correctamente</div>
    @endif
    @if (isset($message))
        <form action="{{ route('edit.data', $message->id) }}" method="post">
            @method('PUT')
    @else
        <form action="{{ route('manage.data') }}" method="post">
    @endif
            @csrf
            <label for="negrita">¿Quieres el mensaje en negrita?</label>
            <select id="negrita" name="negrita">
                <option value='' selected></option>
                <option value='si' @if (isset($message)) @if ($message->negrita==='si') selected  @endif @endif>Sí</option>
                <option value='no' @if (isset($message)) @if ($message->negrita==='no') selected  @endif @endif>No</option>               
            </select>
            @if ($errors->has('negrita'))
                <div class='div_errores'>{{ $errors->first('negrita') }}</div>
            @endif
            <label for="subrayado">¿Quieres el mensaje subrayado?</label>
            <select id="subrayado" name="subrayado">
                <option value='' selected></option>
                <option value='si' @if (isset($message)) @if ($message->subrayado==='si')selected  @endif  @endif>Sí</option>
                <option value='no' @if (isset($message)) @if ($message->subrayado==='no')selected  @endif  @endif>No</option>               
            </select>
            @if ($errors->has('subrayado'))
                <div class='div_errores'>{{ $errors->first('subrayado') }}</div>
            @endif
            <textarea name="message" rows="4" cols="50">@if ($errors->any()){{ old('message') }} @elseif (isset($message)){{ $message->text }} @endif</textarea>
            @if ($errors->has('message'))
                <div class='div_errores'>{{ $errors->first('message') }}</div>
            @endif
            <button type="submit">Enviar</button>
        </form>

    <div><a href="{{ route ('load.messages') }} ">Ver mensajes</a></div>
</body>
</html>