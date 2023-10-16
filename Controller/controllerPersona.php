<?php

require_once('Clases/factoria.php');
require_once('conexion.php');

class controllerPersona{

    public static function partidaFinalizada(){
        $partidaFinalizada=conexion::consultarPartidaFinalizada();

        if ($partidaFinalizada[0]) {
            
        }
    }
}