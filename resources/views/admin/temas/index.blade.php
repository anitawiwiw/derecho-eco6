<!-- resources/views/admin/temas/index.blade.php -->
<!-- resources/views/admin/temas/index.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel Admin - Derecho Penal</title>
<style>
:root {
    --color-primary-light: #5a663aff;  /* Verde Oliva Suave */
    --color-accent-gold: #FEC868;      /* Naranja Dorado */
    --color-accent-burnt: #fda76998;   /* Naranja Quemado */
    --color-dark-brown: #473C33;       /* Marrón Oscuro */
    --color-text-light: #FDF9F5;
}

/* Reset y body */
* { box-sizing: border-box; margin:0; padding:0; }
body {
    font-family: 'Georgia', serif;
    background-color: var(--color-primary-light);
    color: var(--color-dark-brown);
    min-height: 100vh;
}

/* Header superior */
header {
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height: 60px;
    background-color: var(--color-accent-burnt);
    display:flex;
    align-items:center;
    justify-content: space-between;
    padding: 0 40px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    z-index: 1000;
}

header .logo img {
    height: 145px;
}

header nav a {
    color: var(--color-dark-brown);
    font-weight: bold;
    text-decoration: none;
    margin-left: 20px;
    padding: 6px 12px;
    border-radius: 5px;
    background-color: var(--color-accent-gold);
    transition: background 0.3s;
}
header nav a:hover {
    background-color: var(--color-accent-burnt);
}

/* Main contenido */
main {
    margin-top: 80px;
    padding: 20px 40px;
}

/* Bienvenida */
.welcome {
    text-align: center;
    margin-bottom: 30px;
}
.welcome h1 {
    font-size: clamp(2rem, 4vw, 3rem);
    color: var(--color-accent-gold);
    margin-bottom: 10px;
}
.welcome p {
    font-size: 1.2rem;
    opacity: 0.85;
}

/* Tabla de temas */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
th, td {
    padding: 12px;
    border-bottom: 1px solid #ccc;
    text-align: left;
}
th {
    background-color: var(--color-accent-gold);
    color: var(--color-dark-brown);
}
td a.button {
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    color: var(--color-dark-brown);
    transition: 0.3s;
}
td a.edit { background-color: var(--color-accent-burnt); }
td a.edit:hover { background-color: var(--color-accent-gold); }
td a.delete { background-color: #d9534f; color:white; }
td a.delete:hover { background-color: #c9302c; }

/* Botón crear tema */
.create-btn {
    display:inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    background-color: var(--color-accent-gold);
    color: var(--color-dark-brown);
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    transition: 0.3s;
}
.create-btn:hover {
    background-color: var(--color-accent-burnt);
    color: var(--color-text-light);
}

/* Imagenes decorativas */
.decor-left, .decor-right {
    position: absolute;
   
    width: 90px;
    opacity: 1;
}
.decor-left { left: 20px;  opacity: 0.7; top: 100px;}

.decor-right { right: 20px;  top: 120px;}

/* Responsive */
@media(max-width:768px){
    header { flex-direction: column; height:auto; padding: 10px 20px; }
    .decor-left, .decor-right { display:none; }
}
</style>
</head>
<body>

<header>
    <div class="logo"><img src="{{ asset('images/logo.png') }}" alt="Logo Derecho Penal"></div>
    <nav>

        <a href="{{ url('/logout') }}">Cerrar Sesión</a>
    </nav>
</header>

<main>
    <div class="welcome">
        <h1>Bienvenido al Panel de Administración</h1>
        <p>Gestiona temas, preguntas, información y documentos de Derecho Penal con elegancia y eficiencia.</p>
    </div>

    <a href="{{ route('admin.temas.create') }}" class="create-btn">+ Crear Nuevo Tema</a>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Preguntas</th>
                <th>Info</th>
                <th>Link</th>
                <th>Documento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($temas as $tema)
            <tr>
                <td>{{ $tema->titulo }}</td>
                <td>{{ $tema->preguntas }}</td>
                <td>{{ $tema->informacion }}</td>
                <td>
                    @if($tema->link)
                        <a href="{{ $tema->link }}" target="_blank">Ver link</a>
                    @endif
                </td>
                <td>
                    @if($tema->documento)
                        <a href="{{ asset('storage/'.$tema->documento) }}" target="_blank">Ver documento</a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.temas.edit', $tema->id) }}">Editar</a>
                    <form action="{{ route('admin.temas.destroy', $tema->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este tema?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Imágenes decorativas -->
    <img src="{{ asset('images/scales-left.png') }}" class="decor-left" alt="Decoración">
    <img src="{{ asset('images/scales-right.png') }}" class="decor-right" alt="Decoración">
</main>

</body>
</html>