
@section('content')
<div class="tema-fondo">
    <div class="tema-overlay">
        <div class="tema-contenedor">
            <h1 class="tema-titulo">{{ $tema->titulo }}</h1>

            <!-- Información completa -->
            @if($tema->informacion)
                <div class="contenido-tema">
                    <h3>Información</h3>
                    <p>{!! nl2br(e($tema->informacion)) !!}</p>
                </div>
            @endif

            <!-- Preguntas relacionadas -->
            @if($tema->preguntas)
                <div class="preguntas-relacionadas">
                    <h3>Preguntas relacionadas</h3>
                    <ul>
                        @foreach(explode("\n", $tema->preguntas) as $pregunta)
                            <li>{{ $pregunta }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Link relacionado -->
            @if($tema->link)
                <div class="tema-link">
                    <h3>Link relacionado</h3>
                    <a href="{{ $tema->link }}" target="_blank">{{ $tema->link }}</a>
                </div>
            @endif

            <!-- Documento -->
            @if($tema->documento)
                <div class="tema-documento">
                    <h3>Documento</h3>
                    <a href="{{ asset('storage/'.$tema->documento) }}" target="_blank">Ver documento</a>
                </div>
            @endif

            <a href="{{ route('penal.index') }}" class="btn-volver">← Volver a temas</a>
        </div>
    </div>
</div>

<style>
:root {
    --color-primary-light: #5a663a;   /* Verde Oliva Suave */
    --color-accent-gold: #FEC868;     /* Dorado */
    --color-accent-burnt: #fda769;    /* Naranja Quemado */
    --color-primary-darker: #4b5930;  /* Verde Oliva Oscuro */
    --color-dark-brown: #473C33;      /* Marrón Oscuro */
    --color-text-light: #FDF9F5;      /* Beige Claro */
}

/* Fondo general fijo y difuminado */
.tema-fondo {
    background: url('{{ asset('images/imagenfondo.jpg') }}') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    overflow-y: auto;
}

/* Capa de desenfoque y tono cálido */
.tema-overlay {
    backdrop-filter: blur(10px);
    background-color: rgba(71, 60, 51, 0.5); /* Marrón oscuro translúcido */
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 4rem 1rem;
}

/* Tarjeta principal */
.tema-contenedor {
    background: rgba(253, 249, 245, 0.9);
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    width: 90%;
    max-width: 1100px;
    padding: 3rem;
    color: var(--color-dark-brown);
    animation: fadeIn 0.7s ease;
}

/* Título */
.tema-titulo {
    font-size: 2.6rem;
    text-align: center;
    color: var(--color-primary-darker);
    font-weight: 700;
    margin-bottom: 2rem;
}

/* Secciones internas */
.contenido-tema, .preguntas-relacionadas, .tema-link, .tema-documento {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(75, 89, 48, 0.2);
}

h3 {
    color: var(--color-primary-light);
    font-weight: 600;
    margin-bottom: 0.8rem;
}

p, li {
    font-size: 1.1rem;
    line-height: 1.7;
    color: var(--color-dark-brown);
}

/* Listas */
.preguntas-relacionadas ul {
    list-style: disc;
    margin-left: 2rem;
}

/* Enlaces */
a {
    color: var(--color-accent-burnt);
    text-decoration: none;
    font-weight: 500;
}
a:hover {
    color: var(--color-accent-gold);
    text-decoration: underline;
}

/* Botón volver */
.btn-volver {
    display: inline-block;
    background: linear-gradient(135deg, var(--color-primary-darker), var(--color-primary-light));
    color: var(--color-text-light);
    padding: 0.9rem 1.8rem;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}
.btn-volver:hover {
    background: linear-gradient(135deg, var(--color-accent-burnt), var(--color-accent-gold));
    color: var(--color-dark-brown);
    transform: scale(1.03);
}

/* Animación */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
