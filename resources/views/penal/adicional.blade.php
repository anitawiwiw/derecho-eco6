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
      padding:   1%;
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
<main class="contenido">
<div class="contenedor-info">

    <h2>Derecho Penal en Argentina</h2>
    <p>Rama del derecho público que establece cuáles conductas son delitos y las penas. Protege sociedad y bienes jurídicos (vida, libertad, propiedad). Regulación principal: Código Penal 1921, con reformas.</p>

    <h2>Tipos de Derecho Penal</h2>
    <ul>
        <li>Derecho Penal sustantivo: establece delitos y penas.</li>
        <li>Derecho Penal adjetivo/procesal: regula investigación, juicio y ejecución de penas.</li>
        <li>Derecho Penal común: aplicable a todo el país.</li>
        <li>Derecho Penal especial: normas fuera del Código Penal (drogas, lavado, violencia de género).</li>
    </ul>

    <h2>Bienes Jurídicos</h2>
    <ul>
        <li>Vida e integridad física: homicidio, lesiones.</li>
        <li>Libertad: amenazas, privación ilegítima, abuso sexual.</li>
        <li>Propiedad: hurto, robo, estafa.</li>
        <li>Orden público y seguridad: asociación ilícita, terrorismo.</li>
        <li>Administración pública: cohecho, peculado, malversación.</li>
    </ul>

    <h2>Penas</h2>
    <ul>
        <li>Prisión o reclusión: perpetua o determinada.</li>
        <li>Multa: obligación de pagar dinero.</li>
        <li>Inhabilitación: prohibición de ejercer cargos o profesiones.</li>
        <li>Accesorias: por ejemplo, pérdida de patria potestad.</li>
    </ul>

    <h2>Ejemplo de aplicación</h2>
    <p>Robo de bicicleta: el Estado investiga y aplica sanción. Protege el derecho a la propiedad.</p>

    <h2>Principios fundamentales</h2>
    <ul>
        <li>Legalidad: no se puede castigar algo no prohibido por ley.</li>
        <li>Irretroactividad: cambios legales pueden beneficiar al preso.</li>
        <li>Presunción de inocencia: nadie es culpable hasta sentencia firme.</li>
    </ul>

    <h2>Código Penal Argentino</h2>
    <p>Ejemplo artículo 79: "Se aplicará reclusión o prisión de ocho a veinticinco años, al que matare a otro." Diferencia homicidio simple y agravado.</p>
</div>
</main>

<aside class="barra-penal">
<div class="barra-penal-texto">Clasificaciones Adicionales y Ejemplos de Aplicación</div>
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