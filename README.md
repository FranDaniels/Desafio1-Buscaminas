<h1 align="center">🚩Desafío 1 Buscaminas💣</h1>

<h4 align="center">
:construction: Proyecto en construcción :construction:
</h4>

<h2 align="center">Manual de Usuario</h2>

Inicializaremos el servidor con el comando:<br>
` php -S 127.0.0.1:234`

Los usuarios y los administradores antes de poder realizar cualquier operación deberán iniciar sesión de la siguiente forma:
```
http://127.0.0.1:234/admin/correo/contrasenia
```

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

Para poder listar a los usuarios el Administrador necesitará escribir en la url con el método GET:
``` 
http://127.0.0.1:234/admin/user1/admin123/listar
```
+ Buscar un usuario en específico.

Para poder listar a un usuario en específico el Administrador necesitará escribir en la url con el método GET: 
```
http://127.0.0.1:234/admin/user1/admin123/listar/user1
```
+ Registrar los usuarios.

Para poder registrar a los usuarios el Administrador necesitará escribir en la url con el método POST: 
```
http://127.0.0.1:234/admin/user1/admin123/registrar/nombre/contrasenia/correo/admin
```
+ Modificar los usuarios.

Para poder modificar a los usuarios el Administrador necesitará escribir en la url con el método PUT:
```
http://127.0.0.1:234/admin/user1/admin123/modificar/correo/correoNuevo
```
+ Eliminar los usuarios.

Para poder eliminar a los usuarios el Administrador necesitará escribir en la url con el método DELETE:

```
http://127.0.0.1:234/admin/user1/admin123/eliminar/correo
```
+ Cambiar la contraseña de un usuario en concreto.

Para poder cambiar la contraseña a los usuarios el Administrador necesitará escribir en la url con el método PUT:

```
http://127.0.0.1:234/admin/user1/admin123/cambio/correo/nuevaContrasenia
```

<h3>Usuario</h3>
<h4>El usuario se encargará de:</h4>

+ Crear partidas personalizadas o estándar.

Para poder crear partidas el usuario necesitará escribir en la URL con el método POST:



+ Poder crear el tamaño del tablero y las minas especificándolo en la URL con el método POST:

Para poder crear el tablero el usuario deberá escribir en la URL:
```
http://127.0.0.1:234/user/user1/admin123/tablero/10/3
```

+ Solicitar cambio de contraseña.

Para poder modificar el usuario su contraseña necesitará escribir en la URL con el método PUT:

```
http://127.0.0.1:234/user/user1/admin123/cambio/correo/nuevaContrasenia
```

+ Solicitar ranking de jugadores.

Para poder ver el ranking de jugadores según sus partidas ganadas necesitará escribir en la URL con el método GET:

```
http://127.0.0.1:234/user/user1/admin123/ranking
```

+ Rendirse.

Para poder rendirse el usuario necesitará escribir en la URL con el método PUT:

```
http://127.0.0.1:234/user/user1/admin123/rendirse
```

+ Jugar al buscaminas.

Para poder jugar al buscaminas el usuario necesitará escribir en la URL con el método POST:

```
http://127.0.0.1:234/user/user1/admin123/jugar/3
```

<h3>Programa</h3>
<h4>El programa se encargará de:</h4>

+ En el caso que el usuario no especifique el tamaño de tablero y minas desde la URL, el programa creará uno con tamaño y número de minas predefinido.
