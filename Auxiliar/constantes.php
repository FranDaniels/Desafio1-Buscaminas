<?php

class constantes
{
    static $host = '127.0.0.1';
    static $user = 'root';
    static $password = '';
    static $url = 'buscaminas';

    //Consultas
    static $selectTodosUsuarios = "SELECT * FROM persona";
    static $selectUsuarioConcreto = "SELECT * FROM persona WHERE correo = ?";
    static $consultarPartidaConcreta = "SELECT * FROM partida WHERE idPartida = ?";
    static $ranking = "SELECT * FROM persona ORDER BY partidasGanadas DESC";

    //Creación
    static $crearUsuario = "INSERT INTO persona (idUsuario,nombre,contrasenia,correo,partidasJugadas,partidasGanadas,administrador) VALUES (?,?,?,?,?,?,?)";
    static $crearPartida = "INSERT INTO partida (idPartida,idUsuario,tableroOculto,tableroMostrado,finalizado) VALUES (?,?,?,?,?)";

    //Modificación
    static $modificarUsuario = "UPDATE persona SET correo = ? WHERE correo = ?";
    static $modificarContrasenia = "UPDATE persona SET contrasenia = ? WHERE correo = ?";
    static $actualizarPartidaFinalizada = "UPDATE partida SET finalizado = 1 WHERE idPartida = ?";
    static $actualizarGanadas = "UPDATE persona SET partidasGanadas = partidasGanadas + 1 WHERE correo = ?";
    static $actualizarJugadas = "UPDATE persona SET partidasJugadas = partidasJugadas + 1 WHERE correo = ?";
    static $rendirse = "UPDATE partida SET finalizada = -1 WHERE id = ?";

    //Borrado
    static $borrarUsuario = "DELETE FROM persona WHERE correo = ?";
    static $borrarPartida = "DELETE FROM partida WHERE idPartida = ?";
}
