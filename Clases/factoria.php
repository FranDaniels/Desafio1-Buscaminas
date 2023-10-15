<?php

require_once ('Clases/persona.php');
require_once ('Clases/partida.php');

class factoria{
    public static function crearUsuario($id,$nombre,$contrasenia,$correo,$partidasJugadas,$partidasGanadas,$administrador){
        $usu= new persona($id,$nombre,$contrasenia,$correo,$partidasJugadas,$partidasGanadas,$administrador);
        return $usu;
    }

    public static function crearPartida($idPartida,$idUsuario,$tableroOculto,$tableroMostrado,$finalizado){
        $partida=new partida($idPartida,$idUsuario,$tableroOculto,$tableroMostrado,$finalizado);
        return $partida;
    }
}