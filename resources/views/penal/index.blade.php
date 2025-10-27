<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Barra Chat Bot</title>
  <style>
    :root {
      --color-primary-light: #5a663aff;  /* Verde Oliva Suave */
      --color-accent-gold: #FEC868;      /* Naranja Dorado */
      --color-accent-burnt: #d67936c0;     /* Naranja Quemado (lo hice opaco) */
      --color-accent-burnt-darker: #e9a349ff; /* Borde más oscuro para dorado */
      --color-primary-darker: #698846ff;  /* Borde más oscuro para verde */
      --color-dark-brown: #473C33;      /* Marrón Oscuro */
      --color-text-light: #FDF9F5;      /* Texto claro */
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body,
    html {
      font-family: 'Georgia', serif;
      color: var(--color-text-light);
      background: var(--color-dark-brown);
    }

    /* === Barra de chat (DERECHA) === */
    .barra-chat {
      position: fixed;
      top: 0;
      right: 0;
      width: 30%; /* 30% del ancho de la ventana */
      height: 100vh; /* ocupa todo el alto de la pantalla */
      background: var(--color-accent-gold);
      display: flex;
      flex-direction: column;
      border-left: 1px solid var(--color-accent-burnt-darker);
      z-index: 1001; /* Encima de todo */
    }

    /*el texto del chat-bot*/
    .barra-chat__header {
      text-align: center;
      padding: 8% 30%;
      font-weight: 600;
      font-size: 38px;
      color: var(--color-dark-brown);
      white-space: nowrap; /*este es para que no se corte el texto*/
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
      border: 1px solid var(--color-dark-brown);
      border-radius: 999px;
      outline: none;
      background: var(--color-accent-burnt);
      font-size: 14px;
      color: var(--color-dark-brown);
    }
    .barra-chat__input input[type="text"]::placeholder {
      color: var(--color-dark-brown);
      opacity: 0.8;
    }

    /* === Contenido Principal (IZQUIERDA 70%) === */

    /* Barra superior */
    .barra-penal {
      position: fixed;
      top: 0;
      left: 0;
      width: 70%; /* Ajustado al 70% */
      height: 60px;
      background: var(--color-primary-light);
      color: var(--color-text-light);
      display: flex;
      align-items: center;
      padding: 0 20px;
      font-weight: 600;
      font-size: 1.2rem;
      z-index: 1000;
    }
    .barra-penal-texto {
      flex-grow: 1; /* Empuja la flecha a la derecha */
    }

    /*la flexita con opciones*/
    .menu-toggle {
      cursor: pointer;
      font-size: 24px;
      padding: 10px; /* Padding normal */
      user-select: none;
    }

    .menu-desplegable {
      position: absolute;
      top: 100%; /* justo debajo de la barra */
      right: 20px; /* Alineado a la derecha de la barra */
      background: #ffffffff;
      width: 300px;
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

    /*colores de los botones (usando variables) */
    .menu-desplegable button:nth-child(1) {
      background: var(--color-accent-gold);
      border: 3px solid var(--color-accent-burnt-darker);
    }
    .menu-desplegable button:nth-child(2) {
      background: var(--color-primary-light);
      border: 3px solid var(--color-primary-darker);
    }
    .menu-desplegable button:nth-child(3) {
      background: var(--color-accent-burnt);
      border: 3px solid var(--color-accent-burnt-darker);
    }
    .menu-desplegable button:nth-child(4) {
      background: var(--color-accent-gold);
      border: 3px solid var(--color-accent-burnt-darker);
    }
    .menu-desplegable button:nth-child(5) {
      background: var(--color-primary-light);
      border: 3px solid var(--color-primary-darker);
    }
    .menu-desplegable button:hover {
      opacity: 0.8;
    }

    /* Input de búsqueda (Fijo) */
    .busqueda {
      position: fixed;
      top: 60px; /* Justo debajo de la barra penal */
      left: 0;
      width: 70%; /* Ajustado al 70% */
      display: flex;
      justify-content: center;
      padding: 10px 0;
      background: var(--color-primary-light);
      z-index: 998; /* Debajo de la barra penal pero encima del contenido */
    }

    .busqueda form {
      display: flex;
      width: 90%;
      max-width: 600px;
    }

    .busqueda input[type="text"] {
      flex: 1;
      padding: 12px 20px;
      border: none;
      border-radius: 8px 0 0 8px;
      font-size: 1rem;
      outline: none;
      background: rgba(255, 255, 255, 0.1);
      color: var(--color-text-light);
    }

    .busqueda input[type="text"]::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    .busqueda button {
      padding: 12px 20px;
      border: none;
      background: var(--color-accent-gold);
      color: var(--color-dark-brown);
      font-weight: bold;
      cursor: pointer;
      border-radius: 0 8px 8px 0;
      transition: all 0.3s ease;
    }

    .busqueda button:hover {
      background: var(--color-accent-burnt);
      color: var(--color-text-light);
    }

    /* Contenido principal (Scrollable) */
    .contenido {
      width: 70%; /* Ajustado al 70% */
      /* Padding para dejar espacio a la barra y buscador fijos */
      padding-top: 130px; /* 60px (barra) + ~70px (buscador) */
      padding-left: 20px;
      padding-right: 20px;
      padding-bottom: 20px;
    }

    .contenedor-info {
      max-width: 900px;
      /* Esto lo centra dentro del 70% del .contenido */
      margin: 0 auto; 
      background: var(--color-primary-light);
      padding: 2rem;
      border-radius: 10px;
      color: var(--color-text-light);
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

    p,
    ul {
      font-size: 18px;
      line-height: 1.6;
      margin-bottom: 1rem;
    }

    ul {
      margin-left: 2rem;
    }

    li {
      margin-bottom: 0.5rem;
    }

    /* Botón "Ver más" ejemplo */
    .btn-ver-mas {
      display: inline-block;
      padding: 10px 20px;
      margin-top: 10px;
      background: var(--color-accent-gold);
      color: var(--color-dark-brown);
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
    }

    .btn-ver-mas:hover {
      background: var(--color-accent-burnt);
      color: var(--color-text-light);
    }
  </style>
</head>
<body>

  <!-- CONTENIDO IZQUIERDA (70%) -->
  <aside class="barra-penal">
    <div class="barra-penal-texto">Derecho Penal</div>
    <div class="menu-toggle">⮟</div>
    
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
  </aside>

  <div class="busqueda">
    <form action="{{ route('penal.buscar') }}" method="GET">
      <input type="text" name="q" placeholder="Buscar artículos..." required>
      <button type="submit">Buscar</button>
    </form>
  </div>

  <main class="contenido">
    <div class="contenedor-info">
      <p>
        <h2>Definición</h2>
      </p>
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
      </p>
    </div>
  </main>

  <!-- CHATBOT (DERECHA 30%) -->
  <aside class="barra-chat">
    <div class="barra-chat__header">chat-bot</div>
    <div class="barra-chat__contenido">
      <!-- zona intermedia para mensajes o lo que quieras -->
    </div>
    <div class="barra-chat__input">
      <input type="text" placeholder="Escribe un mensaje..." />
    </div>
  </aside>

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

</body>
</html>
