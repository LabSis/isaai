<html>
    <head>
        <title>Alerta</title>
        <script lang="javascript">
            var websocket;
            function conectar() {
                var wsUri = "ws://172.16.170.61:9000/isaai/server.php";
                websocket = new WebSocket(wsUri);
                console.log("OK");

                websocket.onopen = function(ev) {
                    document.getElementById("divMensajeConectado").style.display = "inline";
                    console.log("CONECTADO!");
                    //$('#message_box').append("<div class=\"system_msg\">Connected!</div>");
                };
                websocket.onerror = function(ev) {
                    console.log("ERROR" + ev);
                };
                websocket.onclose = function(ev) {
                    console.log("CERRADO");
                };
                websocket.onmessage = function(ev) {
                    console.log("OK");
                    var msg = JSON.parse(ev.data);
                    console.log(msg);
                };
            }
        </script>
    </head>
    <body>
        <form action="generar_alerta.php" method="POST">
            <input type="submit" value="Enviar" />
        </form><br />
        <input type="button" onclick="conectar();" value="Conectar con el servidor" />
        <div id="divMensajeConectado" style="display: none;">conectado!</div>
    </body>
</html>