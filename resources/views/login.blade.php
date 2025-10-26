<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Derecho Penal</title>
    <style>
        body {
            background: #121212;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        form {
            background: #1e1e1e;
            padding: 25px;
            border-radius: 10px;
            width: 280px;
        }
        input, button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border: none;
            border-radius: 6px;
        }
        button { background: #007bff; color: white; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: #ff6b6b; text-align: center; }
    </style>
</head>
<body>
    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <h2>Iniciar sesión</h2>

        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <input type="email" name="email" placeholder="Correo" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
