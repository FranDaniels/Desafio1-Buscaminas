<h1 align="center">🚩Desafío 1 Buscaminas💣</h1>

![Imagen mina](https://github.com/FranDaniels/Desafio1-Buscaminas/assets/122791264/b7f31e26-94be-41e6-a61e-41fcca8c23ab)

<h4 align="center">
:construction: Proyecto en construcción :construction:
</h4>

<h2 align="center">Manual de Usuario</h2>

Inicializaremos el servidor con el comando:
` php -S 127.0.0.1:234`

<h2 align="center">🛠Manual de Administrador🛠</h2>
<h3>Enunciado</h3>
<p>Vamos a realizar una aplicación WEB que permita gestionar partidas de buscamina. La
aplicación guardará las partidas activas y el histórico de las partidas jug adas (hayan
sido ganadas o perdidas); también se contabilizará la cantidad de partidas ganadas.
Asimismo la aplicación permitirá un sistema de gestión de usuarios accesible solo por
los administradores.
Nuestra aplicación tendrá los siguientes roles: administrador y jugador.</p>

<h4>Administrador</h4>
<h5>El administrador se encargará de:</h5>
+ Listar los usuarios.
+ Buscar un usuario en específico.
+ Registrar los usuarios.
+ Modificar los usuarios.
+ Eliminar los usuarios.
+ Cambiar la contraseña de un usuario en concreto.

<h5>El usuario se encargará de:</h5>
+ Crear partidas personalizadas o estándar.
+ Poder crear el tamaño del tablero y las minas especificándolo en la URL.
+ Solicitar cambio de contraseña.
+ Solicitar ranking de jugadores.
+ Rendirse.
+ Jugar al buscaminas.

<h5>El programa se encargará de:</h5>
+ En el caso que el usuario no especifique el tamaño de tablero y minas desde la URL, el programa creará uno con tamaño y número de minas predefinido.
