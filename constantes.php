<?php

class constantes{
    static $host='localhost';
    static $user='root';
    static $password='';
    static $url='jdbc:mysql://localhost/buscaminas';

    //Consultas
    static $selectUsuarioConcreto="SELECT * FROM persona WHERE idUsuario = ?";
    static $consultarPartidaConcreta="SELECT * FROM persona WHERE idUsuario = ?";
    
    //Creación
    static $crearUsuario="INSERT INTO persona (idUsuario,nombre,contrasenia,correo,partidasJugadas,partidasGanadas) VALUES (?,?,?,?,?,?)";
    static $crearPartida="INSERT INTO partida (idPartida,idUsuario,tableroOculto,tableroMostrado,finalizado) VALUES (?,?,?,?,?)";

    //Modificación
    static $modificarUsuario="UPDATE persona SET nombre = ? WHERE idUsuario = ?";

    //Borrado
    static $borrarUsuario="DELETE FROM persona WHERE idUsuario = '?'";
    static $borrarPartida="DELETE FROM partida WHERE idPartida = '?'";

}   