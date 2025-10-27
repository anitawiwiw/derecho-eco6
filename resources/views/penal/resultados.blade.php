 <!-- si tenés layout principal -->
@section('content')

<div class="busqueda">
    <form action="{{ route('penal.buscar') }}" method="GET">
        <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Buscar artículos..." required>
        <button type="submit">Buscar</button>
    </form>
</div>

<h2>Resultados para: "{{ $query }}"</h2>

@if($resultados->isEmpty())
    <p>No se encontraron temas relacionados.</p>
@else
    <div class="tarjetas">
        @foreach($resultados as $tema)
            <div class="tarjeta">
                <h3>{{ $tema->titulo }}</h3>
                <p>{{ Str::limit($tema->contenido, 150, '...') }}</p>
                <a href="{{ route('penal.ver', $tema->id) }}" class="btn-ver-mas">Ver más</a>
            
@section('content')

<div class="busqueda">
    <form action="{{ route('penal.buscar') }}" method="GET">
        <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Buscar temas..." required>
        <button type="submit">Buscar</button>
    </form>
</div>

<h2>Resultados para: "{{ $query }}"</h2>

@if($resultados->isEmpty())
    <p>No se encontraron temas relacionados.</p>
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
.busqueda {
    margin-bottom: 1rem;
}
.busqueda input[type="text"] {
    width: 70%;
    padding: 0.5rem;
    border-radius: 4px;
    border: 1px solid #ccc;
}
.busqueda button {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    border: none;
    background-color: #4a919e;
    color: white;
    cursor: pointer;
}
.tarjetas {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 1rem;
}
.tarjeta {
    border: 1px solid #ccc;
    padding: 1rem;
    width: 300px;
    border-radius: 5px;
    transition: box-shadow 0.2s;
}
.tarjeta:hover {
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
}
.tarjeta h3 {
    margin-top: 0;
}
.btn-ver-mas {
    display: inline-block;
    margin-top: 0.5rem;
    text-decoration: none;
    color: white;
    background-color: #343a40;
    padding: 0.3rem 0.7rem;
    border-radius: 3px;
}
.btn-ver-mas:hover {
    background-color: #4a919e;
}
</style>

@endsection

            </div>
        @endforeach
    </div>
@endif


<style>
.busqueda {
    margin-bottom: 1rem;
}
.busqueda input[type="text"] {
    width: 70%;
    padding: 0.5rem;
    border-radius: 4px;
    border: 1px solid #ccc;
}
.busqueda button {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    border: none;
    background-color: #4a919e;
    color: white;
    cursor: pointer;
}
.tarjetas {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 1rem;
}
.tarjeta {
    border: 1px solid #ccc;
    padding: 1rem;
    width: 300px;
    border-radius: 5px;
    transition: box-shadow 0.2s;
}
.tarjeta:hover {
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
}
.tarjeta h3 {
    margin-top: 0;
}
.btn-ver-mas {
    display: inline-block;
    margin-top: 0.5rem;
    text-decoration: none;
    color: white;
    background-color: #343a40;
    padding: 0.3rem 0.7rem;
    border-radius: 3px;
}
.btn-ver-mas:hover {
    background-color: #4a919e;
}
</style>


