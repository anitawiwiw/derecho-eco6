<html lang="es">
<head>
 <meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <title>Barra Chat Bot</title>
 
 @vite('resources/css/app.css')

 <style>
  :root {
   --color-primary-light: #5a663aff;
   --color-accent-gold: #FEC868;
   --color-accent-burnt: #d67936c0;
   --color-accent-burnt-darker: #e9a349ff;
   --color-primary-darker: #698846ff;
   --color-dark-brown: #473C33;
   --color-text-light: #FDF9F5;
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

  /* === Contenido Principal (100%) === */

  /* Barra superior */
  .barra-penal {
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
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
   flex-grow: 1;
  }

  /*la flexita con opciones*/
  .menu-toggle {
   cursor: pointer;
   font-size: 24px;
   padding: 10px;
   user-select: none;
  }

  .menu-desplegable {
   position: absolute;
   top: 100%;
   right: 20px;
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
   top: 60px;
   left: 0;
   width: 100%;
   display: flex;
   justify-content: center;
   padding: 10px 0;
   background: var(--color-primary-light);
   z-index: 998;
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
   width: 100%;
   padding-top: 130px;
   padding-left: 20px;
   padding-right: 20px;
   padding-bottom: 20px;
  }

  .contenedor-info {
   max-width: 900px;
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


  /* --- INICIO: ESTILOS DEL CHATBOT FLOTANTE --- */

  /* 1. La Burbuja */
  .chat-bubble {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background-color: var(--color-accent-gold);
    color: var(--color-dark-brown);
    border: 2px solid var(--color-accent-burnt-darker);
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    z-index: 1000;
    transition: transform 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .chat-bubble:hover {
    transform: scale(1.1);
  }

  /* 2. La Ventana del Chat */
  .chat-popup {
    position: fixed;
    bottom: 100px;
    right: 30px;
    width: 350px;
    height: 500px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    z-index: 1001;
    display: flex;
    flex-direction: column;
    
    opacity: 0;
    transform: translateY(20px);
    visibility: hidden;
    transition: all 0.3s ease-out;
  }

  /* Clase que usará JS para mostrar el chat */
  .chat-popup.open {
    opacity: 1;
    transform: translateY(0);
    visibility: visible;
  }

  /* 3. Estilos internos del chat */
  .chat-header {
    padding: 15px;
    background-color: var(--color-primary-light);
    color: var(--color-text-light);
    border-bottom: 1px solid var(--color-primary-darker);
    border-radius: 10px 10px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .chat-header h3 {
    margin: 0;
    color: var(--color-text-light);
    font-size: 20px;
    text-align: left;
    text-decoration: none;
    font-weight: bold;
  }

  .chat-close-btn {
    background: none;
    border: none;
    font-size: 16px;
    color: var(--color-text-light);
    cursor: pointer;
  }

  .chat-messages {
    flex-grow: 1;
    padding: 15px;
    overflow-y: auto;
    background-color: #f9f9f9;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .message {
    padding: 10px 15px;
    border-radius: 18px;
    max-width: 80%;
    word-wrap: break-word;
    line-height: 1.4;
    font-size: 15px;
    font-family: Arial, sans-serif; /* Fuente limpia para el chat */
  }

  .user-message {
    background-color: var(--color-accent-gold);
    color: var(--color-dark-brown);
    align-self: flex-end;
    border-bottom-right-radius: 4px;
  }

  .bot-message {
    background-color: #e5e5e5;
    color: black;
    align-self: flex-start;
    border-bottom-left-radius: 4px;
  }

  .chat-footer {
    padding: 15px;
    display: flex;
    border-top: 1px solid #ddd;
    background-color: #fff;
    border-radius: 0 0 10px 10px;
  }

  .chat-footer input {
    flex-grow: 1;
    border: 1px solid #ccc;
    border-radius: 20px;
    padding: 10px 15px;
    margin-right: 10px;
    font-size: 14px;
    color: #333;
    font-family: Arial, sans-serif;
  }

  .chat-footer button {
    background-color: var(--color-primary-light);
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 20px;
    cursor: pointer;
  }
  .chat-footer button:hover {
    opacity: 0.9;
  }

 </style>
</head>
<body>

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

 <button id="chat-bubble" class="chat-bubble">
   💬
 </button>

 <div id="chat-popup" class="chat-popup">
   
   <div class="chat-header">
     <h3>Asistente Penal</h3>
     <button id="chat-close" class="chat-close-btn">✖</button>
   </div>
   
   <div id="chat-messages" class="chat-messages">
     <div class="message bot-message">
       ¡Hola! Soy tu asistente virtual. ¿En qué puedo ayudarte sobre Derecho Penal?
     </div>
   </div>
   
   <div class="chat-footer">
     <input type="text" id="chat-input" placeholder="Escribe un mensaje...">
     <button id="chat-send">Enviar</button>
   </div>
 </div>
 <script>
  // --- LÓGICA DEL MENÚ DESPLEGABLE (TU CÓDIGO) ---
  const toggle = document.querySelector('.menu-toggle');
  const menu = document.getElementById('menu');

  if(toggle && menu) { 
   toggle.addEventListener('click', () => {
    if (menu.style.display === 'flex') {
     menu.style.display = 'none';
    } else {
     menu.style.display = 'flex';
    }
   });
  }


  // --- INICIO: NUEVA LÓGICA DEL CHATBOT ---

  // 1. Obtener los elementos del DOM
  const chatBubble = document.getElementById('chat-bubble');
  const chatPopup = document.getElementById('chat-popup');
  const chatClose = document.getElementById('chat-close');
  const chatSend = document.getElementById('chat-send');
  const chatInput = document.getElementById('chat-input');
  const chatMessages = document.getElementById('chat-messages');

  // 2. Abrir el chat al hacer clic en la burbuja
  if(chatBubble && chatPopup) { 
   chatBubble.addEventListener('click', () => {
     chatPopup.classList.add('open');
   });
  }

  // 3. Cerrar el chat al hacer clic en la 'X'
  if(chatClose && chatPopup) { 
   chatClose.addEventListener('click', () => {
     chatPopup.classList.remove('open');
   });
  }

  // 4. Enviar mensaje al hacer clic en 'Enviar'
  if(chatSend) { 
   chatSend.addEventListener('click', () => {
     handleSendMessage();
   });
  }
  
  // 5. Enviar mensaje al presionar 'Enter'
  if(chatInput) { 
   chatInput.addEventListener('keypress', (event) => {
     if (event.key === 'Enter') {
       handleSendMessage();
     }
   });
  }

  // --- Funciones principales ---

  function handleSendMessage() {
    const userMessage = chatInput.value.trim();
    
    if (userMessage === '') return;

    addMessage(userMessage, 'user');
    chatInput.value = '';

    setTimeout(() => {
      const botResponse = getBotResponse(userMessage);
      addMessage(botResponse, 'bot');
    }, 500);
  }

  function addMessage(message, sender) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('message');
    messageElement.classList.add(sender === 'user' ? 'user-message' : 'bot-message');
    messageElement.textContent = message;

    if(chatMessages) { 
     chatMessages.appendChild(messageElement);
     chatMessages.scrollTop = chatMessages.scrollHeight;
    }
  }

  // =============================================
  //      AQUÍ VA LA "INTELIGENCIA" DEL BOT
  // =============================================
  function getBotResponse(userInput) {
    const text = userInput.toLowerCase();

    // Saludos
    if (text.includes('hola') || text.includes('buenos dias') || text.includes('buenas tardes')) {
      return '¡Hola! ¿En qué puedo ayudarte hoy sobre Derecho Penal?';
    }

    // Definiciones (basado en tu HTML)
    if (text.includes('definicion') || text.includes('que es el derecho penal')) {
      return 'El Derecho Penal es la rama del derecho público que establece cuáles son las conductas consideradas delitos y fija las penas o medidas que se aplican a quienes las cometen.';
    }
    
    if (text.includes('tipos')) {
      return 'Los tipos principales son: 1. Sustantivo (define delitos y penas), 2. Adjetivo o procesal (regula la investigación y juicio), 3. Común (todo el territorio) y 4. Especial (normas específicas fuera del Código).';
    }

    if (text.includes('bienes juridicos') || text.includes('que protege')) {
      return 'El Derecho Penal protege bienes jurídicos como la vida, la integridad física, la libertad (amenazas, abuso), la propiedad (hurto, robo) y la administración pública, entre otros.';
    }
    
    if (text.includes('penas')) {
      return 'El Código Penal prevé penas como: Prisión o reclusión, Multa, e Inhabilitación (prohibición de ejercer cargos o derechos).';
    }
    
    if (text.includes('proceso penal')) {
      return 'El proceso incluye etapas como: la Denuncia, la Investigación penal preparatoria (a cargo del fiscal), la Etapa intermedia, el Juicio oral y público, y la Ejecución de la pena.';
    }
    
    if (text.includes('denuncia') || text.includes('denunciar')) {
      return 'La denuncia es la comunicación de un delito. Puede hacerse ante la policía, en la fiscalía o ante un juzgado penal.';
    }
    
    if (text.includes('argentina') || text.includes('codigo penal')) {
      return 'En Argentina, el Derecho Penal se encuentra regulado principalmente en el Código Penal de la Nación (1921, con múltiples reformas).';
    }

    // Despedida
    if (text.includes('gracias') || text.includes('adios') || text.includes('chau')) {
      return '¡De nada! Ha sido un placer ayudarte. ¡Vuelve pronto!';
    }

    // Respuesta por defecto
    return 'No estoy seguro de cómo responder a eso. Intenta preguntar por "definición", "tipos", "penas", "proceso penal" o "denuncias".';
  }

  // --- FIN: NUEVA LÓGICA DEL CHATBOT ---
 </script>

</body>
</html>