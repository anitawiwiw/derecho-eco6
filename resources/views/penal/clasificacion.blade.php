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
  li strong { /* Para que el texto en negrita dentro de li sea blanco */
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
  <div class="barra-penal-texto">El Código Penal y los Tipos de Delitos</div>
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
    <h2>El Código Penal Argentino</h2>
    <p>Vigente desde 1921 (con reformas). Contiene los tipos de delitos y sus penas.</p>
    <p>Se divide en:</p>
    <ul>
     <li>Parte general (principios, penas, participación).</li>
     <li>Parte especial (delitos específicos: homicidio, robo, abuso, corrupción, etc.).</li>
    </ul>

    <h2>Tipos de delitos</h2>
    <ul>
     <li>Delitos contra la vida (homicidio).</li>
     <li>Contra la integridad sexual (abuso).</li>
     <li>Contra la propiedad (robo, hurto).</li>
     <li>Delitos económicos, ambientales, informáticos, etc.</li>
    </ul>

    <h2>¿Cómo se aplica el Derecho Penal?</h2>
    <p>A través de un Código Penal, que es un conjunto de normas que dicen:</p>
    <ul>
     <li>Qué actos son delitos.</li>
     <li>Qué penas se aplican.</li>
     <li>Qué circunstancias pueden agravar o reducir la pena (por ejemplo, si fue con violencia o si el acusado es menor de edad).</li>
    </ul>

    <h2>Cuadro comparativo – Derecho Penal Argentino</h2>
    <ul>
     <li><strong>Definición de Derecho Penal:</strong> Libro Primero – Título I: Aplicación de la Ley Penal (arts. 1 a 4)</li>
     <li><strong>Tipos de Derecho Penal:</strong> No aparece en el índice del Código Penal.</li>
     <li><strong>Bienes Jurídicos protegidos:</strong> Libro Segundo – De los Delitos (varios títulos)</li>
     <li><strong>Penas:</strong> Libro Primero - Título II: De las Penas (arts. 5 a 25)</li> <li><strong>Denuncias:</strong> Libro Primero – Título XI: Del ejercicio de las acciones (arts. 71 a 76)</li>
    </ul>

    <h2>Tipos de delitos (con ejemplos)</h2>
    <ul>
     <li>Delitos contra la vida: Caso femicidio en Salta, sancionado con prisión perpetua.</li>
     <li>Delitos contra la propiedad: Robo de electrodomésticos con violencia o arma.</li>
     <li>Delitos sexuales: Caso de abuso sexual en escuela, agravado si víctima menor.</li>
     <li>Delitos informáticos: Hackeo de cuenta bancaria con estafa electrónica.</li>
    </ul>
  </div>
</main> <button id="chat-bubble" class="chat-bubble">💬</button>
<div id="chat-popup" class="chat-popup">
  <div class="chat-header">
    <h3>Asistente Penal</h3>
    <button id="chat-close" class="chat-close-btn">✖</button>
  </div>
  <div id="chat-messages" class="chat-messages">
    <div class="message bot-message">¡Hola! ¿Qué querés saber sobre el Código Penal o los tipos de delitos?</div>
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
    if (text.includes('hola') || text.includes('buenos dias')) return '¡Hola! Preguntame sobre el Código Penal, sus partes, o tipos de delitos.';
    
    // Contenido de esta página
    if (text.includes('codigo penal')) return 'Es la ley principal (desde 1921, con reformas) que define los delitos y sus penas en Argentina. Se divide en Parte General y Parte Especial.';
    if (text.includes('parte general')) return 'La Parte General establece los principios básicos, cómo se aplican las penas y quiénes pueden ser responsables (participación).';
    if (text.includes('parte especial')) return 'La Parte Especial describe cada delito específico: homicidio, robo, abuso, estafa, corrupción, etc., y qué pena le corresponde a cada uno.';
    if (text.includes('tipos de delito')) return 'Hay muchos tipos: contra la vida (homicidio), contra la integridad sexual (abuso), contra la propiedad (robo, hurto), económicos, informáticos, ambientales, etc.';
    if (text.includes('como se aplica') || text.includes('aplicacion')) return 'Se aplica a través del Código Penal, que dice qué es delito, qué pena corresponde y qué circunstancias agravan o atenúan (como la violencia o ser menor de edad).';
    if (text.includes('ejemplos')) return 'Contra la vida: femicidio. Contra la propiedad: robo con arma. Sexuales: abuso a menores. Informáticos: hackeo y estafa.';
    if (text.includes('cuadro') || text.includes('comparativo')) return 'El cuadro muestra dónde encontrar info en el Código: Aplicación (Arts 1-4), Bienes Jurídicos (Libro Segundo), Penas (Arts 5-25), Denuncias (Arts 71-76).';

    // Despedida
    if (text.includes('gracias') || text.includes('adios')) return '¡De nada! Si tenés más dudas, consultame.';
    
    // Default
    return 'No entendí bien. Podés preguntarme sobre: el Código Penal, sus partes (general o especial), tipos de delitos, o cómo se aplica.';
  }
</script>

</body>
</html>