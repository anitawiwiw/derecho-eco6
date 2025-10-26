<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Derecho Penal - Inicio</title>
    <style>
        /* Estilo general */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        /* Imagen de fondo que cubre toda la pantalla */
        .background {
            background-image: url("{{ asset('images/imagenfondo.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100%;
            position: relative;
        }

        /* Botón “Iniciar sesión” */
        .login-button {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
            background: rgba(0, 0, 0, 0.4);
            padding: 10px 18px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .login-button:hover {
            background: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body>
    <div class="background">
        <a href="{{ route('login') }}" class="login-button">Iniciar sesión</a>
    </div>
</body>
</html>
