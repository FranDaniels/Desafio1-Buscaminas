<?php

require_once ('Modelo/persona.php');
require_once ('Modelo/partida.php');

class factoria{
    public static function crearUsuario($id,$nombre,$contrasenia,$correo,$partidasJugadas,$partidasGanadas,$administrador){
        $usu= new persona($id,$nombre,$contrasenia,$correo,$partidasJugadas,$partidasGanadas,$administrador);
        return $usu;
    }

    public static function crearPartida($idPartida,$idUsuario,$tableroOculto,$tableroMostrado,$finalizado){
        $partida=new partida($idPartida,$idUsuario,$tableroOculto,$tableroMostrado,$finalizado);
        return $partida;
    }

    public static function crearTableroRelleno($tamanio,$cantBombas){
        $tablero=array_fill(1,$tamanio,0);

        while ($cantBombas>0) {
            $posicion=rand(1,$tamanio);

            if ($tablero[$posicion]!='*') { //Recordar que para las bombas se utilizará el símbolo *
                $tablero[$posicion]='*'; //Si la casilla no contiene una bomba la colocaremos

                --$cantBombas;
            }
        }

        for ($i=1; $i <= $tamanio; $i++) { 
            if ($tablero[$i]!='*') {
                if ($i>1 && $tablero[$i-1]=='*') { //Comprobación de la casilla de la izquierda
                    $tablero[$i]++;
                }
                if ($i>1 && $tablero[$i+1]=='*') { //Comprobación de la casilla de la derecha
                    $tablero[$i]++;
                }
            }
        }

        $tableroRelleno=implode('',$tablero);

        return $tableroRelleno;
    }
    
    /**
     * crearTableroNormal
     *
     * @param  mixed $tamanio
     * @return void
     */
    public static function crearTableroNormal($tamanio){
        $tableroNormal=implode('',array_fill(1,$tamanio,'-'));

        return $tableroNormal;
    }
    
    /**
     * creacionPartida
     *
     * @param  mixed $idPartida
     * @param  mixed $idJugador
     * @param  mixed $tamanioTablero
     * @param  mixed $cantBombas
     * @return void
     */
    public static function creacionPartida($idJugador,$tamanioTablero,$cantBombas){
        $tableroResuelto=factoria::crearTableroRelleno($tamanioTablero,$cantBombas);
        $tableroJugador=factoria::crearTableroNormal($tamanioTablero);
        $partida=factoria::crearPartida('null',$idJugador,$tableroResuelto,$tableroJugador,false);

        return $partida;
    }
    
}