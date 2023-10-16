<?php

require_once('Auxiliar/factoria.php');
require_once('Auxiliar/conexion.php');

class controllerPartida{

    public static function crearPartida($datosRecibidos){
        $partida=factoria::creacionPartida(0,$datosRecibidos['id'],$datosRecibidos['tamanio'],$datosRecibidos['cantBombas']);

        if (conexion::insertarPartida($partida)) {
            $cod=202;
            $mes='Todo OK';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]); 
        }else {
            $cod=422;
            $mes='Error al crear la partida';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]); 
        }
    }

    public static function consultarPartidaCreada($datosRecibidos){
        $partidaIniciada=conexion::consultarPartida($datosRecibidos['id']);

        if ($partidaIniciada['finalizado']==1) {
            $cod=202;
            $mes='Todo OK'; //Hay una partida no finalizada
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]); 
        }else {
            $cod=400;
            $mes='No existe ninguna partida iniciada';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]); 
        }
    }

    public static function borrarPartida($datosRecibidos){
        conexion::borrarPartida($datosRecibidos['id']);

        if (conexion::borrarPartida($datosRecibidos['id'])) {
            $cod=200;
            $mes='Todo OK';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
        }else {
            $cod=422;
            $mes='Error borrar la partida';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
        }
    }
}