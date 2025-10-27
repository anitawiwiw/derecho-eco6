<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Derecho Penal</title>
<style>
:root {
    --color-primary-light: #5a663aff;    /* Verde Oliva Suave */
    --color-accent-gold: #FEC868;        /* Naranja Dorado */
    --color-accent-burnt: #fda76998;     /* Naranja Quemado semitransparente */
    --color-dark-brown: #473C33;         /* Marrón Oscuro */
    --color-text-light: #FDF9F5;         /* Texto claro */
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body, html {
    height: 100%;
    font-family: 'Georgia', serif;
    color: var(--color-text-light);
}

/* Contenedor principal */
.container {
    display: flex;
    height: 100vh;
    width: 100%;
    background: var(--color-dark-brown);
}

/* Lado izquierdo: imagen/información */
.info-panel {
    flex: 1;
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)),
                url("{{ asset('images/imagenfondo.jpg') }}") center/cover no-repeat;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 40px;
    color: var(--color-accent-gold);
    text-align: center;
}

.info-panel h1 {
    font-size: 2.5rem;
    margin-bottom: 15px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.7);
}

.info-panel p {
    font-size: 1.2rem;
    line-height: 1.6;
    max-width: 400px;
}

/* Lado derecho: formulario */
.login-panel {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    background: var(--color-primary-light);
}

.login-form {
    background: rgba(71, 60, 51, 0.95);
    padding: 40px 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    width: 300px;
    color: var(--color-text-light);
}

.login-form h2 {
    text-align: center;
    margin-bottom: 25px;
    color: var(--color-accent-gold);
}

.login-form input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: none;
    border-radius: 8px;
    background: rgba(255,255,255,0.1);
    color: var(--color-text-light);
    font-size: 1rem;
}

.login-form input::placeholder {
    color: rgba(255,255,255,0.7);
}

.login-form button {
    width: 100%;
    padding: 12px;
    background: var(--color-accent-gold);
    color: var(--color-dark-brown);
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

.login-form button:hover {
    background: var(--color-accent-burnt);
    color: var(--color-text-light);
}

.error {
    color: #ff6b6b;
    text-align: center;
    margin-bottom: 10px;
}

/* Responsive */
@media (max-width: 900px) {
    .container {
        flex-direction: column;
    }
    .info-panel, .login-panel {
        flex: unset;
        width: 100%;
        height: 50vh;
    }
    .login-form {
        width: 90%;
    }
}
</style>
</head>
<body>

<div class="container">

    <div class="info-panel">
        <h1>Derecho Penal</h1>
        <p>Acceda a información confiable y análisis de casos para resolver sus dudas legales con claridad y seguridad.</p>
    </div>

    <div class="login-panel">
        <form class="login-form" method="POST" action="{{ url('/login') }}">
            @csrf
            <h2>Iniciar Sesión</h2>

            @if(session('error'))
                <p class="error">{{ session('error') }}</p>
            @endif

            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
    </div>

</div>

</body>
</html>
