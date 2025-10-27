<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Crear Tema - Admin</title>
<style>
:root {
    --color-primary-light: #5a663aff;  
    --color-accent-gold: #FEC868;     
    --color-accent-burnt: #fda76998;    
    --color-dark-brown: #473C33;      
    --color-text-light: #FDF9F5;
}

* { box-sizing: border-box; margin:0; padding:0; }
body, html { height: 100%; font-family: 'Georgia', serif; color: var(--color-text-light); }

.container {
    display:flex;
    height:100vh;
    width:100%;
}

/* Panel de info lateral */
.info-panel {
    flex:1;
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)),
                url("{{ asset('images/imagenfondo.jpg') }}") center/cover no-repeat;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    padding:40px;
    text-align:center;
    color: var(--color-accent-gold);
}
.info-panel h1 { font-size:2.5rem; margin-bottom:15px; text-shadow:0 2px 10px rgba(0,0,0,0.7);}
.info-panel p { font-size:1.2rem; line-height:1.6; max-width:400px;}

/* Panel del formulario */
.form-panel {
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    background: var(--color-primary-light);
}

.form-box {
    background: rgba(71,60,51,0.95);
    padding: 40px 30px;
    border-radius: 15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.5);
    width: 350px;
    color: var(--color-text-light);
}

.form-box h2 { text-align:center; margin-bottom:25px; color: var(--color-accent-gold);}
.form-box input, .form-box textarea { width:100%; padding:12px; margin-bottom:15px; border:none; border-radius:8px; background: rgba(255,255,255,0.1); color: var(--color-text-light); font-size:1rem; }
.form-box input::placeholder, .form-box textarea::placeholder { color: rgba(255,255,255,0.7);}
.form-box button { width:100%; padding:12px; background: var(--color-accent-gold); color: var(--color-dark-brown); border:none; border-radius:8px; font-size:1.1rem; font-weight:bold; cursor:pointer; transition:all 0.3s ease;}
.form-box button:hover { background: var(--color-accent-burnt); color: var(--color-text-light); }
.error { color:#ff6b6b; text-align:center; margin-bottom:10px; }

/* Responsive */
@media(max-width:900px) {
    .container { flex-direction:column; }
    .info-panel, .form-panel { flex:unset; width:100%; height:50vh;}
    .form-box { width:90%; }
}
</style>
</head>
<body>

<div class="container">

    <div class="info-panel">
        <h1>Crear Nuevo Tema</h1>
        <p><strong>Título:</strong> Claro y conciso sobre el tema.</p>
        <p><strong>Preguntas:</strong> Guías claras para orientar la búsqueda de información.</p>
        <p><strong>Información:</strong> Resumen breve o datos importantes.</p>
    </div>

    <form class="form-box" action="{{ route('admin.temas.update', $tema->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h2>Editar Tema</h2>
    <input type="text" name="titulo" value="{{ $tema->titulo }}" required>
    <textarea name="preguntas" required>{{ $tema->preguntas }}</textarea>
    <textarea name="informacion">{{ $tema->informacion }}</textarea>
    <input type="url" name="link" value="{{ $tema->link }}">
    <input type="file" name="documento">
    <button type="submit">Actualizar Tema</button>
</form>

    </div>

</div>

</body>
</html>

