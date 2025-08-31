<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Barra Chat Bot</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
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
   .barra-chat__input input[type="text"] {
      width: 100%;
      padding: 20px 26px;
      border: 1px solid #d4864eff;
      border-radius: 999px; 
      outline: none;
      background: #fda769;
      font-size: 14px;
    }
    </style>
</head>
<body>
<main class="contenido">

</main>


<aside class="barra-chat">
<div class="barra-chat__header">chat-bot</div>


<div class="barra-chat__contenido">
<!-- zona intermedia para mensajes o lo que quieras -->
</div>


<div class="barra-chat__input">
<input type="text" placeholder="Escribe un mensaje..." />
</div>
</aside>
</body>
</html>