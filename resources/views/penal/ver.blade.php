
@section('content')

<div class="tema-completo">
    <h1>{{ $tema->titulo }}</h1>

    <div class="contenido-tema">
        {!! nl2br(e($tema->contenido)) !!}
    </div>

    @if($tema->preguntas)
        <h3>Preguntas relacionadas:</h3>
        <ul>
            @foreach(explode("\n", $tema->preguntas) as $pregunta)
                <li>{{ $pregunta }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('penal.index') }}" class="btn-volver">← Volver a temas</a>
</div>

<style>
.tema-completo {
    max-width: 800px;
    margin: 1rem auto;
    padding: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.contenido-tema {
    margin: 1rem 0;
    line-height: 1.6;
}
.btn-volver {
    display: inline-block;
    margin-top: 1rem;
    text-decoration: none;
    color: white;
    background-color: #343a40;
    padding: 0.5rem 1rem;
    border-radius: 4px;
}
.btn-volver:hover {
    background-color: #4a919e;
}
</style>



