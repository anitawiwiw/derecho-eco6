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
  /* Eliminado .bloque */

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
  <div class="barra-penal-texto">Clasificaciones Adicionales y Ejemplos de Aplicación</div> <div class="menu-toggle">⮟</div>
  <div class="menu-desplegable" id="menu">
    <button onclick="window.location.href='{{ route('conceptos') }}'">Conceptos Fundamentales</button>
    <button onclick="window.location.href='{{ route('clasificacion') }}'">El Código Penal y los Tipos de Delitos</button>
    <button onclick="window.location.href='{{ route('proceso') }}'">El Proceso Penal y las Denuncias</button>
    <button onclick="window.location.href='{{ route('sistema') }}'">Críticas y Desafíos del Sistema Penal Argentino</button>
    <button onclick="window.location.href='{{ route('adicional') }}'">Clasificaciones Adicionales y Ejemplos de Aplicación</button>
  </div>
</aside> <main class="contenido">
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
  </div> </main> <button id="chat-bubble" class="chat-bubble">💬</button>
<div id="chat-popup" class="chat-popup">
  <div class="chat-header">
    <h3>Asistente Penal</h3>
    <button id="chat-close" class="chat-close-btn">✖</button>
  </div>
  <div id="chat-messages" class="chat-messages">
    <div class="message bot-message">¡Hola! ¿Dudas sobre tipos de derecho penal, bienes jurídicos, penas o principios?</div>
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
    if (text.includes('hola') || text.includes('buenos dias')) return '¡Hola! Preguntame sobre derecho penal en Argentina, tipos, bienes jurídicos, penas, principios o el Art. 79.';
    
    // Contenido de esta página
    if (text.includes('derecho penal en argentina')) return 'Es la rama del derecho público que define delitos y penas, protegiendo bienes como la vida o la propiedad. Se basa en el Código Penal de 1921 (reformado).';
    if (text.includes('tipos de derecho penal')) return 'Hay 4 tipos: Sustantivo (delitos/penas), Adjetivo/Procesal (cómo se investiga/juzga), Común (todo el país) y Especial (leyes fuera del Código, ej: drogas).';
    if (text.includes('bienes juridicos') || text.includes('bienes jurídicos')) return 'Son los valores que protege la ley penal: vida, integridad física, libertad, propiedad, orden público, administración pública, etc.';
    if (text.includes('penas')) return 'Las penas pueden ser: Prisión/reclusión (quitar libertad), Multa (pagar dinero), Inhabilitación (prohibir ejercer cargos/profesiones) o Accesorias (ej: perder patria potestad).';
    if (text.includes('ejemplo') || text.includes('aplicacion') || text.includes('aplicación')) return 'Ejemplo: Si alguien roba una bici, el Estado investiga y aplica una sanción (pena) para proteger el derecho a la propiedad de la víctima.';
    if (text.includes('principios')) return 'Los más importantes son: Legalidad (ley previa), Irretroactividad (ley no va al pasado, salvo beneficio) y Presunción de inocencia (culpable solo con sentencia firme).';
    if (text.includes('codigo penal') || text.includes('articulo 79') || text.includes('artículo 79')) return 'El Art. 79 del Código Penal trata sobre el homicidio simple ("el que matare a otro") y establece una pena de 8 a 25 años de prisión. Hay diferencias con el homicidio agravado.';

    // Despedida
    if (text.includes('gracias') || text.includes('adios')) return '¡De nada! Si tenés más consultas, avisame.';
    
    // Default
    return 'No entendí. Podés preguntar sobre: derecho penal argentino, tipos, bienes jurídicos, penas, ejemplo, principios o el Art. 79.';
  }
</script>

</body>
</html>