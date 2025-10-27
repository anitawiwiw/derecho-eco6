<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Derecho Penal - Inicio</title>
<style>
:root {
    --color-primary-light: #5a663aff;   /* Verde Oliva Suave */
    --color-accent-gold: #FEC868;     /* Naranja Dorado */
    --color-accent-burnt: #fda76998;    /* Naranja Quemado */
    --color-dark-brown: #473C33;      /* Marrón Oscuro */
    --color-text-light: #FDF9F5;      /* Texto claro */
}

/* Reset */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html, body {
    height: 100%;
    font-family: 'Georgia', serif;
    color: var(--color-text-light);
    background-color: var(--color-primary-light);
}

/* Header fijo */
header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 60px;
    background-color: var(--color-accent-burnt);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 40px;
    z-index: 1000;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

header .logo img {
    height: 145px;
}

/* Botón de login */
.login-button {
    text-decoration: none;
    font-weight: bold;
    padding: 8px 15px;
    border-radius: 5px;
    background-color: var(---color-primary-light);
    color: var(--color-dark-brown);
    transition: background-color 0.3s ease;
}

.login-button:hover {
    background-color: var(--color-primary-light);
}

/* Contenido principal */
main {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 0 1rem;
    background-image: url("{{ asset('images/imagenfondo.jpg') }}");
    background-size: cover;
    background-position: center;
    background-blend-mode: multiply;
    background-color: rgba(71, 60, 51, 0.4);
}

/* Caja de contenido */
.content-box {
    background-color: rgba(253, 249, 245, 0.63);
    padding: 40px 30px;
    border-radius: 10px;
    max-width: 800px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    color: var(--color-dark-brown);
}

.content-box h1 {
    font-size: clamp(2rem, 4vw, 3.5rem);
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: var(--color-primary-light);
}

.content-box p {
    font-size: clamp(1rem, 1.8vw, 1.3rem);
    font-weight: 500;
    line-height: 1.6;
}

/* Espacio para que header fijo no tape contenido */
body::before {
    content: "";
    display: block;
    height: 60px;
}

/* Responsive */
@media (max-width: 480px) {
    .content-box h1 {
        font-size: 2rem;
    }
    .content-box p {
        font-size: 1rem;
    }
    .login-button {
        padding: 6px 12px;
        font-size: 0.9rem;
    }
}
</style>
</head>
<body>

<header>
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Derecho Penal">
    </div>
    <a href="{{ route('login') }}" class="login-button">Iniciar Sesión</a>
</header>

<main>
    <div class="content-box">
        <h1>Resuelva sus Dudas de Derecho Penal</h1>
        <p>Acceda a información confiable, análisis de casos y orientación legal precisa para comprender y resolver sus inquietudes en el ámbito del Derecho Penal.</p>
    </div>
</main>

</body>
</html>
