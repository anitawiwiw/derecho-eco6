<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Barra Chat Bot</title>
  <style>

    html, body {
      height: 100%;
      margin: 0;
      font-family: system-ui, Helvetica, Arial, sans-serif;
      box-sizing: border-box;
    }
    /* Barra de chat */
    .barra-chat {
      position: fixed;
      top: 0;
      right: 0;
      width: 30%;           /* 30% del ancho de la ventana */
      height: 100vh;         /* ocupa todo el alto de la pantalla */
      background: #fbba6b;   
      display: flex;
      flex-direction: column;
      border-left: 1px solid #d89c53ff;
    }
    .barra-penal{
     position: fixed;
     top: 0;
     left: 0;
     width: 100%;
     height: 8%;
     background: #98aa67;
     color: #fff;
     display: flex;
     align-items: center;
     padding: 0 16px;
     z-index: 1000;z-index: 1000;/*este es para que no se corte el texto*/
    font-weight: 600;
      font-size: 38px;
        color: #4d4138;
        white-space: nowrap;/*este es para que no se corte el texto*/
    }

    /*la flexita con opciones*/
    .menu-toggle {
     cursor: pointer;
      font-size: 24px;
      padding:   44%;
      user-select: none;
}
     .menu-desplegable {

     position: absolute;
      top: 100%; /* justo debajo de la barra */
      left: 60%; /* que se despliegue debajo de la flecha */
       transform: translateX(-50%);
      background: #ffffffff;
      width: 300px ;
      height: 400px;
      border: 0px;
      display: none;
      flex-direction: column;
      z-index: 999;
}
/*para que los botones se distribuyan bien*/
.menu-desplegable button {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    padding: 0;
    font-size: 16px;
    color: white;
    cursor: pointer;
    transition: opacity 0.2s;
    }
    /*colores de los botones*/
    .menu-desplegable button:nth-child(1) {
      background:  #fbba6b;
      border: 3px solid #e9a349ff;
    }
    .menu-desplegable button:nth-child(2) {
      background: #98aa67;;
      border: 3px solid #698846ff;
    }
    .menu-desplegable button:nth-child(3) {
      background: #fda769;
       border: 3px solid #d4864eff;
    }
    .menu-desplegable button:nth-child(4) {
      background: #fbba6b;
      border: 3px solid #e9a349ff;
      
    }
    .menu-desplegable button:nth-child(5) {
      background: #98aa67;;
      border: 3px solid #698846ff;
    }
    .menu-desplegable button:hover {
      opacity: 0.8;
    }
    /*el texto del chat-bot*/
    .barra-chat__header {
       
      text-align: center;
      padding:  8% 30%;
      font-weight: 600;
      font-size: 38px;
        color: #4d4138;
        white-space: nowrap;/*este es para que no se corte el texto*/
    }
    /*sin esto anda re mal*/
    .barra-chat__contenido {
    flex: 1; /* ocupa el espacio intermedio */
    overflow: auto; /* por si hay contenido largo */
    padding: 16px;
   }
   /*sin esto tipo no tiene espacio la barra de preguntas con el fin*/
   .barra-chat__input {
    padding: 7%;
    
    }
    /*el coso donde se escribe en el chat*/
   .barra-chat__input input[type="text"] {
      width: 100%;
      padding: 20px 26px;
      border: 1px solid #d4864eff;
      border-radius: 999px; 
      outline: none;
      background: #fda769;
      font-size: 14px;
    }
    /*para que tenga bien los margenes*/
    .contenido {
     padding: 16px;
     margin-right: 30vw;
     margin-top: 60px;

        }
        /*el contenedor ferde con info*/
 .contenedor-info {
        margin: 5% 10%;
        padding: 2rem;
        min-height: 100vh;
        background: #98aa67;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        color: #fff;
    }

    h1, h2, h3 {
        text-align: center;
        margin: 1rem 0;
    }

    h1 {
        font-size: 32px;
        text-decoration: underline;
    }

    h2 {
        font-size: 28px;
        font-weight: bold;
    }

    h3 {
        font-size: 24px;
        font-weight: bold;
        text-decoration: underline;
    }

    p {
        text-align: justify;
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    ul {
        margin-left: 2rem;
        margin-bottom: 1rem;
    }

    li {
        margin-bottom: 0.5rem;
    }

    .bloque {
        margin-bottom: 3rem;
        width: 100%;
    }

    </style>
</head>
<body>
  <div class="busqueda">
    <form action="{{ route('penal.buscar') }}" method="GET">
        <input type="text" name="q" placeholder="Buscar artículos..." required>
        <button type="submit">Buscar</button>
    </form>
</div>
<main class="contenido">
<div class="contenedor-info">
<p><h2>Definición</h2>
    <p>
      El <span class="highlight">Derecho Penal</span> es la rama del derecho público que establece cuáles son las conductas consideradas delitos y fija las penas o medidas que se aplican a quienes las cometen. 
      Su función principal es proteger a la sociedad y a los bienes jurídicos fundamentales (vida, libertad, propiedad, entre otros) mediante la amenaza y aplicación de sanciones.
    </p>
    <p>
      En Argentina, el Derecho Penal se encuentra regulado principalmente en el <b>Código Penal de la Nación</b> (1921, con múltiples reformas).
    </p>

    <h2>Tipos de Derecho Penal</h2>
    <ul>
      <li><b>Sustantivo:</b> establece los delitos y las penas (contenido del Código Penal).</li>
      <li><b>Adjetivo o procesal:</b> regula cómo se investigan, juzgan y ejecutan las penas.</li>
      <li><b>Común:</b> aplicable a todo el territorio nacional, salvo excepciones.</li>
      <li><b>Especial:</b> normas penales específicas fuera del Código Penal (drogas, lavado de dinero, violencia de género, etc.).</li>
    </ul>

    <h2>Bienes Jurídicos</h2>
    <p>El bien jurídico es el interés o valor protegido por la norma penal. El Derecho Penal argentino protege, entre otros:</p>
    <ul>
      <li>La vida y la integridad física (homicidio, lesiones).</li>
      <li>La libertad (amenazas, privación ilegítima de la libertad, abuso sexual).</li>
      <li>La propiedad (hurto, robo, estafa, usurpación).</li>
      <li>El orden público y la seguridad (asociación ilícita, terrorismo, tráfico de armas).</li>
      <li>La administración pública (cohecho, peculado, malversación).</li>
    </ul>

    <h2>Penas</h2>
    <p>El Código Penal argentino prevé distintas penas:</p>
    <ul>
      <li><b>Prisión o reclusión:</b> privación de la libertad (perpetua o determinada).</li>
      <li><b>Multa:</b> obligación de pagar una suma de dinero.</li>
      <li><b>Inhabilitación:</b> prohibición de ejercer ciertos cargos, profesiones o derechos.</li>
      <li><b>Accesorias:</b> como la pérdida de la patria potestad en ciertos delitos.</li>
    </ul>
    <p>El sistema busca que las penas sean <i>preventivas, retributivas y resocializadoras</i>.</p>

    <h2>Proceso Penal</h2>
    <p>El proceso penal argentino es el conjunto de etapas para investigar y juzgar un delito. Generalmente incluye:</p>
    <ul>
      <li><b>Denuncia o actuación de oficio:</b> inicio de la causa.</li>
      <li><b>Investigación penal preparatoria:</b> a cargo del fiscal con control judicial.</li>
      <li><b>Etapa intermedia:</b> se decide si el caso va a juicio.</li>
      <li><b>Juicio oral y público:</b> el tribunal escucha a las partes y dicta sentencia.</li>
      <li><b>Ejecución de la pena:</b> cumplimiento de la sanción en caso de condena.</li>
    </ul>
    <p>
      Actualmente, el país transita de un sistema <b>inquisitivo</b> a un sistema <b>acusatorio</b>, donde el fiscal tiene más protagonismo y el juez garantiza la legalidad.
    </p>

    <h2>Denuncias</h2>
    <p>La denuncia penal es la comunicación de un hecho delictivo ante una autoridad. En Argentina, puede hacerse:</p>
    <ul>
      <li>Ante la policía.</li>
      <li>En la fiscalía.</li>
      <li>Ante un juzgado penal.</li>
    </ul>
    <p>
      Cualquier persona puede denunciar un delito, incluso si no fue víctima directa. 
      En algunos casos, la denuncia es obligatoria (ejemplo: para funcionarios públicos que toman conocimiento de un delito en ejercicio de sus funciones).
    </p></p>
</div>
</main>
<body>
  <div class="busqueda">
    <form action="{{ route('penal.buscar') }}" method="GET">
        <input type="text" name="q" placeholder="Buscar artículos..." required>
        <button type="submit">Buscar</button>
    </form>
<aside class="barra-penal">
<div class="barra-penal-texto">Derecho Penal</div>
<div class="menu-toggle">⮟</div>
    <span></span>
    <div class="menu-desplegable" id="menu">
<button onclick="window.location.href='{{ route('conceptos') }}'">
    Conceptos Fundamentales
</button>
<button onclick="window.location.href='{{ route('clasificacion') }}'">
     El Código Penal y los Tipos de Delitos
</button>
<button onclick="window.location.href='{{ route('proceso') }}'">
     El Proceso Penal y las Denuncias
</button>
<button onclick="window.location.href='{{ route('sistema') }}'">
     Críticas y Desafíos del Sistema Penal Argentino
</button>
<button onclick="window.location.href='{{ route('adicional') }}'">
     Clasificaciones Adicionales y Ejemplos de Aplicación
</button>
    </div>
<aside class="barra-chat">
<div class="barra-chat__header">chat-bot</div>


<div class="barra-chat__contenido">
<!-- zona intermedia para mensajes o lo que quieras -->
</div>
<script>
const toggle = document.querySelector('.menu-toggle');
const menu = document.getElementById('menu');


toggle.addEventListener('click', () => {
if (menu.style.display === 'flex') {
menu.style.display = 'none';
} else {
menu.style.display = 'flex';
}
});
</script>

<div class="barra-chat__input">
<input type="text" placeholder="Escribe un mensaje..." />
</div>
</aside>
</body>
</html>