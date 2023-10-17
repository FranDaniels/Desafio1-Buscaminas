<?php

class constantes{
    static $host='localhost';
    static $user='root';
    static $password='';
    static $url='jdbc:mysql://localhost/buscaminas';

    //Consultas
    static $selectTodosUsuarios="SELECT * FROM jugador";
    static $selectUsuarioConcreto="SELECT * FROM persona WHERE correo = ?";
    static $consultarPartidaConcreta="SELECT * FROM persona WHERE idPartida = ?";
    
    //Creación
    static $crearUsuario="INSERT INTO persona (idUsuario,nombre,contrasenia,correo,partidasJugadas,partidasGanadas) VALUES (?,?,?,?,?,?)";
    static $crearPartida="INSERT INTO partida (idPartida,idUsuario,tableroOculto,tableroMostrado,finalizado) VALUES (?,?,?,?,?)";

    //Modificación
    static $modificarUsuario="UPDATE persona SET correo = ? WHERE correo = ?";
    static $modificarContrasenia="UPDATE persona SET contrasenia = ? WHERE correo = ?";

    //Borrado
    static $borrarUsuario="DELETE FROM persona WHERE correo = '?'";
    static $borrarPartida="DELETE FROM partida WHERE idPartida = '?'";

}   