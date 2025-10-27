@section('content')

<div class="busqueda-resultados">
    <form action="{{ route('penal.buscar') }}" method="GET">
        <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Buscar artículos..." required>
        <button type="submit">Buscar</button>
    </form>
</div>

<h2 class="resultados-titulo">Resultados para: "{{ $query }}"</h2>

@if($resultados->isEmpty())
    <p class="no-resultados">No se encontraron temas relacionados con tu búsqueda.</p>
@else
    <div class="tarjetas">
        @foreach($resultados as $tema)
            <div class="tarjeta">
                <h3>{{ $tema->titulo }}</h3>
                <p>{{ Str::limit($tema->contenido, 150, '...') }}</p>
                <a href="{{ route('penal.ver', $tema->id) }}" class="btn-ver-mas">Ver más</a>
            </div>
        @endforeach
    </div>
@endif


<style>
:root {
    --color-primary-light: #5a663a;   /* Verde Oliva Suave */
    --color-accent-gold: #FEC868;     /* Dorado */
    --color-accent-burnt: #fda769;    /* Naranja Quemado */
    --color-primary-darker: #4b5930;  /* Verde Oliva Oscuro */
    --color-dark-brown: #473C33;      /* Marrón Oscuro */
    --color-text-light: #FDF9F5;      /* Texto claro */
}

/* Fondo con difuminado elegante */
body {
    margin: 0;
    background: url("{{ asset('images/imagenfondo.jpg') }}") no-repeat center center fixed;
    background-size: cover;
    position: relative;
}

/* Capa difuminada superpuesta */
body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5); /* oscurece */
    backdrop-filter: blur(10px);     /* difuminado elegante */
    z-index: -1;                     /* detrás del contenido */
}

/* Buscador principal */
.busqueda-resultados {
    display: flex;
    justify-content: center;
    padding: 1.5rem;
    background: rgba(90, 102, 58, 0.85);
    border-radius: 12px;
    margin: 2rem auto 2.5rem;
    border: 1px solid var(--color-primary-darker);
    width: 90%;
    max-width: 700px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

.busqueda-resultados form {
    display: flex;
    width: 100%;
}

.busqueda-resultados input[type="text"] {
    flex: 1;
    padding: 12px 18px;
    border: none;
    border-radius: 8px 0 0 8px;
    font-size: 1rem;
    outline: none;
    background: rgba(255,255,255,0.15);
    color: var(--color-text-light);
    font-family: 'Georgia', serif;
}
.busqueda-resultados input[type="text"]::placeholder {
    color: rgba(255,255,255,0.7);
}

.busqueda-resultados button {
    padding: 12px 20px;
    border: none;
    background: var(--color-accent-gold);
    color: var(--color-dark-brown);
    font-weight: bold;
    cursor: pointer;
    border-radius: 0 8px 8px 0;
    transition: all 0.3s ease;
}
.busqueda-resultados button:hover {
    background: var(--color-accent-burnt);
    color: var(--color-text-light);
}

/* Título de resultados */
.resultados-titulo {
    color: var(--color-text-light);
    text-align: center;
    font-size: 2rem;
    margin-bottom: 2rem;
    font-family: 'Georgia', serif;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
}

/* Mensaje si no hay resultados */
.no-resultados {
    color: var(--color-text-light);
    text-align: center;
    font-size: 1.2rem;
    padding: 2rem;
    background: rgba(90, 102, 58, 0.8);
    border-radius: 10px;
    border: 1px solid var(--color-primary-darker);
    width: 80%;
    margin: 0 auto;
}

/* Contenedor de tarjetas */
.tarjetas {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: center;
    padding-bottom: 2rem;
}

/* Tarjeta individual */
.tarjeta {
    width: 300px;
    background: rgba(90, 102, 58, 0.9);
    color: var(--color-text-light);
    border: 1px solid var(--color-primary-darker);
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    border-left: 5px solid var(--color-accent-gold);
    box-shadow: 0 4px 10px rgba(0,0,0,0.25);
}

.tarjeta:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.35);
}

.tarjeta h3 {
    color: var(--color-accent-gold);
    margin-bottom: 1rem;
    font-size: 1.4rem;
    border-bottom: 1px solid var(--color-primary-darker);
    padding-bottom: 0.4rem;
}

.tarjeta p {
    font-size: 1rem;
    line-height: 1.6;
    flex-grow: 1;
}

/* Botón elegante */
.btn-ver-mas {
    align-self: flex-start;
    background: var(--color-accent-gold);
    color: var(--color-dark-brown);
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    margin-top: 1rem;
    transition: all 0.3s ease;
}
.btn-ver-mas:hover {
    background: var(--color-accent-burnt);
    color: var(--color-text-light);
}

/* Responsive */
@media (max-width: 700px) {
    .tarjetas {
        flex-direction: column;
        align-items: center;
    }
    .tarjeta {
        width: 90%;
    }
}
</style>

