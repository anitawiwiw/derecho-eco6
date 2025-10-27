<html lang="es">
<head>
 <meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <title>Barra Chat Bot</title>
 
 @vite('resources/css/app.css')

 <style>
  /* === INICIO: Estilos Unificados (como en index.blade.php) === */
  :root {
   --color-primary-light: #5a663aff;
   --color-accent-gold: #FEC868;
   --color-accent-burnt: #d67936c0;
   --color-accent-burnt-darker: #e9a349ff;
   --color-primary-darker: #698846ff;
   --color-dark-brown: #473C33;
   --color-text-light: #FDF9F5;
  }

  html, body {
   height: 100%;
   margin: 0;
   font-family: 'Georgia', serif; /* Unificado */
   box-sizing: border-box;
   background: var(--color-dark-brown); /* Unificado */
   color: var(--color-text-light); /* Unificado */
  }

  /* === ESTILOS DE BARRA-CHAT ELIMINADOS === */

  .barra-penal{
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 60px; /* Unificado */
   background: var(--color-primary-light); /* Unificado */
   color: var(--color-text-light); /* Unificado */
   display: flex;
   align-items: center;
   padding: 0 16px;
   z-index: 1000;
   font-weight: 600; /* Unificado */
   font-size: 1.2rem; /* Unificado */
   white-space: nowrap;
  }
  .barra-penal-texto { /* Añadido para consistencia */
    flex-grow: 1; 
    font-size: 1.2rem;
    color: var(--color-text-light);
    white-space: normal; /* Permitir ajuste */
    margin-right: 10px; /* Espacio antes del botón */
  }

  /*la flexita con opciones*/
  .menu-toggle {
   cursor: pointer;
   font-size: 24px;
   padding: 10px; /* Unificado */
   user-select: none;
   margin-left: auto; /* Empuja a la derecha */
  }

  .menu-desplegable {
   position: absolute;
   top: 100%; 
   right: 16px; /* Unificado */
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

  /*colores de los botones (Unificado) */
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
   border: 3px solid var(--color-accent-burnt-darker); /* Ajustado */
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

  /*para que tenga bien los margenes*/
  .contenido {
   padding: 16px;
   margin-right: 0; /* AJUSTADO: ocupa todo el ancho */
   padding-top: 80px; /* AJUSTADO: más espacio */
   width: 100%; 
  }

  /*el contenedor verde con info (Unificado) */
  .contenedor-info {
   max-width: 900px; 
   margin: 20px auto; 
   padding: 2rem;
   background: var(--color-primary-light); 
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

  p {
   /* text-align: justify; */ /* Eliminado */
   font-size: 18px;
   line-height: 1.6;
   margin-bottom: 1rem;
  }
  ul {
   margin-left: 2rem;
   margin-bottom: 1rem;
   list-style-type: disc !important; /* Forzamos puntos */
  }
  li {
   margin-bottom: 0.5rem;
   display: list-item !important; /* Forzamos item de lista */
  }
  li strong { 
    color: var(--color-text-light);
    font-weight: bold;
  }

  /* --- INICIO: ESTILOS DEL CHATBOT FLOTANTE (Igual que en index) --- */
  .chat-bubble {
    position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px;
    background-color: var(--color-accent-gold); color: var(--color-dark-brown);
    border: 2px solid var(--color-accent-burnt-darker); border-radius: 50%;
    font-size: 24px; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    z-index: 1000; transition: transform 0.2s ease; display: flex;
    align-items: center; justify-content: center;
  }
  .chat-bubble:hover { transform: scale(1.1); }
  .chat-popup {
    position: fixed; bottom: 100px; right: 30px; width: 350px; height: 500px;
    background-color: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    z-index: 1001; display: flex; flex-direction: column; opacity: 0;
    transform: translateY(20px); visibility: hidden; transition: all 0.3s ease-out;
  }
  .chat-popup.open { opacity: 1; transform: translateY(0); visibility: visible; }
  .chat-header {
    padding: 15px; background-color: var(--color-primary-light); color: var(--color-text-light);
    border-bottom: 1px solid var(--color-primary-darker); border-radius: 10px 10px 0 0;
    display: flex; justify-content: space-between; align-items: center;
  }
  .chat-header h3 { margin: 0; color: var(--color-text-light); font-size: 20px; text-align: left; text-decoration: none; font-weight: bold; }
  .chat-close-btn { background: none; border: none; font-size: 16px; color: var(--color-text-light); cursor: pointer; }
  .chat-messages { flex-grow: 1; padding: 15px; overflow-y: auto; background-color: #f9f9f9; display: flex; flex-direction: column; gap: 10px; }
  .message { padding: 10px 15px; border-radius: 18px; max-width: 80%; word-wrap: break-word; line-height: 1.4; font-size: 15px; font-family: Arial, sans-serif; }
  .user-message { background-color: var(--color-accent-gold); color: var(--color-dark-brown); align-self: flex-end; border-bottom-right-radius: 4px; }
  .bot-message { background-color: #e5e5e5; color: black; align-self: flex-start; border-bottom-left-radius: 4px; }
  .chat-footer { padding: 15px; display: flex; border-top: 1px solid #ddd; background-color: #fff; border-radius: 0 0 10px 10px; }
  .chat-footer input { flex-grow: 1; border: 1px solid #ccc; border-radius: 20px; padding: 10px 15px; margin-right: 10px; font-size: 14px; color: #333; font-family: Arial, sans-serif; }
  .chat-footer button { background-color: var(--color-primary-light); color: white; border: none; padding: 10px 15px; border-radius: 20px; cursor: pointer; }
  .chat-footer button:hover { opacity: 0.9; }
  /* --- FIN: ESTILOS DEL CHATBOT --- */

 </style>
</head>
<body>

<aside class="barra-penal">
  <div class="barra-penal-texto">El Proceso Penal y las Denuncias</div> <div class="menu-toggle">⮟</div>
  <div class="menu-desplegable" id="menu">
    <button onclick="window.location.href='{{ route('conceptos') }}'">Conceptos Fundamentales</button>
    <button onclick="window.location.href='{{ route('clasificacion') }}'">El Código Penal y los Tipos de Delitos</button>
    <button onclick="window.location.href='{{ route('proceso') }}'">El Proceso Penal y las Denuncias</button>
    <button onclick="window.location.href='{{ route('sistema') }}'">Críticas y Desafíos del Sistema Penal Argentino</button>
    <button onclick="window.location.href='{{ route('adicional') }}'">Clasificaciones Adicionales y Ejemplos de Aplicación</button>
  </div>
</aside> <main class="contenido">
  <div class="contenedor-info">
    <h2>¿Cómo se trata un caso penal?</h2>
    <p>Investigación → Imputación → Juicio oral → Sentencia. Participan: fiscal, defensor, juez, testigos, víctima, imputado. Principio de defensa en juicio, debido proceso y juicio público.</p>

    <h2>Investigación</h2>
    <p>Si alguien comete un delito, se hace una investigación para reunir pruebas.</p>

    <h2>Proceso penal</h2>
    <p>Se inicia un juicio para determinar si la persona es culpable o no. Incluye defensa y acusación, sentencia y cumplimiento de la pena (prisión, multa, trabajo comunitario, etc.).</p>

    <h2>¿Qué hacer frente a un delito?</h2>
    <ul>
     <li>Denunciar: informar a la policía o fiscalía.</li>
     <li>Recabar pruebas: guardar todo lo que pruebe lo ocurrido.</li>
     <li>Buscar asesoría legal.</li>
     <li>Seguir el proceso como testigo, víctima o acusado.</li>
    </ul>

    <h2>Etapas del proceso penal argentino</h2>
    <ul>
     <li>Denuncia o actuación de oficio.</li>
     <li>Investigación penal preparatoria.</li>
     <li>Etapa intermedia: decidir si va a juicio.</li>
     <li>Juicio oral y público.</li>
     <li>Ejecución de la pena.</li>
    </ul>

    <h2>Denuncias</h2>
    <p>Se puede denunciar ante policía, fiscalía o juzgado penal. Cualquier persona puede hacerlo, incluso si no fue víctima directa.</p>

    <h2>Ejemplo práctico</h2>
    <ul>
     <li>Persona denuncia un robo.</li>
     <li>El fiscal investiga.</li>
     <li>El juez decide si hay pruebas para juicio.</li>
     <li>Juicio oral: testigos y pruebas.</li>
     <li>Juez dicta sentencia.</li>
     <li>Acusado tiene derecho a abogado defensor.</li>
    </ul>
  </div> </main> <button id="chat-bubble" class="chat-bubble">💬</button>
<div id="chat-popup" class="chat-popup">
  <div class="chat-header">
    <h3>Asistente Penal</h3>
    <button id="chat-close" class="chat-close-btn">✖</button>
  </div>
  <div id="chat-messages" class="chat-messages">
    <div class="message bot-message">¡Hola! ¿Tenés dudas sobre el Proceso Penal o cómo hacer una Denuncia?</div>
  </div>
  <div class="chat-footer">
    <input type="text" id="chat-input" placeholder="Escribe un mensaje...">
    <button id="chat-send">Enviar</button>
  </div>
</div>
<script>
  // --- LÓGICA DEL MENÚ DESPLEGABLE ---
  const toggle = document.querySelector('.menu-toggle');
  const menu = document.getElementById('menu');
  if(toggle && menu) {
    toggle.addEventListener('click', () => {
      menu.style.display = (menu.style.display === 'flex' ? 'none' : 'flex');
    });
  }

  // --- LÓGICA DEL CHATBOT ---
  const chatBubble = document.getElementById('chat-bubble');
  const chatPopup = document.getElementById('chat-popup');
  const chatClose = document.getElementById('chat-close');
  const chatSend = document.getElementById('chat-send');
  const chatInput = document.getElementById('chat-input');
  const chatMessages = document.getElementById('chat-messages');

  if(chatBubble && chatPopup) chatBubble.addEventListener('click', () => chatPopup.classList.add('open'));
  if(chatClose && chatPopup) chatClose.addEventListener('click', () => chatPopup.classList.remove('open'));
  if(chatSend) chatSend.addEventListener('click', handleSendMessage);
  if(chatInput) chatInput.addEventListener('keypress', (e) => { if (e.key === 'Enter') handleSendMessage(); });

  function handleSendMessage() {
    const userMessage = chatInput.value.trim();
    if (userMessage === '') return;
    addMessage(userMessage, 'user');
    chatInput.value = '';
    setTimeout(() => addMessage(getBotResponse(userMessage), 'bot'), 500);
  }

  function addMessage(message, sender) {
    const msgEl = document.createElement('div');
    msgEl.classList.add('message', sender === 'user' ? 'user-message' : 'bot-message');
    msgEl.textContent = message;
    if(chatMessages) {
      chatMessages.appendChild(msgEl);
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
  }

  // === INTELIGENCIA DEL BOT (Actualizada para esta página) ===
  function getBotResponse(userInput) {
    const text = userInput.toLowerCase();
    
    // Saludos
    if (text.includes('hola') || text.includes('buenos dias')) return '¡Hola! Preguntame sobre el proceso penal, las etapas, las denuncias o qué hacer si sos víctima.';
    
    // Contenido de esta página
    if (text.includes('como se trata') || text.includes('caso penal')) return 'Generalmente sigue estos pasos: Investigación → Imputación → Juicio oral → Sentencia. Participan fiscal, defensor, juez, etc.';
    if (text.includes('investigacion')) return 'Es la etapa donde se reúnen pruebas para saber qué pasó y quién podría ser responsable.';
    if (text.includes('proceso penal')) return 'Es el juicio donde se decide si alguien es culpable. Incluye acusación, defensa, pruebas y sentencia. La pena puede ser prisión, multa, etc.';
    if (text.includes('que hacer') || text.includes('frente a un delito')) return '1. Denunciar (policía/fiscalía). 2. Guardar pruebas. 3. Buscar abogado. 4. Seguir el proceso.';
    if (text.includes('etapas')) return 'Las etapas son: 1. Denuncia/Inicio de oficio. 2. Investigación preparatoria. 3. Etapa intermedia (decisión de juicio). 4. Juicio oral y público. 5. Ejecución de la pena.';
    if (text.includes('denuncia') || text.includes('denunciar')) return 'Es informar un delito a la autoridad. Podés hacerlo en la policía, fiscalía o juzgado penal. Cualquiera puede denunciar.';
    if (text.includes('ejemplo')) return 'Si te roban: 1. Denunciás. 2. El fiscal investiga. 3. El juez evalúa pruebas. 4. Se hace el juicio oral. 5. El juez da la sentencia. Tenés derecho a un abogado defensor.';

    // Despedida
    if (text.includes('gracias') || text.includes('adios')) return '¡De nada! Si tenés más dudas sobre el proceso, consultame.';
    
    // Default
    return 'No entendí bien. Podés preguntarme sobre: cómo se trata un caso, investigación, proceso, qué hacer, etapas o denuncias.';
  }
</script>

</body>
</html>