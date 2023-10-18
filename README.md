<h1 align="center">🚩Desafío 1 Buscaminas💣</h1>

<h4 align="center">
:construction: Proyecto en construcción :construction:
</h4>

<h2 align="center">Manual de Usuario</h2>

Inicializaremos el servidor con el comando:<br>
` php -S 127.0.0.1:234`

<h2 align="center">🛠Manual de Administrador🛠</h2>
<h3>Enunciado</h3>
<p>Vamos a realizar una aplicación WEB que permita gestionar partidas de buscamina. La
aplicación guardará las partidas activas y el histórico de las partidas jug adas (hayan
sido ganadas o perdidas); también se contabilizará la cantidad de partidas ganadas.
Asimismo la aplicación permitirá un sistema de gestión de usuarios accesible solo por
los administradores.
Nuestra aplicación tendrá los siguientes roles: administrador y jugador.</p>

<h3>Administrador</h3>
<h4>El administrador se encargará de:</h4>

+ Listar los usuarios.
+ Buscar un usuario en específico.
+ Registrar los usuarios.
+ Modificar los usuarios.
+ Eliminar los usuarios.
+ Cambiar la contraseña de un usuario en concreto.

<h3>Usuario</h3>
<h4>El usuario se encargará de:</h4>

+ Crear partidas personalizadas o estándar.
+ Poder crear el tamaño del tablero y las minas especificándolo en la URL.
+ Solicitar cambio de contraseña.
+ Solicitar ranking de jugadores.
+ Rendirse.
+ Jugar al buscaminas.

<h3>Programa</h3>
<h4>El programa se encargará de:</h4>

+ En el caso que el usuario no especifique el tamaño de tablero y minas desde la URL, el programa creará uno con tamaño y número de minas predefinido.
