<?php

require_once('Auxiliar/factoria.php');
require_once('Auxiliar/conexion.php');

class controllerPartida{

    public static function crearPartida($idUsu,$tamanio,$cantBombas){

        if (factoria::creacionPartida($idUsu,$tamanio,$cantBombas)) {
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

    public static function consultarPartidaCreada($idpartida){
        $partidaIniciada=conexion::consultarPartida($idpartida);

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

    public static function borrarPartida($idpartida){

        if (conexion::borrarPartida($idpartida)) {
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

    public static function actualizarPartidaFinalizada($idpartida){

        if (conexion::actualizarPartidaFinalizada($idpartida)) {
            $cod=200;
            $mes='Todo OK';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]); 
        }else {
            $cod=422;
            $mes='Error al actualizar la partida finalizada';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
        }
    }

    public static function rendirse($idpartida){
        if (conexion::rendirse($idpartida)) {
            $cod=200;
            $mes='Todo OK';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]); 
        }else {
            $cod=422;
            $mes='Error al rendirse';
            header('HTTP/1.1 '. $cod.' '.$mes);
                    
            return json_encode(['Código'=>$cod, 'Mensaje'=>$mes]);
        }
    }
}