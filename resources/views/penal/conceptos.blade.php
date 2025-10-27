<html lang="es">
<head>
 <meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <title>Barra Chat Bot</title>
 
 @vite('resources/css/app.css')

 <style>
  /* === INICIO: Tus estilos originales (con ajustes) === */
  :root { /* Usamos la paleta que definiste en el index */
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
   /* Usamos la fuente del index */
   font-family: 'Georgia', serif; 
   box-sizing: border-box;
   /* Forzamos el fondo oscuro */
   background: var(--color-dark-brown) !important; 
   color: var(--color-text-light) !important;
  }

  /* === ESTILOS DE BARRA-CHAT ELIMINADOS === */

  .barra-penal{
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 60px; /* Ajustado como en index */
   background: var(--color-primary-light); /* Usando paleta index */
   color: var(--color-text-light); /* Usando paleta index */
   display: flex;
   align-items: center;
   padding: 0 16px;
   z-index: 1000;
   font-weight: 600; /* Heredado de index */
   font-size: 1.2rem; /* Heredado de index */
   white-space: nowrap;
  }
  .barra-penal-texto { /* Clase añadida para consistencia con index */
    flex-grow: 1; 
    font-size: 1.2rem; /* Coincide con .barra-penal */
    color: var(--color-text-light); /* Coincide con .barra-penal */
    white-space: normal; /* Permitir que el texto largo se ajuste */
  }


  /*la flexita con opciones*/
  .menu-toggle {
   cursor: pointer;
   font-size: 24px;
   padding: 10px; /* Ajustado como en index */
   user-select: none;
   margin-left: auto; /* Empuja el botón a la derecha */
  }

  .menu-desplegable {
   position: absolute;
   top: 100%; 
   right: 16px; /* Alineado a la derecha como en index */
   /* Eliminado left y transform */
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
   color: white; /* Color original */
   cursor: pointer;
   transition: opacity 0.2s;
  }

  /*colores de los botones (usando paleta index) */
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
   padding-top: 80px; /* AJUSTADO: más espacio para la barra */
   width: 100%; /* Asegura que ocupe todo */
  }

  /*el contenedor verde con info*/
  .contenedor-info {
   /* Ajustado como en index */
   max-width: 900px; 
   margin: 20px auto; /* Centrado y con margen superior */
   padding: 2rem;
   background: var(--color-primary-light); /* Usando paleta index */
   border-radius: 10px; /* Añadido borde redondeado */
   color: var(--color-text-light); /* Usando paleta index */
   /* Eliminado flex y min-height */
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
   /* Eliminado text-align: justify; */
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

  /* Eliminado .bloque */
  /* === FIN: Tus estilos originales === */


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
  <div class="barra-penal-texto">Conceptos Fundamentales del Derecho Penal</div>
  <div class="menu-toggle">⮟</div>
  <div class="menu-desplegable" id="menu">
    <button onclick="window.location.href='{{ route('conceptos') }}'">Conceptos Fundamentales</button>
    <button onclick="window.location.href='{{ route('clasificacion') }}'">El Código Penal y los Tipos de Delitos</button>
    <button onclick="window.location.href='{{ route('proceso') }}'">El Proceso Penal y las Denuncias</button>
    <button onclick="window.location.href='{{ route('sistema') }}'">Críticas y Desafíos del Sistema Penal Argentino</button>
    <button onclick="window.location.href='{{ route('adicional') }}'">Clasificaciones Adicionales y Ejemplos de Aplicación</button>
  </div>
</aside> <main class="contenido">
  <div class="contenedor-info">
    <h2>¿Qué es el Derecho Penal?</h2>
    <p>Es una rama del derecho público que se encarga de establecer qué conductas son delitos y cuáles son las sanciones para quienes las cometen.</p>
    <p>En otras palabras: el Derecho Penal es la relación entre el Estado y el ciudadano cuando hay una conducta delictiva. Protege a la sociedad castigando las acciones más graves, como el robo, el homicidio, el abuso, entre otros.</p>

    <h2>¿De qué trata el Derecho Penal?</h2>
    <p>Trata de regular el poder punitivo del Estado, o sea, el poder que tiene el Estado para castigar a una persona cuando comete un delito. Su objetivo es:</p>
    <ul>
      <li>Prevenir los delitos.</li>
      <li>Reparar el daño causado.</li>
      <li>Reinsertar al delincuente en la sociedad.</li>
      <li>Proteger los derechos de todas las personas.</li>
    </ul>
    <p>Es público: porque el Estado acusa, no un particular.<br>
       Es punitivo: porque aplica sanciones.<br>
       Es “Última ratio” porque se aplica sólo cuando otras ramas no pueden resolver el conflicto.</p>

    <h2>Finalidad del Derecho Penal</h2>
    <ul>
      <li>Proteger bienes jurídicos (como la vida, la libertad, la propiedad).</li>
      <li>Evitar la venganza personal (es decir, que cada uno haga justicia por mano propia).</li>
      <li>Como todo el Derecho: mantener el orden social.</li>
    </ul>

    <h2>Principios fundamentales (Oliver)</h2>
    <ul>
      <li>Legalidad: No hay delito ni pena sin ley previa (art. 18 CN).</li>
      <li>Irretroactividad: La ley penal no se aplica hacia el pasado (salvo que beneficie al acusado).</li>
      <li>Proporcionalidad: La pena debe ser justa respecto al daño.</li>
      <li>Presunción de inocencia.</li>
    </ul>
  </div>
</main> <button id="chat-bubble" class="chat-bubble">💬</button>
<div id="chat-popup" class="chat-popup">
  <div class="chat-header">
    <h3>Asistente Penal</h3>
    <button id="chat-close" class="chat-close-btn">✖</button>
  </div>
  <div id="chat-messages" class="chat-messages">
    <div class="message bot-message">¡Hola! Soy tu asistente virtual. ¿En qué puedo ayudarte sobre los Conceptos Fundamentales?</div>
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

  function getBotResponse(userInput) {
    const text = userInput.toLowerCase();
    
    // Saludos
    if (text.includes('hola') || text.includes('buenos dias')) return '¡Hola! ¿Qué concepto fundamental del Derecho Penal te interesa?';
    
    // Contenido de esta página
    if (text.includes('que es') || text.includes('definicion')) return 'Es la rama del derecho público que define delitos y establece sanciones para proteger a la sociedad.';
    if (text.includes('trata') || text.includes('objetivo')) return 'Regula el poder del Estado para castigar (poder punitivo), buscando prevenir delitos, reparar daños, reinsertar y proteger derechos.';
    if (text.includes('finalidad') || text.includes('proposito')) return 'Proteger bienes jurídicos (vida, libertad), evitar venganza personal y mantener el orden social.';
    if (text.includes('principios')) return 'Legalidad (ley previa), Irretroactividad (no hacia el pasado, salvo beneficio), Proporcionalidad (pena justa) y Presunción de inocencia.';
    if (text.includes('legalidad')) return 'Significa que no puede haber delito ni pena si no existe una ley escrita antes de que ocurriera el hecho (Art. 18 de la Constitución Nacional).';
    if (text.includes('irretroactividad')) return 'La ley penal no se aplica a hechos ocurridos antes de su entrada en vigencia, excepto si la nueva ley es más beneficiosa para el acusado.';
    
    // Despedida
    if (text.includes('gracias') || text.includes('adios')) return '¡De nada! Si tenés más dudas, preguntame.';
    
    // Default
    return 'No entendí. Podés preguntar sobre: qué es, de qué trata, finalidad o principios del Derecho Penal.';
  }
</script>

</body>
</html>