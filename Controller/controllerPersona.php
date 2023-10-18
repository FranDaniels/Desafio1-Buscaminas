<?php

require_once('Auxiliar/factoria.php');
require_once('Auxiliar/conexion.php');

class controllerPersona
{

    public static function login($correo, $contrasenia)
    {
        $jugador = conexion::consultarUsuario($correo);

        if ($jugador instanceof persona) {
            if ($jugador->getCorreo() == $correo) {
                if ($jugador->getContrasenia() == ($contrasenia)) {
                    return $jugador;
                } else {
                    $cod = 400;
                    $mes = 'Contraseña erronea.';
                    header('HTTP/1.1 ' . $cod . ' ' . $mes);

                    return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
                }
            } else {
                $cod = 400;
                $mes = 'Correo incorrecto.';
                header('HTTP/1.1 ' . $cod . ' ' . $mes);

                return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
            }
        } else {
            $cod = 422;
            $mes = 'Error en el usuario.';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function obtenerJugadores()
    {
        $jugadores = conexion::getJugadores();

        if ($jugadores[0] instanceof persona) {
            $cod = 200;
            $mes = 'Todo OK';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 422;
            $mes = 'Error con los jugadores';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function busquedaEspecifica($correo)
    {
        if (conexion::consultarUsuario($correo)) {
            $cod = 200;
            $mes = 'Todo OK';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 422;
            $mes = 'Error con los jugadores';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function actualizarJugador($correo, $nuevoCorreo)
    {

        if (conexion::modificarUsuario($correo, $nuevoCorreo)) {
            $cod = 200;
            $mes = 'Todo OK';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 422;
            $mes = 'Error al modificar el usuario';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function borrarJugador($correo)
    {
        if (conexion::borrarUsuario($correo)) {
            $cod = 200;
            $mes = 'Todo OK';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 422;
            $mes = 'Error borrar el usuario';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function crearJugador($nombre, $contrasenia, $correo, $admin)
    {
        if (conexion::crearUsuario(0, $nombre, $contrasenia, $correo, 0, 0, $admin)) {
            $cod = 200;
            $mes = 'Todo OK';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 422;
            $mes = 'Error al crear el jugador';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function actualizarContrasenia($correo, $nuevaContrasenia)
    {

        if (conexion::modificarContraseña($correo, $nuevaContrasenia)) {
            $cod = 200;
            $mes = 'Todo OK';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 422;
            $mes = 'Error al modificar el usuario';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function todoElRanking()
    {
        if (conexion::todoRanking()) {
            $cod = 200;
            $mes = 'Todo OK';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 422;
            $mes = 'Error al mostrar el ranking';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }
}
