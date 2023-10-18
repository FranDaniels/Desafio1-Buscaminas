<?php

require_once('Auxiliar/factoria.php');
require_once('Auxiliar/conexion.php');
require_once('Controller/controllerJSON.php');

class controllerPartida
{

    public static function crearPartida($idUsu, $idpartida, $tamanio, $cantBombas)
    {

        if (factoria::creacionPartida($idpartida, $idUsu, $tamanio, $cantBombas)) {
            $cod = 202;
            $mes = 'Todo OK';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 422;
            $mes = 'Error al crear la partida';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function consultarPartidaCreada($idpartida)
    {
        $partidaIniciada = conexion::consultarPartida($idpartida);

        if ($partidaIniciada['finalizado'] == 1) {
            $cod = 202;
            $mes = 'Todo OK'; //Hay una partida no finalizada
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 400;
            $mes = 'No existe ninguna partida iniciada';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function borrarPartida($idpartida)
    {

        if (conexion::borrarPartida($idpartida)) {
            $cod = 200;
            $mes = 'Todo OK';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 422;
            $mes = 'Error borrar la partida';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function actualizarPartidaFinalizada($idpartida)
    {

        if (conexion::actualizarPartidaFinalizada($idpartida)) {
            $cod = 200;
            $mes = 'Todo OK';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 422;
            $mes = 'Error al actualizar la partida finalizada';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function rendirse($idpartida)
    {
        if (conexion::rendirse($idpartida)) {
            $cod = 200;
            $mes = 'Todo OK';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        } else {
            $cod = 422;
            $mes = 'Error al rendirse';
            header('HTTP/1.1 ' . $cod . ' ' . $mes);

            return json_encode(['Código' => $cod, 'Mensaje' => $mes]);
        }
    }

    public static function jugar($idpartida, $correo, $posicion)
    {
        $conexion = new conexion();
        $partida = $conexion->consultarPartida($idpartida);
        $jsonControlador = new controllerJSON;
        $tablerOculto = $partida->getTableroOculto();
        $tableroJugador = $partida->getTableroMostrado();
        $bombas = 0;
        $finalizado = false;

        if ($partida) {
            if ($partida->getIdPartida() == $idpartida && $partida->getIdUsuario() == $correo) { //Comprobamos que existe la partida coincide con el usuario
                if ($partida->getFinalizado() == 0) {

                    if ($tablerOculto[$posicion] == '*') {
                        $cod = 205;
                        $mes = 'Has dado con una mina has perdido';
                        $jsonControlador->send($cod, $mes);
                        $tableroJugador[$posicion] = '*';
                        conexion::actualizarPartidaFinalizada($idpartida);
                        $finalizado = true;
                    } elseif ($tablerOculto[$posicion + 1] == '*' && $tablerOculto[$posicion - 1] == '*') {
                        echo 'hola';
                        $cod = 218;
                        $mes = 'Has marcado una casilla, pero yo que tu me iba de ahi';
                        $jsonControlador->send($cod, $mes);
                        $bombas += 2;
                        $finalizado = true;
                    } elseif ($tablerOculto[$posicion + 1]) {
                        $cod = 218;
                        $mes = 'Has marcado una casilla, pero ten cuidado puede haber minas cerca';
                        $jsonControlador->send($cod, $mes);
                        $bombas += 1;
                        $finalizado = true;
                    } elseif ($tablerOculto[$posicion - 1]) {
                        $cod = 218;
                        $mes = 'Has marcado una casilla, pero ten cuidado puede haber minas cerca';
                        $jsonControlador->send($cod, $mes);
                        $tableroJugador[$posicion] = 'x';
                        $bombas += 1;
                        $finalizado = true;
                    } elseif ($tablerOculto[$posicion] == 0) {
                        $cod = 202;
                        $mes = 'Has marcado una casilla, estas a salvo';
                        $jsonControlador->send($cod, $mes);
                        $tableroJugador[$posicion] = 'x';
                        $finalizado = true;
                    }
                    if ($bombas == 3) {
                        $cod = 200;
                        $mes = 'Has ganado has encontrado todas las bombas';
                        $jsonControlador->send($cod, $mes);
                        conexion::actualizarRankingPartidasGanadas($idpartida);
                        conexion::actualizarPartidaFinalizada($idpartida);
                        $finalizado = true;
                    }
                } else {
                    $cod = 400;
                    $mes = 'Esta partida esta finalizada';
                    $jsonControlador->send($cod, $mes);
                }
            } else {
                $cod = 400;
                $mes = 'Esta partida no pertenece a este usuario';
                $jsonControlador->send($cod, $mes);
            }
        } else {
            $cod = 400;
            $mes = 'No existe esta partida';
            $jsonControlador->send($cod, $mes);
        }
        return $finalizado;
    }
}
